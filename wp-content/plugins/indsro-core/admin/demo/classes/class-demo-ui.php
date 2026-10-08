<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Indsro Demo UI — Admin page renderer and asset enqueuer.
 */
class Indsro_Demo_UI {

    public function __construct() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    /**
     * Enqueue CSS/JS on the demo import page only.
     */
    public function enqueue_assets( $hook ): void {
        if ( false === strpos( $hook, 'indsro-demo-import' ) ) {
            return;
        }

        wp_enqueue_style(
            'indsro-demo-import',
            INDSRO_DEMO_URL . 'assets/css/demo-import.css',
            [],
            '1.0.0'
        );

        wp_enqueue_script(
            'indsro-demo-import',
            INDSRO_DEMO_URL . 'assets/js/demo-import.js',
            [ 'jquery' ],
            '1.0.0',
            true
        );

        wp_localize_script( 'indsro-demo-import', 'indsroDemoImport', [
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( Indsro_Demo_Ajax::NONCE_ACTION ),
            'steps'   => [
                'validate'         => __( 'Validating', 'indsro-core' ),
                'import_xml'       => __( 'Importing Content', 'indsro-core' ),
                'verify_elementor' => __( 'Verifying Elementor', 'indsro-core' ),
                'widgets'          => __( 'Importing Widgets', 'indsro-core' ),
                'customizer'       => __( 'Customizer & Options', 'indsro-core' ),
                'assign_menus'     => __( 'Assigning Menus', 'indsro-core' ),
                'set_pages'        => __( 'Setting Pages', 'indsro-core' ),
                'finalize'         => __( 'Finalizing', 'indsro-core' ),
            ],
        ] );
    }

