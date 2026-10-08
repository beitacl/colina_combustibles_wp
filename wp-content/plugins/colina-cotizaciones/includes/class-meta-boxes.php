<?php
/**
 *
 * @package         Colina_Cotizaciones
 * @since           1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}


class CC_Meta_Boxes {

	/**
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'edit_form_after_title', array( $this, 'render_admin_panel' ) );
		add_action( 'save_post_cotizacion', array( $this, 'save_status' ), 10, 2 );
	}

	/**
	 *
	 * @return void
	 */
	public function render_admin_panel( $post ) {
		if ( 'cotizacion' !== $post->post_type ) {
			return;
		}

		$ticket_number = get_post_meta( $post->ID, 'ticket_number', true );
		$latitude      = get_post_meta( $post->ID, 'latitude', true );
		$longitude     = get_post_meta( $post->ID, 'longitude', true );
		$status        = get_post_meta( $post->ID, 'status', true );

		if ( empty( $status ) ) {
			$status = 'pending';
		}

		$statuses = array(
			'pending'   => __( 'Pendiente', 'colina-cotizaciones' ),
			'approved'  => __( 'Aprobado', 'colina-cotizaciones' ),
			'rejected'  => __( 'Rechazado', 'colina-cotizaciones' ),
			'completed' => __( 'Completado', 'colina-cotizaciones' ),
		);

		wp_nonce_field( 'cc_meta_box_nonce', 'cc_meta_box_nonce' );
		?>

		<div class="cc-metabox-wrap cc-ticket-panel">
			<div class="cc-ticket-header">
				<div class="cc-ticket-number">
					<span class="cc-label"><?php esc_html_e( 'Ticket N°', 'colina-cotizaciones' ); ?>:</span>
					<strong class="cc-value"><?php echo esc_html( $ticket_number ? $ticket_number : __( 'Sin asignar', 'colina-cotizaciones' ) ); ?></strong>
				</div>
				<div class="cc-ticket-status">
					<label for="cc-status-select"><?php esc_html_e( 'Estado', 'colina-cotizaciones' ); ?>:</label>
					<select id="cc-status-select" name="cc_status">
						<?php foreach ( $statuses as $value => $label ) : ?>
							<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $status, $value ); ?>>
								<?php echo esc_html( $label ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<?php if ( ! empty( $latitude ) && ! empty( $longitude ) ) : ?>
				<div class="cc-location-section">
					<h3><?php esc_html_e( 'Ubicación', 'colina-cotizaciones' ); ?></h3>
					<p class="cc-coordinates">
						<?php esc_html_e( 'Latitud', 'colina-cotizaciones' ); ?>: <strong><?php echo esc_html( $latitude ); ?></strong>
						&nbsp;|&nbsp;
						<?php esc_html_e( 'Longitud', 'colina-cotizaciones' ); ?>: <strong><?php echo esc_html( $longitude ); ?></strong>
					</p>
					<p>
						<a
							href="<?php echo esc_url( 'https://www.google.com/maps?q=' . rawurlencode( $latitude . ',' . $longitude ) ); ?>"
							target="_blank"
							rel="noopener noreferrer"
							class="button button-secondary"
						>
							<span class="dashicons dashicons-location-alt" style="vertical-align: middle;"></span>
							<?php esc_html_e( 'Ver en Google Maps', 'colina-cotizaciones' ); ?>
						</a>
					</p>
				</div>
			<?php endif; ?>

			<div class="cc-form-fields-section">
				<h3><?php esc_html_e( 'Datos del Formulario', 'colina-cotizaciones' ); ?></h3>

				<?php
				$all_meta = get_post_meta( $post->ID );
				$form_fields = array();
				$field_map   = array(
					'name'            => array( 'form_name', 'name' ),
					'nit'             => array( 'form_nit', 'nit' ),
					'telefono'        => array( 'form_telefono', 'telefono' ),
					'email'           => array( 'form_email', 'email' ),
					'contacto'        => array( 'form_contacto', 'contacto' ),
					'relacion'        => array( 'form_relacion', 'relacion' ),
					'prod_selector'   => array( 'form_prod_selector', 'prod_selector' ),
					'prod_cantidad_gasolina' => array( 'form_prod_cantidad_gasolina', 'prod_cantidad_gasolina' ),
					'prod_cantidad_diesel'   => array( 'form_prod_cantidad_diesel', 'prod_cantidad_diesel' ),
					'prod_envase'     => array( 'form_prod_envase', 'prod_envase' ),
					'prod_req_b'      => array( 'form_prod_req_b', 'prod_req_b' ),
					'envio_destino'   => array( 'form_envio_destino', 'envio_destino' ),
					'envio_ciudad'    => array( 'form_envio_ciudad', 'envio_ciudad', 'field_0aa9ba3' ),
					'envio_estado'    => array( 'form_envio_estado', 'envio_estado', 'field_63874ad' ),
					'origen'          => array( 'form_origen', 'origen', 'field_4bfb7d7' ),
					'departamento'    => array( 'form_departamento', 'departamento' ),
					'provincia'       => array( 'form_provincia', 'provincia' ),
					'municipio'       => array( 'form_municipio', 'municipio' ),
					'direccion'       => array( 'form_direccion', 'direccion' ),
				);

				foreach ( $field_map as $field_key => $meta_keys ) {
					$field_value = '';

					foreach ( $meta_keys as $meta_key ) {
						if ( isset( $all_meta[ $meta_key ] ) ) {
							$raw_value = $all_meta[ $meta_key ];
							$field_value = is_array( $raw_value ) ? $raw_value[0] : $raw_value;
							break;
						}
					}

					if ( '' === $field_value ) {
						continue;
					}

					$form_fields[] = array(
						'label' => $this->get_field_label( $field_key ),
						'value' => $this->clean_field_value( $field_value, $field_key ),
					);
				}

				if ( ! empty( $form_fields ) ) :
					?>
					<table class="widefat striped cc-form-table">
						<thead>
							<tr>
								<th><?php esc_html_e( 'Campo', 'colina-cotizaciones' ); ?></th>
								<th><?php esc_html_e( 'Valor', 'colina-cotizaciones' ); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $form_fields as $field ) : ?>
								<tr>
									<td class="cc-field-label">
										<strong><?php echo esc_html( $field['label'] ); ?></strong>
									</td>
									<td class="cc-field-value">
										<?php echo esc_html( $field['value'] ); ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php else : ?>
					<table class="widefat striped cc-form-table cc-form-table--empty">
						<tbody>
							<tr>
								<td class="cc-field-label">
									<strong><?php esc_html_e( 'Formulario', 'colina-cotizaciones' ); ?></strong>
								</td>
								<td class="cc-field-value cc-field-value--empty">
									<?php esc_html_e( 'Sin datos registrados por el cliente', 'colina-cotizaciones' ); ?>
								</td>
							</tr>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>

		<?php
	}

	/**
	 *
	 * @param string 
	 * @return string
	 */
	private function get_field_label( $raw ) {
		$labels = array(
			'name'                   => __( 'Nombre', 'colina-cotizaciones' ),
			'nit'                    => __( 'Nit', 'colina-cotizaciones' ),
			'telefono'               => __( 'Teléfono', 'colina-cotizaciones' ),
			'email'                  => __( 'Correo Electrónico', 'colina-cotizaciones' ),
			'contacto'               => __( 'Contacto', 'colina-cotizaciones' ),
			'relacion'               => __( 'Relación', 'colina-cotizaciones' ),
			'prod_selector'          => __( 'Producto', 'colina-cotizaciones' ),
			'prod_cantidad_gasolina' => __( 'Cantidad de Gasolina', 'colina-cotizaciones' ),
			'prod_cantidad_diesel'   => __( 'Cantidad de Diesel', 'colina-cotizaciones' ),
			'prod_envase'            => __( 'Envase', 'colina-cotizaciones' ),
			'prod_req_b'             => __( '¿Requiere Cisterna?', 'colina-cotizaciones' ),
			'envio_destino'          => __( 'Destino', 'colina-cotizaciones' ),
			'envio_ciudad'           => __( 'Ciudad', 'colina-cotizaciones' ),
			'envio_estado'           => __( 'Estado / Provincia', 'colina-cotizaciones' ),
			'origen'                 => __( 'Origen', 'colina-cotizaciones' ),
			'field_0aa9ba3'          => __( 'Ciudad', 'colina-cotizaciones' ),
						'field_4bfb7d7'          => __( 'Origen seleccionado', 'colina-cotizaciones' ),
			'field_63874ad'          => __( 'Estado / Provincia', 'colina-cotizaciones' ),
			'departamento'           => __( 'Departamento', 'colina-cotizaciones' ),
			'provincia'              => __( 'Provincia', 'colina-cotizaciones' ),
			'municipio'              => __( 'Municipio', 'colina-cotizaciones' ),
			'direccion'              => __( 'Dirección', 'colina-cotizaciones' ),
		);

		if ( isset( $labels[ $raw ] ) ) {
			return $labels[ $raw ];
		}

		$name = str_replace( array( '_', '-' ), ' ', $raw );
		$name = ucwords( $name );
		$name = str_replace( 'Url', 'URL', $name );

		return $name;
	}

	/**
	 *
	 * @param string $raw
	 * @param string $field_key
	 * @return string
	 */
	private function clean_field_value( $raw, $field_key = '' ) {
		$value = trim( (string) $raw );

		if ( 'envio_estado' === $field_key || 'field_63874ad' === $field_key ) {
			$value = html_entity_decode( $value, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
			$value = preg_replace( '/\s*[-—–]*\s*Ubicaci[oó]n\s+seleccionada\s*:\s*.*$/iu', '', $value );
			$value = preg_replace( '/\s*Lat\s*:?\s*-?\d+(?:\.\d+)?\s*,\s*Lng\s*:?\s*-?\d+(?:\.\d+)?\s*$/iu', '', $value );
			$value = preg_replace( '/\s*Mapa\s*:?\s*https?:\/\/\S+\s*$/iu', '', $value );
		}

		$value = trim( (string) $value );

		return $value;
	}

	/**
	 *
	 * @param int   
	 * @param 
	 * @return void
	 */
	public function save_status( $post_id, $post ) {
			if ( ! isset( $_POST['cc_meta_box_nonce'] )
			|| ! wp_verify_nonce( sanitize_key( $_POST['cc_meta_box_nonce'] ), 'cc_meta_box_nonce' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['cc_status'] ) ) {
			$status = sanitize_text_field( wp_unslash( $_POST['cc_status'] ) );
			$allowed_statuses = array( 'pending', 'approved', 'rejected', 'completed' );

			if ( in_array( $status, $allowed_statuses, true ) ) {
				update_post_meta( $post_id, 'status', $status );
			}
		}
	}
}
