<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CC_Modal_Estaciones {

	public function register() {
		add_action( 'wp_footer', array( $this, 'render_dashboard_modal' ) );
		add_action( 'wp_footer', array( $this, 'render_cotizacion_modal' ) );
		add_action( 'wp_footer', array( $this, 'render_page_form_templates' ) );
	}

	public function render_dashboard_modal() {
		if ( is_admin() ) {
			return;
		}

		$query = new WP_Query( array(
			'post_type'      => 'estacion',
			'posts_per_page' => -1,
			'order'          => 'ASC',
		) );

		$count = 0;
		?>
		<div id="cc-modal-dashboard-estaciones" class="modal-estaciones-overlay">
			<div class="modal-estaciones-container" onclick="event.stopPropagation()">
				<div class="modal-estaciones-header">
					<h3 class="modal-estaciones-title">
						<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
						</svg>
						<?php esc_html_e( 'Resumen de Estaciones', 'colina-cotizaciones' ); ?>
					</h3>
					<button class="modal-estaciones-close-btn" onclick="ccToggleDashboardEstaciones()">&times;</button>
				</div>

				<div class="modal-estaciones-body">
					<?php if ( ! $query->have_posts() ) : ?>
						<p style="color: #64748b; text-align: center; margin-top: 50px;"><?php esc_html_e( 'No hay estaciones configuradas.', 'colina-cotizaciones' ); ?></p>
					<?php else : ?>
						<div class="modal-estaciones-grid">
							<?php
							while ( $query->have_posts() ) {
								$query->the_post();
								$id     = get_the_ID();
								$nombre = get_the_title();
								$count++;

								$capacidad_max = floatval( get_field( 'capacidad_maxima', $id ) ) ?: 1;
								$disponibilidad = floatval( get_field( 'disponibilidad_actual', $id ) );
								$precio        = floatval( get_field( 'precio_unitario', $id ) );
								$link_llegar   = get_field( 'link_como_llegar', $id ) ?: '#';
								$ultima_act    = get_the_modified_date( 'Y-m-d H:i', $id );

								$porcentaje = round( ( $disponibilidad / $capacidad_max ) * 100 );

								if ( $porcentaje <= 15 ) {
									$color    = '#ef4444';
									$estado   = 'CRÍTICO';
									$bg_badge = 'rgba(239, 68, 68, 0.15)';
								} elseif ( $porcentaje <= 45 ) {
									$color    = '#f59e0b';
									$estado   = 'REVISIÓN';
									$bg_badge = 'rgba(245, 158, 11, 0.15)';
								} else {
									$color    = '#06b6d4';
									$estado   = 'NORMAL';
									$bg_badge = 'rgba(6, 182, 212, 0.15)';
								}
								?>
								<div class="estacion-card">
									<div class="estacion-card-location">
										<svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
											<path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
										</svg>
										<?php echo esc_html( $nombre ); ?>
									</div>
									<div class="estacion-card-row">
										<div class="estacion-card-badge" style="background: <?php echo esc_attr( $bg_badge ); ?>; border-left: 3px solid <?php echo esc_attr( $color ); ?>;">
											<div class="estacion-card-badge-val" style="color: <?php echo esc_attr( $color ); ?>;">
												<?php echo esc_html( $porcentaje ); ?>%
											</div>
											<div class="estacion-card-badge-lbl"><?php echo esc_html( $estado ); ?></div>
										</div>
										<div class="estacion-card-info"><strong><?php esc_html_e( 'Combustible Disponible', 'colina-cotizaciones' ); ?></strong></div>
									</div>
									<div class="estacion-card-data-row">
										<span class="estacion-card-data-lbl"><?php esc_html_e( 'Disponibilidad:', 'colina-cotizaciones' ); ?></span>
										<span class="estacion-card-data-val" style="color: <?php echo esc_attr( $color ); ?>;"><?php echo esc_html( number_format( $disponibilidad, 0, ',', '.' ) ); ?> Lts.</span>
									</div>
									<div class="estacion-card-data-row">
										<span class="estacion-card-data-lbl"><?php esc_html_e( 'Precio Unitario:', 'colina-cotizaciones' ); ?></span>
										<span class="estacion-card-data-val cc-precio-color"><?php echo esc_html( number_format( $precio, 2, ',', '.' ) ); ?> Bs.</span>
									</div>
									<div class="estacion-card-footer">
										<span><?php esc_html_e( 'Act:', 'colina-cotizaciones' ); ?> <?php echo esc_html( $ultima_act ); ?></span>
										<a class="estacion-card-link" href="<?php echo esc_url( $link_llegar ); ?>" target="_blank"><?php esc_html_e( 'COMO LLEGAR', 'colina-cotizaciones' ); ?></a>
									</div>
								</div>
							<?php }
							wp_reset_postdata();
							?>
						</div>
					<?php endif; ?>
				</div>

				<div class="modal-estaciones-footer">
					<span><?php printf( esc_html__( 'Total: %d estaciones.', 'colina-cotizaciones' ), $count ); ?></span>
					<button class="modal-btn-close" onclick="ccToggleDashboardEstaciones()"><?php esc_html_e( 'CERRAR', 'colina-cotizaciones' ); ?></button>
				</div>
			</div>
		</div>
		<?php
	}

	public function render_cotizacion_modal() {
		if ( is_admin() ) {
			return;
		}

		$template_id_empresa  = apply_filters( 'cc_cotizacion_template_empresa', 8195 );
		$template_id_persona = apply_filters( 'cc_cotizacion_template_persona', 8305 );
		?>
		<div id="cc-modal-cotizacion" class="modal-estaciones-overlay cc-modal-cotizacion">
			<div class="modal-estaciones-container" onclick="event.stopPropagation()">
				<div class="modal-estaciones-header">
					<h3 class="modal-estaciones-title">
						<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
						</svg>
						<?php esc_html_e( 'Solicitar Cotización', 'colina-cotizaciones' ); ?>
					</h3>
					<button class="modal-estaciones-close-btn" onclick="ccToggleModalCotizacion()">&times;</button>
				</div>

				<div class="modal-estaciones-body" style="padding: 20px;">

					<div class="cc-tipo-cliente-wrapper" style="margin-bottom: 20px; text-align: center;">
						<label style="display: block; margin-bottom: 12px; color: #E6ECEF; font-family: 'Hanzon', sans-serif; font-weight: 700; font-size: 16px;">
							TIPO DE CLIENTE
						</label>
						<div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
							<label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-family: 'Creato', sans-serif; font-size: 15px; font-weight: 600; color: #E6ECEF;">
								<input type="radio" name="cc-tipo-cliente" value="EMPRESA" id="cc-radio-empresa" checked style="accent-color: #04896A; width: 18px; height: 18px;"> Empresa
							</label>
							<label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-family: 'Creato', sans-serif; font-size: 15px; font-weight: 600; color: #E6ECEF;">
								<input type="radio" name="cc-tipo-cliente" value="INDEPENDIENTE" id="cc-radio-independiente" style="accent-color: #04896A; width: 18px; height: 18px;"> Persona Natural
							</label>
						</div>
					</div>

					<div id="cc-form-empresa">
						<?php echo do_shortcode( '[elementor-template id="' . esc_attr( $template_id_empresa ) . '" css="true"]' ); ?>
					</div>
					<div id="cc-form-persona" style="display:none">
						<?php echo do_shortcode( '[elementor-template id="' . esc_attr( $template_id_persona ) . '" css="true"]' ); ?>
					</div>

				</div>
			</div>
		</div>
		<?php
	}

	public function render_page_form_templates() {
		if ( is_admin() ) {
			return;
		}

		$template_id_persona = apply_filters( 'cc_cotizacion_template_persona', 8305 );
		?>
		<div id="cc-page-persona-tpl" style="display:none">
			<?php echo do_shortcode( '[elementor-template id="' . esc_attr( $template_id_persona ) . '" css="true"]' ); ?>
		</div>
		<?php
	}
}
