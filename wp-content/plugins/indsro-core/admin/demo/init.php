<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Indsro Demo Importer Module
 *
 * An isolated, portable module for demo importing.
 */

define( 'INDSRO_DEMO_DIR', plugin_dir_path( __FILE__ ) );
define( 'INDSRO_DEMO_URL', plugin_dir_url( __FILE__ ) );

// Load core classes
require_once INDSRO_DEMO_DIR . 'classes/class-demo-activate.php';
require_once INDSRO_DEMO_DIR . 'classes/class-demo-progress.php';
require_once INDSRO_DEMO_DIR . 'classes/class-demo-zip-handler.php';
require_once INDSRO_DEMO_DIR . 'classes/class-demo-wxr-parser.php';
require_once INDSRO_DEMO_DIR . 'classes/class-demo-content-importer.php';
require_once INDSRO_DEMO_DIR . 'classes/class-demo-importer.php';
require_once INDSRO_DEMO_DIR . 'classes/class-demo-ajax.php';
require_once INDSRO_DEMO_DIR . 'classes/class-demo-ui.php';

// Initialize Handlers
add_action( 'plugins_loaded', function() {
    new Indsro_Demo_Ajax();
    new Indsro_Demo_UI();
});
