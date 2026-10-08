<?php

if ( ! defined( 'WP_DEBUG' ) ) {
	die( 'Direct access forbidden.' );
}

define( 'INDSRO_ASSET_VERSION', '1.0.1' );

add_action( 'wp_enqueue_scripts', 'indsro_child_enqueue_styles', 99 );
function indsro_child_enqueue_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'indsro-parent-style', get_template_directory_uri() . '/style.css', array(), $theme_version );
	wp_enqueue_style( 'indsro-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'indsro-parent-style' ), $theme_version );
}

/**
 * Navbar hardcodeado en el tema hijo.
 *
 * Quita el render del header que hacía el tema vía Elementor
 * (tf-header 4749 -> get_builder_content_for_display) y lo reemplaza
 * por el partial PHP directo, para que cargue junto con todo el HTML
 * sin procesar el builder de Elementor en cada request.
 */
add_action( 'after_setup_theme', 'indsro_child_replace_header', 99 );
function indsro_child_replace_header() {
	remove_action( 'indsro_header_style', 'indsro_check_header', 10 );
	add_action( 'indsro_header_style', 'indsro_child_render_header', 5 );
}

function indsro_child_render_header() {
	get_template_part( 'inc/header-nav' );
}
