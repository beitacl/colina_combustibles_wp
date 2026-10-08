<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Indsro Demo Progress Tracker.
 *
 * Stores and retrieves import progress via WordPress transients.
 */
class Indsro_Demo_Progress {

    const TRANSIENT_KEY = 'indsro_demo_progress';

    /**
     * Reset progress to initial state.
     */
    public static function reset() {
        set_transient( self::TRANSIENT_KEY, [
            'step'      => '',
            'step_key'  => '',
            'percent'   => 0,
            'log'       => [],
            'status'    => 'idle',
            'started'   => time(),
            'offset'    => 0,
            'total'     => 0,
        ], HOUR_IN_SECONDS );
    }

    /**
     * Get current progress data.
     *
     * @return array
     */
    public static function get() {
        $data = get_transient( self::TRANSIENT_KEY );
        if ( ! $data || ! is_array( $data ) ) {
            return [
                'step'     => '',
                'step_key' => '',
                'percent'  => 0,
                'log'      => [],
                'status'   => 'idle',
                'offset'   => 0,
                'total'    => 0,
            ];
        }
        return $data;
    }

    /**
     * Update progress.
     *
     * @param array $args Partial data to merge.
     */
    public static function update( array $args ) {
        $current = self::get();
        $merged  = array_merge( $current, $args );
        set_transient( self::TRANSIENT_KEY, $merged, HOUR_IN_SECONDS );
    }

    /**
     * Append a log message.
     *
     * @param string $message
     */
    public static function add_log( string $message ) {
        $current          = self::get();
        $timestamp        = current_time( 'H:i:s' );
        $current['log'][] = "[{$timestamp}] {$message}";

        // Keep only last 200 log entries to prevent memory bloat.
        if ( count( $current['log'] ) > 200 ) {
            $current['log'] = array_slice( $current['log'], -200 );
        }

        set_transient( self::TRANSIENT_KEY, $current, HOUR_IN_SECONDS );
    }

    /**
     * Set the current step.
     *
     * @param string $step_key   Machine key (e.g. 'content').
     * @param string $step_label Human label (e.g. 'Importing Content').
     * @param int    $percent    Overall percentage.
     */
    public static function set_step( string $step_key, string $step_label, int $percent ) {
        self::update( [
            'step'     => $step_label,
            'step_key' => $step_key,
            'percent'  => $percent,
            'status'   => 'running',
        ] );
        self::add_log( $step_label );
    }

    /**
     * Mark import as complete.
     */
    public static function set_done() {
        self::update( [
            'step'     => 'Import Complete',
            'step_key' => 'done',
            'percent'  => 100,
            'status'   => 'done',
        ] );
        self::add_log( '✅ Demo import completed successfully!' );
    }

    /**
     * Mark import as failed.
     *
     * @param string $error
     */
    public static function set_error( string $error ) {
        self::update( [
            'status' => 'error',
        ] );
        self::add_log( '❌ Error: ' . $error );
    }

    /**
     * Clean up transient.
     */
    public static function cleanup() {
        delete_transient( self::TRANSIENT_KEY );
    }
}
