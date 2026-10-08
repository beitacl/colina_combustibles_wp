<?php

/**
 * indsro_scripts description
 * @return [type] [description]
 */
function indsro_scripts() {

    wp_enqueue_style( 'indsro-fonts', indsro_fonts_url(), [], null );
    wp_enqueue_style( 'bootstrap-min', INDSRO_THEME_CSS_DIR . 'bootstrap.min.css', [] );
    wp_enqueue_style( 'fontawesome-min', INDSRO_THEME_CSS_DIR . 'fontawesome-min.css', [] );
    wp_enqueue_style( 'swiper-min', INDSRO_THEME_CSS_DIR . 'swiper.min.css', [], VERSION );
    wp_enqueue_style( 'animate-min', INDSRO_THEME_CSS_DIR . 'animate-min.css', [], VERSION );
    wp_enqueue_style( 'magnific-popup', INDSRO_THEME_CSS_DIR . 'magnific-popup.css', [], VERSION );
    wp_enqueue_style( 'nice-select-min', INDSRO_THEME_CSS_DIR . 'nice-select-min.css', [], VERSION );
    wp_enqueue_style( 'indsro-core', INDSRO_THEME_CSS_DIR . 'indsro-core.css', [], VERSION );
    wp_enqueue_style( 'indsro-companion', INDSRO_THEME_CSS_DIR . 'indsro-companion.css', [] );
    wp_enqueue_style( 'indsro-extra', INDSRO_THEME_CSS_DIR . 'indsro-extra.css', [] );
    wp_enqueue_style( 'indsro-custom', INDSRO_THEME_CSS_DIR . 'indsro-custom.css', [] );
    wp_enqueue_style( 'indsro-woocommerce', INDSRO_THEME_CSS_DIR . 'indsro-woocommerce.css', [] );
    wp_enqueue_style( 'indsro-style', get_stylesheet_uri() );

    if ( class_exists('WooCommerce') ) {
		wp_enqueue_style( 'woocommerce-style', get_template_directory_uri() . '/woocommerce/woocommerce.css' );
	}

    $my_current_lang = apply_filters( 'wpml_current_language', NULL );

    $enable_rtl = cs_get_option( 'enable_rtl', false );
    if ( $my_current_lang != 'en' && $enable_rtl || is_rtl() ) {
        wp_enqueue_style( 'indsro-rtl', INDSRO_THEME_CSS_DIR . 'indsro-rtl.css', [] );
    }

    // all js files
    wp_enqueue_script( 'bootstrap-min', INDSRO_THEME_JS_DIR . 'bootstrap-min.js', ['jquery'], false, true );
    wp_enqueue_script( 'swiper-min', INDSRO_THEME_JS_DIR . 'swiper.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'wow-min', INDSRO_THEME_JS_DIR . 'wow-min.js', ['jquery'], false, true );
    wp_enqueue_script( 'gsap-min', INDSRO_THEME_JS_DIR . 'gsap.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'SplitText-min', INDSRO_THEME_JS_DIR . 'SplitText.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'lenis-min', INDSRO_THEME_JS_DIR . 'lenis.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'appear', INDSRO_THEME_JS_DIR . 'appear.js', ['jquery'], false, true );
    wp_enqueue_script( 'magnific-popup-min', INDSRO_THEME_JS_DIR . 'magnific-popup.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'scrollTrigger-min', INDSRO_THEME_JS_DIR . 'scrollTrigger.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'counterup-min', INDSRO_THEME_JS_DIR . 'counterup.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'waypoints-min', INDSRO_THEME_JS_DIR . 'waypoints.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'jquery-marquee-min', INDSRO_THEME_JS_DIR . 'jquery.marquee.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'nice-select-min', INDSRO_THEME_JS_DIR . 'nice-select-min.js', ['jquery'], false, true );
    wp_enqueue_script( 'jquery-inputarrow', INDSRO_THEME_JS_DIR . 'jquery.inputarrow.js', ['jquery'], false, true );
    wp_enqueue_script( 'touchspin', INDSRO_THEME_JS_DIR . 'touchspin.js', ['jquery'], false, true );
    wp_enqueue_script( 'indsro-custom', INDSRO_THEME_JS_DIR . 'indsro-custom.js', ['jquery'], false, true );

    if ( $my_current_lang != 'en' && $enable_rtl || is_rtl() ) {
        wp_enqueue_script( 'indsro-core-rtl', INDSRO_THEME_JS_DIR . 'indsro-core-rtl.js', ['jquery'], VERSION, true );
    } else {
        wp_enqueue_script( 'indsro-core', INDSRO_THEME_JS_DIR . 'indsro-core.js', ['jquery'], VERSION, true );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'indsro_scripts' );