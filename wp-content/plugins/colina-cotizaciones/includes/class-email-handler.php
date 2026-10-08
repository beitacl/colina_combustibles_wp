<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CC_Email_Handler {

	public function register() {
		add_action( 'wp_ajax_procesar_cotizacion_indsro', array( $this, 'process' ) );
		add_action( 'wp_ajax_nopriv_procesar_cotizacion_indsro', array( $this, 'process' ) );
	}

	public function process() {
		if ( ! isset( $_POST['seguridad_cotizador'] ) || ! wp_verify_nonce( sanitize_key( $_POST['seguridad_cotizador'] ), 'nonce_cotizador_indsro' ) ) {
			wp_send_json_error( 'Error de seguridad. Intente recargar la página.' );
		}

		$razon_social = sanitize_text_field( wp_unslash( $_POST['razon_social'] ?? '' ) );
		$nit          = sanitize_text_field( wp_unslash( $_POST['nit'] ?? '' ) );
		$telefono     = sanitize_text_field( wp_unslash( $_POST['telefono'] ?? '' ) );
		$correo       = sanitize_email( wp_unslash( $_POST['correo'] ?? '' ) );
		$contacto     = sanitize_text_field( wp_unslash( $_POST['contacto'] ?? '' ) );
		$relacion     = sanitize_text_field( wp_unslash( $_POST['relacion'] ?? '' ) );
		$producto     = sanitize_text_field( wp_unslash( $_POST['producto'] ?? '' ) );
		$cantidad     = sanitize_text_field( wp_unslash( $_POST['cantidad'] ?? '' ) );
		$envase       = sanitize_text_field( wp_unslash( $_POST['envase'] ?? '' ) );
		$cisterna     = sanitize_text_field( wp_unslash( $_POST['requiere_cisterna'] ?? '' ) );
		$origen       = sanitize_text_field( wp_unslash( $_POST['origen'] ?? '' ) );
		$destino      = sanitize_text_field( wp_unslash( $_POST['destino'] ?? '' ) );
		$ciudad       = sanitize_text_field( wp_unslash( $_POST['ciudad'] ?? '' ) );
		$estado_prov  = sanitize_text_field( wp_unslash( $_POST['estado_provincia'] ?? '' ) );

		$para    = get_option( 'admin_email' );
		$asunto  = 'Nueva Solicitud de Cotización - ' . $razon_social;

		$mensaje  = '<h3>Se ha recibido una nueva solicitud de cotización</h3>';
		$mensaje .= '<strong>DATOS DEL SOLICITANTE:</strong><br>';
		$mensaje .= 'Razón Social: ' . esc_html( $razon_social ) . '<br>';
		$mensaje .= 'NIT: ' . esc_html( $nit ) . '<br>';
		$mensaje .= 'Teléfono: ' . esc_html( $telefono ) . '<br>';
		$mensaje .= 'Correo: ' . esc_html( $correo ) . '<br>';
		$mensaje .= 'Contacto: ' . esc_html( $contacto ) . '<br>';
		$mensaje .= 'Relación: ' . esc_html( $relacion ) . '<br><br>';

		$mensaje .= '<strong>DATOS DEL PRODUCTO:</strong><br>';
		$mensaje .= 'Producto Solicitado: ' . esc_html( $producto ) . '<br>';
		$mensaje .= 'Cantidad (Litros): ' . esc_html( $cantidad ) . '<br>';
		$mensaje .= 'Envase: ' . esc_html( $envase ) . '<br>';
		$mensaje .= '¿Requiere Cisterna?: ' . esc_html( $cisterna ) . '<br>';
		$mensaje .= 'Origen: ' . esc_html( $origen ) . '<br><br>';

		if ( 'Si' === $cisterna ) {
			$mensaje .= '<strong>DESTINO DE LA CISTERNA:</strong><br>';
			$mensaje .= 'Destino: ' . esc_html( $destino ) . '<br>';
			$mensaje .= 'Ciudad: ' . esc_html( $ciudad ) . '<br>';
			$mensaje .= 'Estado/Provincia: ' . esc_html( $estado_prov ) . '<br>';
		}

		$headers   = array( 'Content-Type: text/html; charset=UTF-8' );
		$headers[] = 'Reply-To: ' . $correo;

		$enviado = wp_mail( $para, $asunto, $mensaje, $headers );

		if ( $enviado ) {
			wp_send_json_success( '¡Gracias! Su solicitud de cotización se ha enviado correctamente.' );
		} else {
			wp_send_json_error( 'Hubo un error al enviar el correo. Por favor verifica la configuración de WP Mail SMTP.' );
		}
	}
}
