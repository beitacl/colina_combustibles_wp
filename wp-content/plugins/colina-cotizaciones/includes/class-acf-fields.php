<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CC_ACF_Fields {

	public function register() {
		add_action( 'acf/init', array( $this, 'register_fields' ) );
	}

	public function register_fields() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group( array(
			'key'      => 'group_datos_estacion',
			'title'    => __( 'Datos de la Estación', 'colina-cotizaciones' ),
			'fields'   => array(
				array(
					'key'      => 'field_capacidad_maxima',
					'label'    => __( 'Capacidad Máxima (Lts)', 'colina-cotizaciones' ),
					'name'     => 'capacidad_maxima',
					'type'     => 'number',
					'required' => 1,
					'min'      => 0,
				),
				array(
					'key'      => 'field_disponibilidad_actual',
					'label'    => __( 'Disponibilidad Actual (Lts)', 'colina-cotizaciones' ),
					'name'     => 'disponibilidad_actual',
					'type'     => 'number',
					'required' => 1,
					'min'      => 0,
				),
				array(
					'key'      => 'field_precio_unitario',
					'label'    => __( 'Precio Unitario (Bs)', 'colina-cotizaciones' ),
					'name'     => 'precio_unitario',
					'type'     => 'number',
					'required' => 1,
					'min'      => 0,
					'precision' => 2,
					'step'     => 0.01,
				),
				array(
					'key'   => 'field_texto_advertencia',
					'label' => __( 'Descripción del Estado / Advertencia', 'colina-cotizaciones' ),
					'name'  => 'texto_advertencia',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_link_como_llegar',
					'label' => __( 'Enlace Ubicación (Cómo llegar)', 'colina-cotizaciones' ),
					'name'  => 'link_como_llegar',
					'type'  => 'url',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'estacion',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => array( 'the_content' ),
		) );
	}
}