    /**
     * Render the demo import admin page.
     */
    public static function render_page(): void {
        // Allow legitimate developers to bypass license checks via filter.
        $require_license = apply_filters( 'indsro_demo_require_license', true );

        if ( $require_license ) {
            // Error if the license system was deleted without using the filter.
            if ( ! class_exists( 'Theme_License' ) ) {
                echo '<div class="wrap"><div class="notice notice-error"><p><strong>Security Error:</strong> The license module is missing or corrupted. Demo import is disabled.</p></div></div>';
                return;
            }

            // Prevent backend rendering of the UI if license is inactive.
            $license_handler = new Theme_License();
            if ( ! $license_handler->is_active() ) {
                echo '<div class="wrap"><p>' . esc_html__( 'Please wait...', 'indsro-core' ) . '</p></div>';
                return;
            }
        }

        $importer = new Indsro_Demo_Importer();
        $demos    = $importer->get_demos();
        $imported = get_option( 'indsro_demo_imported', false );
        ?>
        <div class="indsro-demo-wrap">

            <!-- Header -->
            <div class="indsro-demo-header">
                <h1><?php esc_html_e( 'Demo Importer', 'indsro-core' ); ?></h1>
                <p class="indsro-demo-header__sub">
                    <?php esc_html_e( 'Import demo content, widgets, customizer settings, and theme options with one click.', 'indsro-core' ); ?>
                </p>
            </div>

            <!-- Support Notice -->
            <div class="indsro-demo-notice indsro-demo-notice--support">
                <span class="dashicons dashicons-heart"></span>
                <span>
                    <?php esc_html_e( "If you run into any issues during the import, don't worry — we're just one click away 😊. Simply create a support ticket here:", 'indsro-core' ); ?>
                    👉 <a href="https://themexriver.ticksy.com/" target="_blank" rel="noopener noreferrer">https://themexriver.ticksy.com/</a>
                    <br>
                    <?php esc_html_e( 'Our experienced support team will be happy to assist you as quickly as possible 🚀.', 'indsro-core' ); ?>
                </span>
            </div>

            <?php if ( $imported ) : ?>
                <div class="indsro-demo-notice indsro-demo-notice--info">
                    <span class="dashicons dashicons-info"></span>
                    <?php esc_html_e( 'Demo content has already been imported. Re-importing will add duplicate content.', 'indsro-core' ); ?>
                </div>
            <?php endif; ?>

            <!-- Step Indicator (hidden until import starts) -->
            <div class="indsro-demo-steps" id="indsro-steps" style="display:none;">
                <div class="indsro-demo-steps__list" id="indsro-steps-list">
                    <!-- Populated by JS -->
                </div>
            </div>

            <!-- Progress Section (hidden until import starts) -->
            <div class="indsro-demo-progress-section" id="indsro-progress-section" style="display:none;">
                <div class="indsro-demo-progress">
                    <div class="indsro-demo-progress__bar" id="indsro-progress-bar">
                        <span class="indsro-demo-progress__fill" id="indsro-progress-fill"></span>
                    </div>
                    <span class="indsro-demo-progress__percent" id="indsro-progress-percent">0%</span>
                </div>
                <div class="indsro-demo-progress__label" id="indsro-progress-label">&nbsp;</div>
            </div>

            <!-- Log Console (hidden until import starts) -->
            <div class="indsro-demo-console" id="indsro-console" style="display:none;">
                <div class="indsro-demo-console__header">
                    <span class="dashicons dashicons-editor-code"></span>
                    <?php esc_html_e( 'Import Log', 'indsro-core' ); ?>
                </div>
                <div class="indsro-demo-console__body" id="indsro-console-body"></div>
            </div>

            <!-- Demo Cards Grid -->
            <div class="indsro-demo-grid" id="indsro-demo-grid">
                <?php foreach ( $demos as $key => $demo ) : ?>
                    <div class="indsro-demo-card" data-demo-id="<?php echo esc_attr( $key ); ?>">
                        <div class="indsro-demo-card__image">
                            <img src="<?php echo esc_url( $demo['screenshot'] ); ?>" alt="<?php echo esc_attr( $demo['title'] ); ?>" loading="lazy" />
                            <div class="indsro-demo-card__overlay">
                                <a href="<?php echo esc_url( $demo['preview_url'] ); ?>" class="indsro-demo-card__preview" target="_blank">
                                    <span class="dashicons dashicons-visibility"></span>
                                    <?php esc_html_e( 'Preview', 'indsro-core' ); ?>
                                </a>
                            </div>
                        </div>
                        <div class="indsro-demo-card__footer">
                            <h3 class="indsro-demo-card__title"><?php echo esc_html( $demo['title'] ); ?></h3>
                            <button type="button" class="indsro-demo-card__import-btn" data-demo-id="<?php echo esc_attr( $key ); ?>">
                                <span class="dashicons dashicons-download"></span>
                                <?php esc_html_e( 'Import', 'indsro-core' ); ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Success State (hidden) -->
            <div class="indsro-demo-result indsro-demo-result--success" id="indsro-result-success" style="display:none;">
                <div class="indsro-demo-result__icon">✅</div>
                <h2><?php esc_html_e( 'Import Complete!', 'indsro-core' ); ?></h2>
                <p><?php esc_html_e( 'Your demo content has been imported successfully.', 'indsro-core' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button-primary button-hero" target="_blank">
                    <?php esc_html_e( 'View Site', 'indsro-core' ); ?>
                </a>
            </div>

            <!-- Error State (hidden) -->
            <div class="indsro-demo-result indsro-demo-result--error" id="indsro-result-error" style="display:none;">
                <div class="indsro-demo-result__icon">❌</div>
                <h2><?php esc_html_e( 'Import Failed', 'indsro-core' ); ?></h2>
                <p id="indsro-error-message"></p>
                <button type="button" class="button button-primary button-hero" id="indsro-retry-btn">
                    <?php esc_html_e( 'Retry Import', 'indsro-core' ); ?>
                </button>
            </div>

        </div>
        <?php
    }
}
