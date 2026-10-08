<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Indsro Demo AJAX Controller.
 *
 * Handles all AJAX endpoints for the demo import process.
 */
class Indsro_Demo_Ajax {

    /** @var string Nonce action name. */
    const NONCE_ACTION = 'indsro_demo_import_nonce';

    public function __construct() {
        add_action( 'wp_ajax_indsro_start_import', [ $this, 'handle_start_import' ] );
        add_action( 'wp_ajax_indsro_process_step', [ $this, 'handle_process_step' ] );
        add_action( 'wp_ajax_indsro_get_import_status', [ $this, 'handle_get_status' ] );
    }

    /**
     * Verify the AJAX request.
     */
    private function verify_request(): bool {
        if ( ! check_ajax_referer( self::NONCE_ACTION, 'nonce', false ) ) {
            wp_send_json_error( [ 'message' => 'Security check failed.' ], 403 );
            return false;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( [ 'message' => 'Insufficient permissions.' ], 403 );
            return false;
        }

        // License enforcement at the AJAX level.
        $require_license = apply_filters( 'indsro_demo_require_license', true );
        if ( $require_license ) {
            if ( ! class_exists( 'Theme_License' ) ) {
                wp_send_json_error( [ 'message' => 'Security Error: License module missing.' ], 403 );
                return false;
            }
            $license_handler = new Theme_License();
            if ( ! $license_handler->is_active() ) {
                wp_send_json_error( [ 'message' => 'License not activated. Demo import is disabled.' ], 403 );
                return false;
            }
        }

        return true;
    }

    /**
     * Start import — resets progress and begins validation.
     */
    public function handle_start_import(): void {
        $this->verify_request();

        // Reset progress.
        Indsro_Demo_Progress::reset();

        $demo_id = sanitize_text_field( $_POST['demo_id'] ?? 'ta_home_1' );

        // Store selected demo.
        set_transient( 'indsro_import_demo_id', $demo_id, HOUR_IN_SECONDS );

        Indsro_Demo_Progress::add_log( 'Starting demo import: ' . $demo_id );

        wp_send_json_success( [
            'next_step' => 'validate',
            'percent'   => 0,
            'demo_id'   => $demo_id,
        ] );
    }

    /**
     * Process a single import step.
     */
    public function handle_process_step(): void {
        $this->verify_request();

        // Increase limits for import.
        if ( function_exists( 'set_time_limit' ) ) {
            @set_time_limit( 300 );
        }
        @ini_set( 'memory_limit', '512M' );

        $step    = sanitize_text_field( $_POST['step'] ?? '' );
        $offset  = absint( $_POST['offset'] ?? 0 );
        $demo_id = sanitize_text_field( $_POST['demo_id'] ?? get_transient( 'indsro_import_demo_id' ) ?: 'ta_home_1' );

        $importer = new Indsro_Demo_Importer();

        try {
            switch ( $step ) {
                case 'validate':
                    $result = $importer->step_validate();
                    $next   = $result['success'] ? 'import_xml' : '';
                    break;

                case 'import_xml':
                    // ONE SINGLE EXECUTION for all content & media remapping
                    $result = $importer->step_import_xml();
                    $next   = 'verify_elementor';
                    break;

                case 'verify_elementor':
                    $result = $importer->step_verify_elementor();
                    $next   = 'widgets';
                    break;

                case 'widgets':
                    $result = $importer->step_import_widgets();
                    $next   = 'customizer';
                    break;

                case 'customizer':
                    // Customizer + Theme Options together
                    $result = $importer->step_import_customizer_and_options();
                    $next   = 'assign_menus';
                    break;

                case 'assign_menus':
                    $result = $importer->step_assign_menus();
                    $next   = 'set_pages';
                    break;

                case 'set_pages':
                    $result = $importer->step_set_pages($demo_id);
                    $next   = 'finalize';
                    break;

                case 'finalize':
                    $result = $importer->step_finalize();
                    $next   = '';
                    break;

                default:
                    wp_send_json_error( [ 'message' => 'Unknown step: ' . $step ] );
                    return;
            }
        } catch ( \Exception $e ) {
            Indsro_Demo_Progress::set_error( $e->getMessage() );
            wp_send_json_error( [
                'message' => $e->getMessage(),
                'log'     => Indsro_Demo_Progress::get()['log'],
            ] );
            return;
        }

        $progress = Indsro_Demo_Progress::get();

        if ( ! empty( $result['message'] ) && empty( $result['success'] ) ) {
            wp_send_json_error( [
                'message' => $result['message'],
                'log'     => $progress['log'],
            ] );
            return;
        }

        wp_send_json_success( [
            'next_step' => $next,
            'percent'   => $progress['percent'],
            'status'    => $progress['status'],
            'log'       => $progress['log'],
        ] );
    }

    /**
     * Get current import status (for polling).
     */
    public function handle_get_status(): void {
        $this->verify_request();

        $progress = Indsro_Demo_Progress::get();

        wp_send_json_success( $progress );
    }
}
