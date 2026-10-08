<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Plugin Name: Indsro Core
 * Plugin URI: https://themexriver.com/
 * Description: Indsro Core is a reliable and feature-rich WordPress plugin developed by themexriver.
 * Version: 1.0.2
 * Author: themexriver
 * Author URI: https://themexriver.com/
 * Text Domain: indsro-core
 */

define( 'INDSRO_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'INDSRO_CORE_URL', plugin_dir_url( __FILE__ ) );
define( 'TA_ASSETS', trailingslashit( INDSRO_CORE_URL . 'assets' ) );

define( 'INDSRO_CORE_TEXT_DOMAIN', 'indsro-core' );
define( 'INDSRO_CORE_PLUGIN_ACTIVED', in_array( 'indsro-core/indsro-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );

if ( !defined( 'INDSRO_CORE_WOOCOMMERCE_ACTIVED' ) ) {
    define( 'INDSRO_CORE_WOOCOMMERCE_ACTIVED', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
}

// load plugin text domain
function tx_core_load_textdomain() {
    load_plugin_textdomain( INDSRO_CORE_TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'tx_core_load_textdomain' );

// add_filter( 'indsro_demo_require_license', '__return_false' );

final class Theme_Companion {

    private static $instance;

    function __construct() {

        if ( file_exists( INDSRO_CORE_DIR . '/lib/codestar-framework/codestar-framework.php' ) ) {
            require_once INDSRO_CORE_DIR . '/lib/codestar-framework/codestar-framework.php';
        }

        require_once INDSRO_CORE_DIR . '/inc/custom-post.php';
        // Load the self-contained Demo Importer module
        require_once INDSRO_CORE_DIR . '/admin/demo/init.php';

        /**
         * widgets
         */
        $footer_widgets = glob( INDSRO_CORE_DIR . '/widgets/*.php' );
        if ( $footer_widgets ) {
            foreach ( $footer_widgets as $footer_widget ) {
                require $footer_widget;
            }
        }

        // INCLUDE ALL OPTIONS
        require_once INDSRO_CORE_DIR . '/classes/indsro-plugin-helper.php';
        add_action( 'after_setup_theme', function() {
        require_once INDSRO_CORE_DIR . '/inc/options/theme-metabox.php';
        require_once INDSRO_CORE_DIR . '/inc/options/theme-option.php';
        require_once INDSRO_CORE_DIR . '/inc/options/theme-user-option.php';
        });

        add_filter( 'template_include', [$this, '_custom_template_include'] );
    }

    public static function instance() {

        if ( !isset( self::$instance ) && !( self::$instance instanceof Theme_Companion ) ) {
            self::$instance = new Theme_Companion;
        }
        return self::$instance;
    }

    public function _custom_template_include( $template ) {
        $post_types = tx_core_post_types();

        if ( !empty( $post_types ) ) {
            foreach ( $post_types as $post_type => $fields ) {
                if ( is_singular( $post_type ) ) {
                    return $this->_get_custom_template( 'single-' . $post_type . '.php' );
                }
            }
        }
        return $template;

    }

    public function _get_custom_template( $template ) {
        if ( $theme_file = locate_template( [$template] ) ) {
            $file = $theme_file;
        } else {
            $file = INDSRO_CORE_DIR . 'template/' . $template;
        }
        return apply_filters( __FUNCTION__, $file, $template );
    }

}

function Theme_Companion() {
    return Theme_Companion::instance();
}
Theme_Companion();

if ( file_exists( INDSRO_CORE_DIR . '/admin/admin-init.php' ) ) {
    require_once INDSRO_CORE_DIR . '/admin/admin-init.php';
}

function ta_enqueue_custom_admin_style() {
    wp_register_style( 'custom_wp_admin_css', INDSRO_CORE_URL . 'assets/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'ta_enqueue_custom_admin_style' );

// custom admin script
function ta_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'xpress-main', INDSRO_CORE_URL . 'assets/js/main.js', ['jquery'], false, true );
}
add_action( 'admin_enqueue_scripts', 'ta_admin_scripts' );

/**
 *
 */
function tx_core_post_types() {
    if ( function_exists( 'cs_get_option' ) ) {
        // services
        $tx_service_slug = cs_get_option( 'tx_service_slug' );
        $tx_service_title = cs_get_option( 'tx_service_title' );
    }
    if ( !isset( $tx_service_slug ) ) {
        $tx_service_slug = 'tx-services';
    }
    if ( !isset( $tx_service_title ) ) {
        $tx_service_title = 'Indsro Services';
    }

    // projects
    if ( function_exists( 'cs_get_option' ) ) {
        $tx_project_slug = cs_get_option( 'tx_project_slug' );
        $tx_project_title = cs_get_option( 'tx_project_title' );
    }
    if ( !isset( $tx_project_slug ) ) {
        $tx_project_slug = 'tx-projects';
    }
    if ( !isset( $tx_project_title ) ) {
        $tx_project_title = 'Indsro Projects';
    }

    // teams
    if ( function_exists( 'cs_get_option' ) ) {
        $tx_team_slug = cs_get_option( 'tx_team_slug' );
        $tx_team_title = cs_get_option( 'tx_team_title' );
    }
    if ( !isset( $tx_team_slug ) ) {
        $tx_team_slug = 'tx-teams';
    }
    if ( !isset( $tx_team_title ) ) {
        $tx_team_title = 'Indsro Teams';
    }

     // careers
     if ( function_exists( 'cs_get_option' ) ) {
        $tx_career_slug = cs_get_option( 'tx_career_slug' );
        $tx_career_title = cs_get_option( 'tx_career_title' );
    }
    if ( !isset( $tx_career_slug ) ) {
        $tx_career_slug = 'tx-careers';
    }
    if ( !isset( $tx_career_title ) ) {
        $tx_career_title = 'Indsro Careers';
    }

    return [
        'tf-header' => [
            'title'         => 'Header Builder',
            'plural_title'  => 'Header Builder',
            'rewrite'       => 'tf-header',
            'menu_icon'     => 'dashicons-editor-insertmore',
            'menu_position' => 6,
        ],
        'tf-footer' => [
            'title'         => 'Footer Builder',
            'plural_title'  => 'Footer Builder',
            'rewrite'       => 'tf-footer',
            'menu_icon'     => 'dashicons-editor-insertmore',
            'menu_position' => 6,
        ],
        // services
        'services'  => [
            'title'         => 'Indsro Services',
            'plural_title'  => '' . $tx_service_title . '',
            'rewrite'       => '' . $tx_service_slug . '',
            'menu_icon'     => 'dashicons-insert',
            'menu_position' => 4,
        ],
        // projects
        'projects'  => [
            'title'         => 'Indsro Projects',
            'plural_title'  => '' . $tx_project_title . '',
            'rewrite'       => '' . $tx_project_slug . '',
            'menu_icon'     => 'dashicons-insert',
            'menu_position' => 4,
        ],
        // teams
        'teams'     => [
            'title'         => 'Indsro Teams',
            'plural_title'  => '' . $tx_team_title . '',
            'rewrite'       => '' . $tx_team_slug . '',
            'menu_icon'     => 'dashicons-insert',
            'menu_position' => 4,
        ],
         // careers
         'careers'   => [
            'title'         => 'Indsro Careers',
            'plural_title'  => '' . $tx_career_title . '',
            'rewrite'       => '' . $tx_career_slug . '',
            'menu_icon'     => 'dashicons-insert',
            'menu_position' => 4,
        ],
    ];
}

add_filter( 'tx_custom_post_type', 'tx_core_post_types' );

// move media admin menu position
function tx_move_media_menu() {
    remove_menu_page( 'upload.php' );
    add_menu_page( 'Media', 'Media', 'manage_options', 'upload.php', '', 'dashicons-admin-media', 5 );
}
add_action( 'admin_menu', 'tx_move_media_menu' );

/**
 * Custom Taxonomies
 */
function tx_custom_taxonomies() {
    return [
        'project-categories' => [
            'title'        => 'Project Category',
            'plural_title' => 'Project Categories',
            'rewrite'      => 'project-cat',
            'post_type'    => 'projects',
        ],
    ];
}

add_filter( 'custom_tx_companion_taxonomies', 'tx_custom_taxonomies' );

// post scial share
function indsro_social_share() {

    $post_link = get_permalink(get_the_ID());
    $post_title = get_the_title(get_the_ID());

    if ( function_exists( 'cs_get_option' ) ) {
        // services
        $tx_social_share_heading = cs_get_option( 'tx_social_share_heading', 'Share Article:' );
    } else {
        $tx_social_share_heading = 'Share Article:';
    }

    $html = '';
    $html .= '
    <div class="blog-details-social-share">
    <span class="fti-heading-3 blog-details-social-title">'.esc_html($tx_social_share_heading).'</span>
    <div class="blog-details-social-share-icons">
        <a onClick="window.open(\'http://www.facebook.com/sharer.php?u=' . esc_url($post_link) . '\',\'Facebook\',\'width=600,height=300,left=\'+(screen.availWidth/2-300)+\',top=\'+(screen.availHeight/2-150)+\'\'); return false;" href="http://www.facebook.com/sharer.php?u=' . esc_url($post_link) . '" aria-label="social link" >
        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M18 0C21.3526 0.0382568 24.3813 0.862213 27.0861 2.47187C29.7587 4.04939 31.9819 6.28618 33.5431 8.96835C35.143 11.6895 35.962 14.7365 36.0001 18.1095C35.9051 22.7245 34.4495 26.6662 31.6333 29.9345C28.817 33.2029 25.2101 35.2249 21.4763 36V23.0609H25.0063L25.8046 17.9762H20.4593V14.6458C20.4296 13.9554 20.648 13.2771 21.0749 12.7337C21.5023 12.1888 22.2551 11.9023 23.3332 11.8744H26.561V7.42031C26.5147 7.40541 26.0753 7.34649 25.2426 7.24354C24.2983 7.13306 23.3488 7.07404 22.3981 7.06676C20.2463 7.07669 18.5446 7.68365 17.2929 8.88764C16.0411 10.0913 15.4017 11.8327 15.3746 14.1119V17.9762H11.3068V23.0609H15.3746V36C10.79 35.2249 7.18304 33.2029 4.36681 29.9345C1.55058 26.6662 0.0950269 22.7245 0 18.1095C0.0380195 14.7364 0.856995 11.6893 2.45693 8.96835C4.01815 6.28618 6.24136 4.04939 8.91397 2.47187C11.6187 0.862523 14.6474 0.0385667 18 0Z" fill="#3A5897"/>
            </svg>

        </a>
        <a href="https://twitter.com/intent/tweet?url=' . esc_url($post_link) . '&text=' . urlencode($post_title) . '" aria-label="social link" >
        <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_68_1258)">
            <path d="M18.5703 0C8.62953 0 0.570312 8.05922 0.570312 18C0.570312 27.9408 8.62953 36 18.5703 36C28.5111 36 36.5703 27.9408 36.5703 18C36.5703 8.05922 28.5111 0 18.5703 0Z" fill="black"/>
            <path d="M20.5412 16.371L28.2468 7.41394H26.4209L19.7301 15.1913L14.3862 7.41394H8.22266L16.3036 19.1746L8.22266 28.5676H10.0487L17.1144 20.3544L22.7579 28.5676H28.9214L20.5408 16.371H20.5412ZM10.7067 8.7886H13.5114L26.4217 27.2554H23.6169L10.7067 8.7886Z" fill="white"/>
            </g>
            <defs>
            <clipPath id="clip0_68_1258">
            <rect width="36" height="36" fill="white" transform="translate(0.570312)"/>
            </clipPath>
            </defs>
            </svg>

        </a>
        <a href="https://pinterest.com/pin/create/button/?url=' . esc_url($post_link) . '&media=&description=' . urlencode($post_title) . '" aria-label="social link" >
        <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.189 0C8.23344 0 0.144531 8.02935 0.144531 18.0002C0.144531 27.9706 8.23344 36 18.189 36C28.1446 36 36.1446 27.9706 36.1446 18.0002C36.1446 8.02935 28.1446 0 18.189 0ZM19.6112 22.8531C18.2779 22.7647 17.7446 22.0591 16.6779 21.4414C16.1446 24.4411 15.4335 27.2645 13.389 28.7646C12.7668 24.2648 14.2779 20.912 14.989 17.2941C13.7446 15.2647 15.1668 11.0296 17.7446 12.0882C20.9446 13.3237 14.989 19.8529 18.989 20.6469C23.2557 21.5293 24.9446 13.3237 22.3668 10.6765C18.5445 6.8823 11.3446 10.5881 12.2335 16.0587C12.5001 17.3825 13.8335 17.8235 12.8557 19.6766C10.3668 19.1473 9.65568 17.2057 9.74454 14.7354C9.92231 10.5881 13.4779 7.67627 17.1224 7.23534C21.6557 6.70601 25.9224 8.91173 26.4557 13.1469C27.1668 18.0002 24.4113 23.2061 19.6112 22.8531Z" fill="#E8170E"/>
            </svg>

        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url=' . esc_url($post_link) . '" aria-label="social link" >
        <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_68_1252)">
            <path d="M18.7109 0C15.1509 0 11.6708 1.05568 8.71068 3.03355C5.7506 5.01141 3.44349 7.82263 2.08111 11.1117C0.718737 14.4008 0.362277 18.02 1.05681 21.5116C1.75134 25.0033 3.46568 28.2106 5.98302 30.7279C8.50037 33.2453 11.7077 34.9596 15.1993 35.6541C18.691 36.3487 22.3102 35.9922 25.5992 34.6298C28.8883 33.2675 31.6995 30.9603 33.6774 28.0003C35.6553 25.0402 36.7109 21.5601 36.7109 18C36.7109 13.2261 34.8145 8.64773 31.4389 5.27208C28.0632 1.89642 23.4848 0 18.7109 0ZM13.4767 27.4737H9.54989V14.8239H13.4767V27.4737ZM11.5109 13.0974C11.059 13.0992 10.6167 12.9671 10.2398 12.7176C9.86301 12.4681 9.5686 12.1125 9.39382 11.6958C9.21904 11.279 9.17174 10.8198 9.2579 10.3761C9.34406 9.93249 9.55981 9.52435 9.87788 9.2033C10.1959 8.88225 10.6021 8.66271 11.0449 8.57241C11.4877 8.48212 11.9473 8.52514 12.3657 8.69603C12.7841 8.86692 13.1424 9.158 13.3954 9.5325C13.6484 9.90699 13.7847 10.3481 13.787 10.8C13.7883 11.406 13.5496 11.9879 13.123 12.4184C12.6965 12.8489 12.1169 13.093 11.5109 13.0974ZM28.1846 27.4737H24.2602V21.3158C24.2602 19.8474 24.2317 17.9645 22.2186 17.9645C20.2054 17.9645 19.8502 19.5608 19.8502 21.2092V27.4737H15.9399V14.8239H19.708V16.5482H19.7625C20.2859 15.5534 21.5673 14.5042 23.4786 14.5042C27.4528 14.5042 28.1846 17.1237 28.1846 20.5247V27.4737Z" fill="#007BB5"/>
            </g>
            <defs>
            <clipPath id="clip0_68_1252">
            <rect width="36" height="36" fill="white" transform="translate(0.710938)"/>
            </clipPath>
            </defs>
            </svg>

        </a>
        </div>
        </div>
    ';

    return $html;
}


// wishlist button function
function indsro_wishlist_button() {
    global $product;
    $html = '';

    if ( class_exists( 'WPCleverWoosw' ) && INDSRO_CORE_WOOCOMMERCE_ACTIVED ) {
        $html .= '<div class="tx-wishlistButton blta-product-action-btn">';
        $html .= do_shortcode( '[woosw id="' . esc_attr( $product->get_id() ) . '"]' );
        $html .= '</div>';
    }

    return $html;
}

// indsro quick view button
function indsro_quick_view_button() {
    global $product;
    $html = '';

    if ( class_exists( 'WPCleverWoosq' ) && INDSRO_CORE_WOOCOMMERCE_ACTIVED ) {
        $html .= '<div class="tx-quickViewButton">';
        $html .= do_shortcode( '[woosq id="' . esc_attr( $product->get_id() ) . '"]' );
        $html .= '</div>';
    }

    return $html;
}

// required files
require_once INDSRO_CORE_DIR . '/element-init.php';

// required files
// require_once( INDSRO_CORE_DIR . '/admin/inc/functions.php' );
// require_once( INDSRO_CORE_DIR . '/admin/inc/core.php' );

// remove auto p from contact form 7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

// dequeue swiper & animate css & js from elementor
function tx_dequeue_scripts() {
    wp_deregister_style( 'swiper' );
    wp_deregister_style( 'e-animations' );
}
add_action( 'wp_enqueue_scripts', 'tx_dequeue_scripts' );