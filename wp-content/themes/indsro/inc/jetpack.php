<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package indsro
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function indsro_jetpack_setup() {
    // Add theme support for Infinite Scroll.
    add_theme_support( 'infinite-scroll', [
        'container' => 'main',
        'render'    => 'indsro_infinite_scroll_render',
        'footer'    => 'page',
    ] );

    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );

    // Add theme support for Content Options.
    add_theme_support( 'jetpack-content-options', [
        'post-details'    => [
            'stylesheet' => 'indsro-style',
            'date'       => '.posted-on',
            'categories' => '.cat-links',
            'tags'       => '.tags-links',
            'author'     => '.byline',
            'comment'    => '.comments-link',
        ],
        'featured-images' => [
            'archive' => true,
            'post'    => true,
            'page'    => true,
        ],
    ] );
}
add_action( 'after_setup_theme', 'indsro_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function indsro_infinite_scroll_render() {
    while ( have_posts() ) {
        the_post();
        if ( is_search() ):
            get_template_part( 'post-formats/content', 'search' );
        else:
            get_template_part( 'post-formats/content', get_post_type() );
        endif;
    }
}
