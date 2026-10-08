<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CC_CPT_Estaciones {

	public function register() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_filter( 'upload_mimes', array( $this, 'allow_svg' ) );
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'bypass_svg_check' ), 10, 4 );
		add_filter( 'aioseo_disable', array( $this, 'disable_aioseo' ), 10, 1 );
	}

	public function register_post_type() {
		$labels = array(
			'name'                  => __( 'Estaciones', 'colina-cotizaciones' ),
			'singular_name'         => __( 'Estación', 'colina-cotizaciones' ),
			'menu_name'             => __( 'Estaciones', 'colina-cotizaciones' ),
			'add_new'               => __( 'Añadir Nueva', 'colina-cotizaciones' ),
			'add_new_item'          => __( 'Añadir Nueva Estación', 'colina-cotizaciones' ),
			'edit_item'             => __( 'Editar Estación', 'colina-cotizaciones' ),
			'new_item'              => __( 'Nueva Estación', 'colina-cotizaciones' ),
			'view_item'             => __( 'Ver Estación', 'colina-cotizaciones' ),
			'search_items'          => __( 'Buscar Estaciones', 'colina-cotizaciones' ),
			'not_found'             => __( 'No se encontraron estaciones', 'colina-cotizaciones' ),
			'not_found_in_trash'    => __( 'No hay estaciones en la papelera', 'colina-cotizaciones' ),
		);

		$args = array(
			'labels'       => $labels,
			'public'       => true,
			'show_ui'      => true,
			'show_in_menu' => true,
			'has_archive'  => false,
			'menu_icon'    => 'dashicons-location-alt',
			'supports'     => array( 'title' ),
			'show_in_rest' => true,
		);

		register_post_type( 'estacion', $args );
	}

	public function allow_svg( $mimes ) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}

	public function bypass_svg_check( $data, $file, $filename, $mimes ) {
		$ext = pathinfo( $filename, PATHINFO_EXTENSION );
		if ( 'svg' === $ext ) {
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		return $data;
	}

	public function disable_aioseo( $disabled ) {
		global $post;
		if ( is_admin() && isset( $post->post_type ) && 'estacion' === $post->post_type ) {
			return true;
		}
		return $disabled;
	}
}
