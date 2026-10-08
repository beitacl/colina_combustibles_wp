<?php

// DEFINE CONSTANTS
define( 'INDSRO_THEME_DIR', get_template_directory() );
define( 'INDSRO_THEME_URI', get_template_directory_uri() );
define( 'INDSRO_THEME_CSS_DIR', INDSRO_THEME_URI . '/assets/css/' );
define( 'INDSRO_THEME_JS_DIR', INDSRO_THEME_URI . '/assets/js/' );
define( 'INDSRO_THEME_INC', INDSRO_THEME_DIR . '/inc/' );
define( 'INDSRO_CORE_PLUG_DIR', plugins_url( 'indsro-core/assets/' ) );
define( 'INDSRO_CORE', in_array( 'indsro-core/indsro-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );

// INCLUDE CS FRAMEWORK FILE
require INDSRO_THEME_INC . 'csf-functions.php';

if ( !defined( 'INDSRO_WOOCOMMERCE_ACTIVED' ) ) {
    define( 'INDSRO_WOOCOMMERCE_ACTIVED', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
}

if ( home_url() == "https://themexriver.com/wp/indsro" ) {
    define( 'VERSION', time() );
} else {
    define( 'VERSION', wp_get_theme()->get( 'Version' ) );
}

if ( INDSRO_WOOCOMMERCE_ACTIVED ) {
    /**
     * Remove Action Hook
     */
    function indsro_woo_theme_init(){
        $indsro_exlude_hooks = require INDSRO_THEME_INC . 'woocommerce/woo-actions.php';
        foreach( $indsro_exlude_hooks as $k => $v )
        {
            foreach( $v as $value )
            remove_action( $k, $value[0], $value[1] );
        }

    }
    add_action( 'init', 'indsro_woo_theme_init');
}

// INCLUDE INDSRO AFTER SETUP
require INDSRO_THEME_INC . 'indsro-after-setup.php';

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function indsro_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'indsro_content_width', 640 );
}
add_action( 'after_setup_theme', 'indsro_content_width', 0 );

// INCLUDE INDSRO REGISTER WIDGETS
require INDSRO_THEME_INC . 'indsro-register-widgets.php';

// INCLUDE INDSRO ENQUEUE SCRIPTS
require INDSRO_THEME_INC . 'indsro-enqueue-scripts.php';

// INCLUDE CUSTOM HEADER
require INDSRO_THEME_INC . 'custom-header.php';

// INCLUDE CUSTOM FUNCTIONS FILE
require INDSRO_THEME_INC . 'indsro-functions.php';

// INCLUDE CUSTOM CSS
require INDSRO_THEME_INC . 'indsro-custom-css.php';

// INCLUDE DEFAULT COMMENT
require INDSRO_THEME_INC . 'indsro-comment.php';

// INCLUDE LOGO FILE
require INDSRO_THEME_INC . 'layouts/indsro-logos.php';

// INCLUDE MENU FILE
require INDSRO_THEME_INC . 'layouts/indsro-menus.php';

// INCLUDE DEFAULT BREADCRUMB
require INDSRO_THEME_INC . 'layouts/indsro-breadcrumb.php';

// INCLUDE ALL ACTION FILE
require INDSRO_THEME_INC . 'layouts/indsro-actions.php';

// INCLUDE DEFAULT HEADER
require INDSRO_THEME_INC . 'layouts/indsro-default-header.php';

// INCLUDE FOOTER FILE
require INDSRO_THEME_INC . 'layouts/indsro-default-footer.php';

// INCLUDE SEARCH WIDGET FILE
require INDSRO_THEME_INC . 'indsro-search-widget.php';

// LOAD JETPACK COMPATIBILITY FILE
if ( defined( 'JETPACK__VERSION' ) ) {
    require INDSRO_THEME_INC . 'jetpack.php';
}

// ALL CLASS FILE
include_once INDSRO_THEME_INC . 'classes/class-indsro-helper.php';
require_once INDSRO_THEME_INC . 'classes/class-breadcrumb.php';
require_once INDSRO_THEME_INC . 'classes/class-navwalker.php';
require_once INDSRO_THEME_INC . 'classes/class-tgm-plugin-activation.php';
require_once INDSRO_THEME_INC . 'required-plugin.php';

