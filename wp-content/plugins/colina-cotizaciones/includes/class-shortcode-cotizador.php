<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CC_Shortcode_Cotizador {

	public function register() {
		add_shortcode( 'cotizador_indsro', array( $this, 'render' ) );
	}

	public function render() {
		ob_start();
		$this->render_form();
		return ob_get_clean();
	}

	private function render_form() {
		$admin_url = admin_url( 'admin-ajax.php' );
		$nonce     = wp_create_nonce( 'nonce_cotizador_indsro' );
		?>
		<div class="indsro-cotizador-container">
			<form id="indsro-cotizador-form" action="<?php echo esc_url( $admin_url ); ?>" method="post" class="custom-indsro-form">
				<h4 class="section-title-cotizador" style="margin-top:0;">DATOS DEL SOLICITANTE</h4>
				<div class="row">
					<div class="col-md-6 form-group">
						<div class="tx-input-field">
							<span class="wpcf7-form-control-wrap">
								<input type="text" name="razon_social" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Razón social *" required>
							</span>
						</div>
					</div>
					<div class="col-md-6 form-group">
						<div class="tx-input-field">
							<span class="wpcf7-form-control-wrap">
								<input type="text" name="nit" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="NIT *" required>
							</span>
						</div>
					</div>
					<div class="col-md-6 form-group">
						<div class="tx-input-field">
							<span class="wpcf7-form-control-wrap">
								<input type="tel" name="telefono" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Número de teléfono *" required>
							</span>
						</div>
					</div>
					<div class="col-md-6 form-group">
						<div class="tx-input-field">
							<span class="wpcf7-form-control-wrap">
								<input type="email" name="correo" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Dirección de correo electrónico *" required>
							</span>
						</div>
					</div>
					<div class="col-md-6 form-group">
						<div class="tx-input-field">
							<span class="wpcf7-form-control-wrap">
								<input type="text" name="contacto" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Persona de contacto *" required>
							</span>
						</div>
					</div>
					<div class="col-md-6 form-group">
						<div class="tx-input-field">
							<span class="wpcf7-form-control-wrap">
								<input type="text" name="relacion" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Relación con la empresa *" required>
							</span>
						</div>
					</div>
				</div>

				<h4 class="section-title-cotizador">DATOS DEL PRODUCTO</h4>
				<div class="row">
					<div class="col-md-12 form-group">
						<div class="tx-input-field">
							<span class="wpcf7-form-control-wrap">
								<select name="producto" id="cotiza-producto" class="wpcf7-form-control wpcf7-select team-details-form-input" required>
									<option value="" disabled selected>Título - (Elegir Producto) *</option>
									<option value="Diesel ULSD">Diesel ULSD</option>
									<option value="Gasolina">Gasolina</option>
								</select>
							</span>
						</div>
					</div>
				</div>

				<div id="campos-producto" style="display:none;">
					<div class="row">
						<div class="col-md-6 form-group">
							<div class="tx-input-field">
								<span class="wpcf7-form-control-wrap">
									<input type="number" name="cantidad" id="cotiza-cantidad" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Cantidad (en litros) *">
								</span>
							</div>
						</div>
						<div class="col-md-6 form-group">
							<div class="tx-input-field">
								<span class="wpcf7-form-control-wrap">
									<select name="envase" class="wpcf7-form-control wpcf7-select team-details-form-input">
										<option value="" disabled selected>Envase *</option>
										<option value="Cisterna">Cisterna</option>
										<option value="Turril">Turril</option>
									</select>
								</span>
							</div>
						</div>
						<div class="col-md-6 form-group">
							<div class="tx-input-field">
								<span class="wpcf7-form-control-wrap">
									<select name="requiere_cisterna" id="cotiza-cisterna" class="wpcf7-form-control wpcf7-select team-details-form-input">
										<option value="" disabled selected>¿Requiere cisterna? *</option>
										<option value="Si">Sí</option>
										<option value="No">No</option>
									</select>
								</span>
							</div>
						</div>
						<div class="col-md-6 form-group">
							<div class="tx-input-field">
								<span class="wpcf7-form-control-wrap">
									<select name="origen" class="wpcf7-form-control wpcf7-select team-details-form-input">
										<option value="" disabled selected>Origen *</option>
										<option value="Alcasa">Alcasa</option>
										<option value="Senkata">Senkata</option>
									</select>
								</span>
							</div>
						</div>
					</div>
				</div>

				<div id="campos-destino" style="display:none;">
					<h5 class="section-title-cotizador" style="margin: 10px 0 20px;">Detalle de Destino</h5>
					<div class="row">
						<div class="col-md-4 form-group">
							<div class="tx-input-field">
								<span class="wpcf7-form-control-wrap">
									<input type="text" name="destino" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Destino">
								</span>
							</div>
						</div>
						<div class="col-md-4 form-group">
							<div class="tx-input-field">
								<span class="wpcf7-form-control-wrap">
									<input type="text" name="ciudad" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Ciudad">
								</span>
							</div>
						</div>
						<div class="col-md-4 form-group">
							<div class="tx-input-field">
								<span class="wpcf7-form-control-wrap">
									<input type="text" name="estado_provincia" class="wpcf7-form-control wpcf7-text team-details-form-input" placeholder="Estado o Provincia">
								</span>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-12">
						<div class="tx-btn-wrap" style="text-align: center;">
							<button type="submit" id="btn-enviar-cotizacion" class="wpcf7-form-control wpcf7-submit custom-indsro-btn cc-cotizador-submit-btn">ENVIAR DATOS PARA COTIZACIÓN</button>
						</div>
						<div class="cotizador-msg" id="cotizador-mensaje"></div>
					</div>
				</div>

				<input type="hidden" name="action" value="procesar_cotizacion_indsro">
				<input type="hidden" name="seguridad_cotizador" value="<?php echo esc_attr( $nonce ); ?>">
			</form>
		</div>
		<?php
	}
}
