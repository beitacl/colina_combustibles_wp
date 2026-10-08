<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 */

function indsro_widgets_init() {

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'indsro' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="tx-blog-widget widget mt-30 %2$s"><div class="sidebar-box">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h4 class="widget-title sidebar-box-title fti-heading-3">',
        'after_title'   => '</h4>',
    ] );

    if ( INDSRO_WOOCOMMERCE_ACTIVED ) {
        // shop sidebar
        register_sidebar( [
            'name'          => esc_html__( 'Product Sidebar', 'indsro' ),
            'id'            => 'product-sidebar',
            'before_widget' => '<div id="%1$s" class="tx-blog-widget widget mt-30 %2$s">',
            'after_widget'  => '</div><div class="sidebar-divider"></div>',
            'before_title'  => '<h4 class="widget-title sidebar-box-title fti-heading-3">',
            'after_title'   => '</h4>',
        ] );
    }

    $footer_widgets = cs_get_option( 'footer_widget_number' );

}
add_action( 'widgets_init', 'indsro_widgets_init' );