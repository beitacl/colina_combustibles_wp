<?php

// File Security Check
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

function indsro_primary_color() {

    wp_enqueue_style( 'indsro-primary-color', INDSRO_THEME_CSS_DIR . 'indsro-custom.css', [] );

    $__fti_pr_1 = cs_get_option( '__fti_pr_1', '#EC6C06' );
    $__fti_pr_2 = cs_get_option( '__fti_pr_2', '#EA5501' );
    $__fti_pr_3 = cs_get_option( '__fti_pr_3', '#ff5317' );

    if (
        $__fti_pr_1 ||
        $__fti_pr_2 ||
        $__fti_pr_3
    ) {
        $custom_css = '';
        $custom_css .= '
            :root {
                --fti-pr-1: ' . esc_attr( $__fti_pr_1 ) . ';
                --fti-pr-2: ' . esc_attr( $__fti_pr_2 ) . ';
                --fti-pr-3: ' . esc_attr( $__fti_pr_3 ) . ';
            }
        ';

        wp_add_inline_style( 'indsro-primary-color', $custom_css );
    }

}
add_action( 'wp_enqueue_scripts', 'indsro_primary_color' );