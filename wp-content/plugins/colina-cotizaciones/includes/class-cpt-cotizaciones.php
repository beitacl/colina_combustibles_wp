<?php
/**
 * @package         Colina_Cotizaciones
 * @since           1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

class CC_CPT_Cotizaciones {

	/**
	 *
	 * @return void
	 */
	public function register() {
		$labels = array(
			'name'                  => _x( 'Cotizaciones', 'Post Type General Name', 'colina-cotizaciones' ),
			'singular_name'         => _x( 'Cotización', 'Post Type Singular Name', 'colina-cotizaciones' ),
			'menu_name'             => __( 'Cotizaciones', 'colina-cotizaciones' ),
			'name_admin_bar'        => __( 'Cotización', 'colina-cotizaciones' ),
			'archives'              => __( 'Archivo de Cotizaciones', 'colina-cotizaciones' ),
			'attributes'            => __( 'Atributos de Cotización', 'colina-cotizaciones' ),
			'parent_item_colon'     => __( 'Cotización Padre:', 'colina-cotizaciones' ),
			'all_items'             => __( 'Todas las Cotizaciones', 'colina-cotizaciones' ),
			'add_new_item'          => __( 'Añadir Nueva Cotización', 'colina-cotizaciones' ),
			'add_new'               => __( 'Añadir Nueva', 'colina-cotizaciones' ),
			'new_item'              => __( 'Nueva Cotización', 'colina-cotizaciones' ),
			'edit_item'             => __( 'Editar Cotización', 'colina-cotizaciones' ),
			'update_item'           => __( 'Actualizar Cotización', 'colina-cotizaciones' ),
			'view_item'             => __( 'Ver Cotización', 'colina-cotizaciones' ),
			'view_items'            => __( 'Ver Cotizaciones', 'colina-cotizaciones' ),
			'search_items'          => __( 'Buscar Cotización', 'colina-cotizaciones' ),
			'not_found'             => __( 'No encontrada', 'colina-cotizaciones' ),
			'not_found_in_trash'    => __( 'No encontrada en la papelera', 'colina-cotizaciones' ),
			'featured_image'        => __( 'Imagen Destacada', 'colina-cotizaciones' ),
			'set_featured_image'    => __( 'Establecer imagen destacada', 'colina-cotizaciones' ),
			'remove_featured_image' => __( 'Eliminar imagen destacada', 'colina-cotizaciones' ),
			'use_featured_image'    => __( 'Usar como imagen destacada', 'colina-cotizaciones' ),
			'insert_into_item'      => __( 'Insertar en Cotización', 'colina-cotizaciones' ),
			'uploaded_to_this_item' => __( 'Subido a esta Cotización', 'colina-cotizaciones' ),
			'items_list'            => __( 'Lista de Cotizaciones', 'colina-cotizaciones' ),
			'items_list_navigation' => __( 'Navegación de lista de Cotizaciones', 'colina-cotizaciones' ),
			'filter_items_list'     => __( 'Filtrar lista de Cotizaciones', 'colina-cotizaciones' ),
		);

		$args = array(
			'label'               => __( 'Cotización', 'colina-cotizaciones' ),
			'description'         => __( 'Tickets de cotización con geolocalización', 'colina-cotizaciones' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'custom-fields' ),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-clipboard',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'post',
			'capabilities'        => array(
				'create_posts' => 'do_not_allow',
			),
			'map_meta_cap'        => true,
			'show_in_rest'        => false,
		);

		register_post_type( 'cotizacion', $args );

		if ( is_admin() ) {
			add_filter( 'manage_cotizacion_posts_columns', array( $this, 'add_custom_columns' ) );
			add_action( 'manage_cotizacion_posts_custom_column', array( $this, 'render_custom_columns' ), 10, 2 );
			add_filter( 'manage_edit-cotizacion_sortable_columns', array( $this, 'make_columns_sortable' ) );
			add_action( 'pre_get_posts', array( $this, 'handle_sortable_columns_query' ) );
			add_filter( 'post_row_actions', array( $this, 'remove_row_actions' ), 10, 2 );
		}
	}

	/**
	 *
	 * @param array
	 * @return array
	 */
	public function add_custom_columns( $columns ) {
		$new_columns = array();

		$new_columns['cb']               = $columns['cb'];
		$new_columns['ticket_number']    = __( 'Ticket N°', 'colina-cotizaciones' );
		$new_columns['title']            = __( 'Email', 'colina-cotizaciones' );
		$new_columns['status']           = __( 'Estado', 'colina-cotizaciones' );
		$new_columns['location']         = __( 'Ubicación', 'colina-cotizaciones' );
		$new_columns['date']             = __( 'Fecha', 'colina-cotizaciones' );

		return $new_columns;
	}

	/**
	 *
	 * @param string 
	 * @param int    
	 * @return void
	 */
	public function render_custom_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'ticket_number':
				$ticket = get_post_meta( $post_id, 'ticket_number', true );
				if ( $ticket ) {
					echo '<strong>' . esc_html( $ticket ) . '</strong>';
				} else {
					echo '<em>' . esc_html__( 'Sin asignar', 'colina-cotizaciones' ) . '</em>';
				}
				break;

			case 'status':
				$statuses = array(
					'pending'   => __( 'Pendiente', 'colina-cotizaciones' ),
					'approved'  => __( 'Aprobado', 'colina-cotizaciones' ),
					'rejected'  => __( 'Rechazado', 'colina-cotizaciones' ),
					'completed' => __( 'Completado', 'colina-cotizaciones' ),
				);

				$current_status = get_post_meta( $post_id, 'status', true );
				if ( empty( $current_status ) ) {
					$current_status = 'pending';
				}

				$label = isset( $statuses[ $current_status ] ) ? $statuses[ $current_status ] : ucfirst( $current_status );

				printf(
					'<span class="cc-status cc-status--%s">%s</span>',
					esc_attr( $current_status ),
					esc_html( $label )
				);
				break;

			case 'location':
				$lat = get_post_meta( $post_id, 'latitude', true );
				$lng = get_post_meta( $post_id, 'longitude', true );

				if ( ! empty( $lat ) && ! empty( $lng ) ) {
					$map_url = add_query_arg(
						array(
							'q' => rawurlencode( $lat . ',' . $lng ),
						),
						'https://www.google.com/maps'
					);
					printf(
						'<a href="%s" target="_blank" rel="noopener noreferrer">%s, %s</a>',
						esc_url( $map_url ),
						esc_html( $lat ),
						esc_html( $lng )
					);
				} else {
					echo '<em>' . esc_html__( 'Sin ubicación', 'colina-cotizaciones' ) . '</em>';
				}
				break;
		}
	}

	/**
	 *
	 * @param array 
	 * @return array
	 */
	public function make_columns_sortable( $columns ) {
		$columns['ticket_number'] = 'ticket_number';
		$columns['status']        = 'status';
		return $columns;
	}

	/**
	 *
	 * @param 
	 * @return void
	 */
	public function handle_sortable_columns_query( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}

		$orderby = $query->get( 'orderby' );

		if ( 'ticket_number' === $orderby ) {
			$query->set( 'meta_key', 'ticket_number' );
			$query->set( 'orderby', 'meta_value' );
		}

		if ( 'status' === $orderby ) {
			$query->set( 'meta_key', 'status' );
			$query->set( 'orderby', 'meta_value' );
		}
	}

	/**
	 *
	 * @param array  $actions
	 * @param object $post
	 * @return array
	 */
	public function remove_row_actions( $actions, $post ) {
		if ( 'cotizacion' !== $post->post_type ) {
			return $actions;
		}

		unset( $actions['edit'] );
		unset( $actions['inline hide-if-no-js'] );

		return $actions;
	}
}
