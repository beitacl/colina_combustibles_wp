<?php
/**
 * Plugin Name:     Colina Cotizaciones
 * Description:     Sistema de tickets personalizado para cotizaciones con geolocalización
 * Version:         1.0.0
 * Author:          jicopa
 * License:         GPL-2.0+
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     colina-cotizaciones
 * Domain Path:     /languages
 *
 * @package         Colina_Cotizaciones
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CC_VERSION', '1.0.16' );
define( 'CC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'COLINA_SHOW_DEV_BANNER', true );
// Servicio de geocodificación (reverse geocoding).
// Por ahora: Nominatim PÚBLICO para descartar problemas del gateway de Eddy.
// Para volver al gateway de Eddy: cambiar la URL y descomentar el token.
define( 'COLINA_NOMINATIM_URL', 'https://nominatim.openstreetmap.org' );
// define( 'COLINA_NOMINATIM_TOKEN', 'COLCOM_3104d2df2e0dc90419534558e53c573ca9f502574cf108e206abb64d56d0d90b' );

require_once CC_PLUGIN_DIR . 'includes/class-cpt-cotizaciones.php';
require_once CC_PLUGIN_DIR . 'includes/class-cpt-estaciones.php';
require_once CC_PLUGIN_DIR . 'includes/class-meta-boxes.php';
require_once CC_PLUGIN_DIR . 'includes/class-acf-fields.php';
require_once CC_PLUGIN_DIR . 'includes/class-shortcode-cotizador.php';
require_once CC_PLUGIN_DIR . 'includes/class-email-handler.php';
require_once CC_PLUGIN_DIR . 'includes/class-modal-estaciones.php';

function cc_backend_url() {
	return defined( 'COLINA_BACKEND_URL' )
		? COLINA_BACKEND_URL
		: 'http://colprbk.kernotec.com:48080';
}

function cc_activate() {
	require_once CC_PLUGIN_DIR . 'includes/class-cpt-cotizaciones.php';
	$cpt = new CC_CPT_Cotizaciones();
	$cpt->register();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'cc_activate' );

function cc_deactivate() {
	flush_rewrite_rules();
	wp_clear_scheduled_hook( 'cc_monthly_ubicaciones_update' );
}
register_deactivation_hook( __FILE__, 'cc_deactivate' );

function cc_init() {
	$cpt_cotizaciones = new CC_CPT_Cotizaciones();
	$cpt_cotizaciones->register();

	$cpt_estaciones = new CC_CPT_Estaciones();
	$cpt_estaciones->register();

	$meta_boxes = new CC_Meta_Boxes();
	$meta_boxes->register();

	$acf_fields = new CC_ACF_Fields();
	$acf_fields->register();

	$shortcode = new CC_Shortcode_Cotizador();
	$shortcode->register();

	$email_handler = new CC_Email_Handler();
	$email_handler->register();

	$modales = new CC_Modal_Estaciones();
	$modales->register();
}
add_action( 'init', 'cc_init' );

function cc_enqueue_admin_assets( $hook ) {
	wp_enqueue_style(
		'cc-admin-css',
		CC_PLUGIN_URL . 'assets/css/colina-admin.css',
		array(),
		CC_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'cc_enqueue_admin_assets' );

function cc_admin_dev_banner( $wp_admin_bar ) {
	$wp_admin_bar->add_node( array(
		'id'    => 'cc-dev-banner',
		'title' => '<span class="dashicons dashicons-warning" style="font-family:dashicons;font-size:16px;width:16px;height:16px;vertical-align:text-bottom;margin-right:4px;"></span> Ambiente pruebas — sitio en desarrollo',
		'href'  => false,
		'meta'  => array(
			'class' => 'cc-dev-banner-node',
		),
	) );
}
add_action( 'admin_bar_menu', 'cc_admin_dev_banner', 1 );

function cc_render_dev_banner() {
	if ( ! COLINA_SHOW_DEV_BANNER ) {
		return;
	}
	if ( is_admin() ) {
		return;
	}
	echo '<div class="colina-dev-banner"><span class="cc-dev-icon">⚠️</span> Ambiente de Pruebas — Sitio en desarrollo</div>';
}
add_action( 'wp_body_open', 'cc_render_dev_banner' );

function cc_enqueue_frontend_assets() {
	wp_enqueue_style(
		'cc-modales-css',
		CC_PLUGIN_URL . 'assets/css/modales.css',
		array(),
		CC_VERSION
	);

	wp_enqueue_style(
		'cc-cotizador-css',
		CC_PLUGIN_URL . 'assets/css/cotizador.css',
		array(),
		CC_VERSION
	);

	wp_enqueue_style(
		'leaflet-css',
		CC_PLUGIN_URL . 'assets/leaflet/leaflet.css',
		array(),
		'1.9.4'
	);

	wp_enqueue_style(
		'sweetalert2-css',
		'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css',
		array(),
		'11'
	);

	wp_enqueue_script(
		'leaflet-js',
		CC_PLUGIN_URL . 'assets/leaflet/leaflet.js',
		array(),
		'1.9.4',
		true
	);

	wp_enqueue_script(
		'sweetalert2-js',
		'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js',
		array(),
		'11',
		true
	);

	wp_enqueue_script(
		'cc-colina-maps',
		CC_PLUGIN_URL . 'assets/js/colina-maps.js',
		array( 'leaflet-js', 'sweetalert2-js', 'jquery' ),
		CC_VERSION,
		true
	);

	wp_enqueue_script(
		'cc-colina-frontend',
		CC_PLUGIN_URL . 'assets/js/colina-frontend.js',
		array( 'jquery', 'sweetalert2-js' ),
		CC_VERSION,
		true
	);

	wp_localize_script(
		'cc-colina-maps',
		'ccSettings',
		array(
			'pluginUrl' => CC_PLUGIN_URL,
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
		)
	);

	wp_localize_script(
		'cc-colina-frontend',
		'cc_ajax',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);

	if ( COLINA_SHOW_DEV_BANNER && ! is_admin() ) {
		$banner_css = '
		.colina-dev-banner {
			position: fixed;
			top: 110px;
			left: 0;
			width: 100%;
			z-index: 999;
			background-color: #b8860b;
			color: #fff;
			text-align: center;
			font-weight: bold;
			padding: 4px 0;
			font-size: 13px;
			letter-spacing: 0.3px;
		}
		.colina-dev-banner .cc-dev-icon {
			filter: grayscale(1);
		}
		.admin-bar .colina-dev-banner {
			top: 142px;
		}
		';
		wp_add_inline_style( 'cc-modales-css', $banner_css );
	}
}
add_action( 'wp_enqueue_scripts', 'cc_enqueue_frontend_assets' );

function cc_procesar_ticket_cotizacion( $record, $ajax_handler ) {
	$form_name = $record->get_form_settings( 'form_name' );

	$fields = $record->get( 'fields' );
	if ( ! is_array( $fields ) ) {
		$fields = array();
	}

	$form_data = array();
	$email     = '';
	$latitude  = '';
	$longitude = '';

	$has_location = false;
	foreach ( $fields as $field_id => $field ) {
		$value = $field['value'];
		$form_data[ $field_id ] = $value;

		if ( 'email' === $field['type'] && ! empty( $value ) ) {
			$email = sanitize_email( $value );
		}
	}

	if ( isset( $_POST['form_fields']['latitude'] ) && ! empty( $_POST['form_fields']['latitude'] ) ) {
		$latitude = sanitize_text_field( wp_unslash( $_POST['form_fields']['latitude'] ) );
		$has_location = true;
	} elseif ( isset( $_POST['latitude'] ) ) {
		$latitude = sanitize_text_field( wp_unslash( $_POST['latitude'] ) );
		$has_location = true;
	}

	if ( isset( $_POST['form_fields']['longitude'] ) && ! empty( $_POST['form_fields']['longitude'] ) ) {
		$longitude = sanitize_text_field( wp_unslash( $_POST['form_fields']['longitude'] ) );
		$has_location = true;
	} elseif ( isset( $_POST['longitude'] ) ) {
		$longitude = sanitize_text_field( wp_unslash( $_POST['longitude'] ) );
		$has_location = true;
	}

	$form_name_normalized = strtolower( remove_accents( $form_name ) );

	// Solo procesar forms que tienen campos de cotización (razon_social, nit, prod_selector)
	$es_form_cotizacion = isset( $form_data['razon_social'] ) || isset( $form_data['nit'] ) || isset( $form_data['prod_selector'] );
	if ( ! $es_form_cotizacion ) {
		error_log( '[Colina Cotizaciones] Form NO es de cotización, ignorado. Form name: ' . $form_name );
		return;
	}

	// Red de seguridad: la cantidad mínima es 5.000 litros y debe ser múltiplo de 500.
	if ( isset( $form_data['prod_cantidad'] ) && '' !== trim( (string) $form_data['prod_cantidad'] ) ) {
		$cantidad = floatval( $form_data['prod_cantidad'] );
		if ( $cantidad < 5000 || fmod( $cantidad, 500 ) !== 0.0 ) {
			$ajax_handler->add_error_message( 'La cantidad mínima es 5.000 litros y debe ser múltiplo de 500.' );
			return;
		}
	}
	error_log( '[Colina Cotizaciones] Procesando form: ' . $form_name . ' | campos: ' . wp_json_encode( array_keys( $form_data ) ) );

	if ( empty( $email ) ) {
		$possible_email_keys = array( 'email', 'e-mail', 'correo', 'correo_electronico' );
		foreach ( $possible_email_keys as $key ) {
			if ( isset( $form_data[ $key ] ) && is_email( $form_data[ $key ] ) ) {
				$email = sanitize_email( $form_data[ $key ] );
				break;
			}
		}
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'cotizacion',
			'post_title'  => 'Cotización pendiente',
			'post_status' => 'publish',
		),
		true
	);

	if ( is_wp_error( $post_id ) ) {
		$ajax_handler->add_error_message( __( 'Error al crear el ticket de cotización.', 'colina-cotizaciones' ) );
		return;
	}

	$next          = (int) get_option( 'colina_cotizaciones_next_ticket', 1 );
	$ticket_number = 'TKT-' . str_pad( (string) $next, 4, '0', STR_PAD_LEFT );
	update_option( 'colina_cotizaciones_next_ticket', $next + 1 );

	if ( empty( $email ) ) {
		$email = __( 'Sin datos registrados por el cliente', 'colina-cotizaciones' );
	}

	$title = $ticket_number . ' - ' . $email;
	wp_update_post(
		array(
			'ID'         => $post_id,
			'post_title' => $title,
		)
	);

	update_post_meta( $post_id, 'ticket_number', $ticket_number );

	foreach ( $form_data as $key => $value ) {
		if ( is_array( $value ) ) {
			$value = implode( ', ', $value );
		}

		$value = preg_replace( '/\s*---\s*Ubicaci[oó]n seleccionada:.*$/si', '', (string) $value );
		update_post_meta( $post_id, 'form_' . $key, sanitize_text_field( $value ) );
	}

	if ( ! empty( $latitude ) && ! empty( $longitude ) ) {
		update_post_meta( $post_id, 'latitude', $latitude );
		update_post_meta( $post_id, 'longitude', $longitude );
	}

	// Enviar solicitud al backend
	$api_code = cc_enviar_cotizacion_al_backend( $form_data, $latitude, $longitude );
	if ( ! empty( $api_code ) ) {
		$ticket_number = $api_code;
		update_post_meta( $post_id, 'ticket_number', $ticket_number );
	}

	if ( method_exists( $ajax_handler, 'add_response_data' ) ) {
		$ajax_handler->add_response_data(
			'success_message',
			sprintf(
				__( '¡Gracias! Su ticket de cotización ha sido creado con el número %s. Pronto recibirá una respuesta.', 'colina-cotizaciones' ),
				$ticket_number
			)
		);

		$ajax_handler->add_response_data(
			'ticket_number',
			$ticket_number
		);
	}
}
add_action( 'elementor_pro/forms/new_record', 'cc_procesar_ticket_cotizacion', 10, 2 );

add_action( 'wp_ajax_nopriv_cc_get_products', 'cc_ajax_get_products' );
add_action( 'wp_ajax_cc_get_products', 'cc_ajax_get_products' );

function cc_ajax_get_products() {
	$url = cc_backend_url() . '/api/v1/public/products';
	$res = wp_remote_get( $url, array( 'timeout' => 15 ) );

	if ( is_wp_error( $res ) ) {
		wp_send_json_error( array( 'message' => 'Error de conexión' ), 500 );
	}

	$code = wp_remote_retrieve_response_code( $res );
	$body = wp_remote_retrieve_body( $res );

	if ( 200 !== $code ) {
		wp_send_json_error( array( 'message' => 'Error del servidor', 'code' => $code ), $code );
	}

	header( 'Content-Type: application/json' );
	echo $body;
	exit;
}

function cc_nominatim_url() {
	return defined( 'COLINA_NOMINATIM_URL' )
		? rtrim( COLINA_NOMINATIM_URL, '/' )
		: 'https://nominatim.openstreetmap.org';
}

function cc_nominatim_token() {
	return defined( 'COLINA_NOMINATIM_TOKEN' ) ? COLINA_NOMINATIM_TOKEN : '';
}

add_action( 'wp_ajax_nopriv_cc_get_address', 'cc_ajax_get_address' );
add_action( 'wp_ajax_cc_get_address', 'cc_ajax_get_address' );

function cc_ajax_get_address() {
	$lat = isset( $_REQUEST['lat'] ) ? floatval( $_REQUEST['lat'] ) : 0;
	$lng = isset( $_REQUEST['lng'] ) ? floatval( $_REQUEST['lng'] ) : 0;

	if ( ! $lat || ! $lng || $lat < -90 || $lat > 90 || $lng < -180 || $lng > 180 ) {
		wp_send_json_error( array( 'message' => 'Coordenadas inválidas' ), 400 );
	}

	$cache_key = 'cc_addr_' . md5( (string) round( $lat, 4 ) . ',' . (string) round( $lng, 4 ) );
	$cached    = get_transient( $cache_key );
	if ( false !== $cached ) {
		wp_send_json_success( $cached );
	}

	$url = add_query_arg(
		array(
			'format'          => 'json',
			'addressdetails'  => 1,
			'accept-language' => 'es',
			'lat'             => $lat,
			'lon'             => $lng,
			'zoom'            => 18,
		),
		cc_nominatim_url() . '/reverse'
	);

	$headers = array( 'User-Agent' => 'Colina-WP/1.0 (form de cotizaciones)' );
	$token   = cc_nominatim_token();
	if ( '' !== $token ) {
		$headers['x-api-token'] = $token;
	}

	$res = wp_remote_get(
		$url,
		array(
			'timeout' => 10,
			'headers' => $headers,
		)
	);

	if ( is_wp_error( $res ) ) {
		wp_send_json_error( array( 'message' => 'Error de conexión con el geocodificador' ), 502 );
	}

	$code = wp_remote_retrieve_response_code( $res );
	if ( 200 !== $code ) {
		wp_send_json_error( array( 'message' => 'El geocodificador respondió HTTP ' . $code ), 502 );
	}

	$body = json_decode( wp_remote_retrieve_body( $res ), true );
	if ( ! is_array( $body ) || isset( $body['error'] ) ) {
		wp_send_json_error( array( 'message' => 'Sin resultados para esas coordenadas' ), 404 );
	}

	$addr = isset( $body['address'] ) && is_array( $body['address'] ) ? $body['address'] : array();

	$data = array(
		'address'     => isset( $body['display_name'] ) ? sanitize_text_field( $body['display_name'] ) : '',
		'road'        => isset( $addr['road'] ) ? sanitize_text_field( $addr['road'] ) : '',
		'department'  => isset( $addr['state'] ) ? sanitize_text_field( $addr['state'] ) : '',
		'province'    => isset( $addr['province'] ) ? sanitize_text_field( $addr['province'] )
			: ( isset( $addr['county'] ) ? sanitize_text_field( $addr['county'] ) : '' ),
		'municipality' => isset( $addr['city'] ) ? sanitize_text_field( $addr['city'] )
			: ( isset( $addr['municipality'] ) ? sanitize_text_field( $addr['municipality'] )
				: ( isset( $addr['town'] ) ? sanitize_text_field( $addr['town'] )
					: ( isset( $addr['village'] ) ? sanitize_text_field( $addr['village'] ) : '' ) ) ),
	);

	set_transient( $cache_key, $data, 30 * DAY_IN_SECONDS );
	wp_send_json_success( $data );
}

add_action( 'wp_ajax_nopriv_cc_get_search', 'cc_ajax_get_search' );
add_action( 'wp_ajax_cc_get_search', 'cc_ajax_get_search' );

function cc_ajax_get_search() {
	$q = isset( $_REQUEST['q'] ) ? trim( sanitize_text_field( wp_unslash( $_REQUEST['q'] ) ) ) : '';
	if ( strlen( $q ) < 2 ) {
		wp_send_json_error( array( 'message' => 'Consulta muy corta' ), 400 );
	}

	$params = array(
		'q'              => $q,
		'limit'          => 8,
		'format'         => 'json',
		'addressdetails' => 1,
		'countrycodes'   => 'bo',
	);

	// Si el usuario ya eligió un departamento en la cascada, restringir la búsqueda
	// para desambiguar nombres repetidos (ej. "Sopocachi" existe en varios lugares).
	if ( isset( $_REQUEST['state'] ) && '' !== $_REQUEST['state'] ) {
		$params['state'] = sanitize_text_field( wp_unslash( $_REQUEST['state'] ) );
	}

	$url = add_query_arg( $params, cc_nominatim_url() . '/search' );

	$headers = array( 'User-Agent' => 'Colina-WP/1.0 (buscador de ubicaciones)' );
	$token   = cc_nominatim_token();
	if ( '' !== $token ) {
		$headers['x-api-token'] = $token;
	}

	$res = wp_remote_get( $url, array( 'timeout' => 10, 'headers' => $headers ) );

	if ( is_wp_error( $res ) ) {
		wp_send_json_error( array( 'message' => 'Error de conexión con el buscador' ), 502 );
	}

	$code = wp_remote_retrieve_response_code( $res );
	if ( 200 !== $code ) {
		wp_send_json_error( array( 'message' => 'El buscador respondió HTTP ' . $code ), 502 );
	}

	$items = json_decode( wp_remote_retrieve_body( $res ), true );
	if ( ! is_array( $items ) ) {
		wp_send_json_error( array( 'message' => 'Sin resultados' ), 404 );
	}

	$results = array();
	foreach ( $items as $item ) {
		$addr = isset( $item['address'] ) && is_array( $item['address'] ) ? $item['address'] : array();
		$results[] = array(
			'display_name' => isset( $item['display_name'] ) ? sanitize_text_field( $item['display_name'] ) : '',
			'lat'          => isset( $item['lat'] ) ? (float) $item['lat'] : 0,
			'lon'          => isset( $item['lon'] ) ? (float) $item['lon'] : 0,
			'department'   => isset( $addr['state'] ) ? sanitize_text_field( $addr['state'] ) : '',
			'province'     => isset( $addr['province'] ) ? sanitize_text_field( $addr['province'] )
				: ( isset( $addr['county'] ) ? sanitize_text_field( $addr['county'] ) : '' ),
			'municipality' => isset( $addr['city'] ) ? sanitize_text_field( $addr['city'] )
				: ( isset( $addr['municipality'] ) ? sanitize_text_field( $addr['municipality'] )
					: ( isset( $addr['town'] ) ? sanitize_text_field( $addr['town'] )
						: ( isset( $addr['village'] ) ? sanitize_text_field( $addr['village'] ) : '' ) ) ),
		);
	}

	wp_send_json_success( $results );
}

function cc_enviar_cotizacion_al_backend( $form_data, $latitude, $longitude ) {
	$api_url = cc_backend_url() . '/api/v1/public/quote-requests';

	// Log para depuración: ver qué campos están llegando del form
	error_log( '[Colina Cotizaciones] form_data recibido: ' . wp_json_encode( array_keys( $form_data ) ) );

	// Cada formulario usa IDs de email/teléfono distintos según el tipo de cliente:
	// EMPRESA → email_personContact / telefono_personContact (el único email del form)
	// INDEPENDIENTE → email_cliente / telefono_cliente
	$es_empresa = isset( $form_data['customer_type'] ) && 'EMPRESA' === strtoupper( (string) $form_data['customer_type'] );

	if ( $es_empresa ) {
		$email_customer = isset( $form_data['email_personContact'] ) ? sanitize_email( $form_data['email_personContact'] ) : '';
		$phone_customer = isset( $form_data['telefono_personContact'] ) ? sanitize_text_field( $form_data['telefono_personContact'] ) : '';
	} else {
		$email_customer = isset( $form_data['email_cliente'] ) ? sanitize_email( $form_data['email_cliente'] ) : '';
		$phone_customer = isset( $form_data['telefono_cliente'] ) ? sanitize_text_field( $form_data['telefono_cliente'] ) : '';
	}

	$payload = array(
		'businessName'      => isset( $form_data['razon_social'] ) ? sanitize_text_field( $form_data['razon_social'] ) : '',
		'customerType'      => isset( $form_data['customer_type'] ) ? sanitize_text_field( $form_data['customer_type'] ) : '',
		'nit'               => isset( $form_data['nit'] ) ? sanitize_text_field( $form_data['nit'] ) : '',
		'address'           => isset( $form_data['direccion'] ) ? sanitize_text_field( $form_data['direccion'] ) : '',
		'department'        => isset( $form_data['departamento'] ) ? sanitize_text_field( $form_data['departamento'] ) : '',
		'contactPerson'     => isset( $form_data['full_name'] ) ? sanitize_text_field( $form_data['full_name'] ) : '',
		'phoneCustomer'     => $phone_customer,
		'phoneContact'      => isset( $form_data['telefono_personContact'] ) ? sanitize_text_field( $form_data['telefono_personContact'] ) : '',
		'emailCustomer'     => $email_customer,
		'emailContact'      => isset( $form_data['email_personContact'] ) ? sanitize_email( $form_data['email_personContact'] ) : '',
		'contactRelation'   => isset( $form_data['relacion_empresa'] ) ? sanitize_text_field( $form_data['relacion_empresa'] ) : '',
		'productType'       => isset( $form_data['prod_selector'] ) ? sanitize_text_field( $form_data['prod_selector'] ) : '',
		'quantityLiters'    => isset( $form_data['prod_cantidad'] ) ? sanitize_text_field( $form_data['prod_cantidad'] ) : '',
		'deliveryDate'      => isset( $form_data['fecha_entrega'] ) ? sanitize_text_field( $form_data['fecha_entrega'] ) : '',
		'requiresTanker'    => isset( $form_data['prod_req_b'] )
			&& 'SI' === strtoupper( trim( (string) $form_data['prod_req_b'] ) ) ? true : false,
		'deliveryLatitude'  => ! empty( $latitude ) ? floatval( $latitude ) : null,
		'deliveryLongitude' => ! empty( $longitude ) ? floatval( $longitude ) : null,
		'deliveryAddress'   => isset( $form_data['delivery_address'] ) ? sanitize_text_field( $form_data['delivery_address'] ) : '',
	);

	$response = wp_remote_post(
		$api_url,
		array(
			'headers' => array( 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode( $payload ),
			'timeout' => 15,
		)
	);

	if ( is_wp_error( $response ) ) {
		error_log( '[Colina Cotizaciones] Error al enviar a backend: ' . $response->get_error_message() );
		return '';
	}

	$status_code = wp_remote_retrieve_response_code( $response );
	$body        = wp_remote_retrieve_body( $response );

	if ( 201 !== $status_code ) {
		error_log( '[Colina Cotizaciones] Backend retornó HTTP ' . $status_code . ': ' . $body );
		return '';
	}

	$json = json_decode( $body, true );
	if ( ! empty( $json['data']['code'] ) ) {
		return sanitize_text_field( $json['data']['code'] );
	}

	return '';
}
