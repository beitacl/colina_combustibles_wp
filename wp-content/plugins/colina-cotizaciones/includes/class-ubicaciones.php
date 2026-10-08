<?php
/**
 * Mantenimiento de los datos geográficos de Bolivia (departamento / provincia / municipio).
 *
 * Responsabilidades:
 *  - Página de administración con botón para actualizar el JSON manualmente.
 *  - Tarea programada (WP-Cron) mensual que valida y regenera el JSON.
 *  - Regeneración: toma la jerarquía de dylan-calle/bolivia-geo-data (MIT) y
 *    conserva las coordenadas ya calculadas del archivo actual.
 *
 * @package         Colina_Cotizaciones
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CC_Ubicaciones {

	const DATA_FILE = CC_PLUGIN_DIR . 'assets/data/bolivia-ubicaciones.json';
	const SOURCE_URL = 'https://raw.githubusercontent.com/dylan-calle/bolivia-geo-data/main/es/json/full.json';
	const SOURCE_DESC = 'nombres: dylan-calle/bolivia-geo-data (MIT); coordenadas: GeoBolivia/geoBoundaries (Public Domain)';
	const CRON_HOOK = 'cc_monthly_ubicaciones_update';

	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_post_cc_update_ubicaciones', array( $this, 'handle_manual_update' ) );
		add_action( self::CRON_HOOK, array( $this, 'run_scheduled_check' ) );
		$this->maybe_schedule();
	}

	private function maybe_schedule() {
		if ( ! wp_next_scheduled( self::CRON_HOOK ) ) {
			wp_schedule_event( time(), 'monthly', self::CRON_HOOK );
		}
	}

	public static function unschedule() {
		$ts = wp_next_scheduled( self::CRON_HOOK );
		if ( $ts ) {
			wp_unschedule_event( $ts, self::CRON_HOOK );
		}
	}

	/* ---------------------------------------------------------------------
	 * ADMIN
	 * ------------------------------------------------------------------- */

	public function add_admin_menu() {
		add_submenu_page(
			'options-general.php',
			__( 'Datos de Ubicaciones', 'colina-cotizaciones' ),
			__( 'Colina: Ubicaciones', 'colina-cotizaciones' ),
			'manage_options',
			'cc-ubicaciones',
			array( $this, 'render_admin_page' )
		);
	}

	public function render_admin_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$file = self::DATA_FILE;
		$modified = file_exists( $file ) ? gmdate( 'Y-m-d H:i:s', filemtime( $file ) ) : __( 'No existe', 'colina-cotizaciones' );
		$info = $this->file_summary();
		$last = get_option( 'cc_ubicaciones_last_check' );
		$updated = isset( $_GET['cc_updated'] ) && '1' === $_GET['cc_updated'];
		$error = isset( $_GET['cc_error'] ) ? sanitize_text_field( wp_unslash( $_GET['cc_error'] ) ) : '';
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Datos de Ubicaciones de Bolivia', 'colina-cotizaciones' ); ?></h1>

			<?php if ( $updated ) : ?>
				<div class="notice notice-success"><p><?php esc_html_e( 'Los datos se actualizaron correctamente.', 'colina-cotizaciones' ); ?></p></div>
			<?php endif; ?>
			<?php if ( $error ) : ?>
				<div class="notice notice-error"><p><?php echo esc_html( $error ); ?></p></div>
			<?php endif; ?>

			<table class="widefat striped" style="max-width: 640px;">
				<tbody>
					<tr>
						<th><?php esc_html_e( 'Archivo', 'colina-cotizaciones' ); ?></th>
						<td><code>assets/data/bolivia-ubicaciones.json</code></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Última actualización', 'colina-cotizaciones' ); ?></th>
						<td><?php echo esc_html( $modified ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Departamentos', 'colina-cotizaciones' ); ?></th>
						<td><?php echo esc_html( $info['departamentos'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Provincias', 'colina-cotizaciones' ); ?></th>
						<td><?php echo esc_html( $info['provincias'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Municipios', 'colina-cotizaciones' ); ?></th>
						<td><?php echo esc_html( $info['municipios'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Última verificación (cron mensual)', 'colina-cotizaciones' ); ?></th>
						<td>
							<?php if ( $last && isset( $last['time'] ) ) : ?>
								<?php echo esc_html( gmdate( 'Y-m-d H:i:s', $last['time'] ) ); ?> — <?php echo esc_html( $last['result'] ); ?>
							<?php else : ?>
								<?php esc_html_e( 'Aún no se ha ejecutado.', 'colina-cotizaciones' ); ?>
							<?php endif; ?>
						</td>
					</tr>
				</tbody>
			</table>

			<h2><?php esc_html_e( 'Actualizar ahora', 'colina-cotizaciones' ); ?></h2>
			<p>
				<?php esc_html_e( 'Re-descarga la fuente oficial y regenera el archivo conservando las coordenadas actuales. Si la descarga falla o el resultado no es válido, el archivo actual no se toca.', 'colina-cotizaciones' ); ?>
			</p>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<?php wp_nonce_field( 'cc_update_ubicaciones', 'cc_ubicaciones_nonce' ); ?>
				<input type="hidden" name="action" value="cc_update_ubicaciones">
				<?php submit_button( __( 'Actualizar datos de ubicaciones', 'colina-cotizaciones' ), 'primary', 'cc_update_btn' ); ?>
			</form>
		</div>
		<?php
	}

	public function handle_manual_update() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'No tienes permisos para esta acción.', 'colina-cotizaciones' ) );
		}
		check_admin_referer( 'cc_update_ubicaciones', 'cc_ubicaciones_nonce' );

		$result = $this->regenerate();

		if ( is_wp_error( $result ) ) {
			$redirect = add_query_arg(
				array(
					'page'     => 'cc-ubicaciones',
					'cc_error' => rawurlencode( $result->get_error_message() ),
				),
				admin_url( 'options-general.php' )
			);
			wp_safe_redirect( $redirect );
			exit;
		}

		update_option(
			'cc_ubicaciones_last_check',
			array(
				'time'   => time(),
				'result' => sprintf(
					__( 'Actualización manual: %d municipios, %d provincias', 'colina-cotizaciones' ),
					$result['municipios'],
					$result['provincias']
				),
			)
		);

		wp_safe_redirect( admin_url( 'options-general.php?page=cc-ubicaciones&cc_updated=1' ) );
		exit;
	}

	public function run_scheduled_check() {
		$result = $this->regenerate();

		if ( is_wp_error( $result ) ) {
			update_option(
				'cc_ubicaciones_last_check',
				array(
					'time'   => time(),
					'result' => __( 'Verificación: ' . $result->get_error_message(), 'colina-cotizaciones' ),
				)
			);
			return;
		}

		update_option(
			'cc_ubicaciones_last_check',
			array(
				'time'   => time(),
				'result' => sprintf(
					__( 'Verificación: %d municipios, %d provincias', 'colina-cotizaciones' ),
					$result['municipios'],
					$result['provincias']
				),
			)
		);
	}

	/* ---------------------------------------------------------------------
	 * REGENERACIÓN
	 * ------------------------------------------------------------------- */

	public function regenerate() {
		$current = $this->read_current();
		$source  = $this->fetch_source();
		if ( is_wp_error( $source ) ) {
			return $source;
		}

		if ( empty( $current['departamentos'] ) ) {
			$this->bootstrap_from_source( $current, $source );
		} else {
			$current['actualizado'] = gmdate( 'Y-m-d' );
			$this->apply_source_updates( $current, $source );
		}

		$validation = $this->validate( $current );
		if ( true !== $validation ) {
			return new WP_Error( 'cc_ubicaciones_validation', $validation );
		}

		$written = $this->write_file( $current );
		if ( is_wp_error( $written ) ) {
			return $written;
		}

		return $this->count( $current );
	}

	private function fetch_source() {
		$res = wp_remote_get(
			self::SOURCE_URL,
			array(
				'timeout' => 30,
				'headers' => array( 'User-Agent' => 'Colina-WP/1.0 (site admin)' ),
			)
		);

		if ( is_wp_error( $res ) ) {
			return new WP_Error( 'cc_ubicaciones_source', __( 'No se pudo descargar la fuente: ' . $res->get_error_message(), 'colina-cotizaciones' ) );
		}

		$code = wp_remote_retrieve_response_code( $res );
		if ( 200 !== $code ) {
			return new WP_Error( 'cc_ubicaciones_source', sprintf( __( 'La fuente respondió HTTP %d', 'colina-cotizaciones' ), $code ) );
		}

		$json = json_decode( wp_remote_retrieve_body( $res ), true );

		// La fuente viene como array de un elemento: [ { "departamentos": [...] } ].
		if ( isset( $json[0] ) && is_array( $json[0] ) && ! empty( $json[0]['departamentos'] ) ) {
			$json = $json[0];
		}

		if ( ! is_array( $json ) || empty( $json['departamentos'] ) ) {
			return new WP_Error( 'cc_ubicaciones_source', __( 'La fuente no devolvió datos válidos', 'colina-cotizaciones' ) );
		}

		return $json;
	}

	private function read_current() {
		if ( ! file_exists( self::DATA_FILE ) ) {
			return array( 'departamentos' => array() );
		}
		$json = json_decode( (string) file_get_contents( self::DATA_FILE ), true );
		return is_array( $json ) ? $json : array( 'departamentos' => array() );
	}

	private function build_coord_index( $current ) {
		$idx = array( 'mun' => array(), 'prov' => array(), 'dept' => array() );

		foreach ( $current['departamentos'] as $dept ) {
			$dn = $this->norm( $dept['nombre'] );
			if ( ! empty( $dept['centro'] ) ) {
				$idx['dept'][ $dn ] = $dept['centro'];
			}
			foreach ( $dept['provincias'] as $prov ) {
				$pn = $this->norm( $prov['nombre'] );
				if ( ! empty( $prov['centro'] ) ) {
					$idx['prov']["$dn|$pn"] = $prov['centro'];
				}
				foreach ( $prov['municipios'] as $mun ) {
					if ( empty( $mun['centro'] ) ) {
						continue;
					}
					$mn                      = $this->norm( $mun['nombre'] );
					$idx['mun']["$dn|$mn"] = $mun['centro'];
				}
			}
		}

		return $idx;
	}

	/**
	 * Caso extremo: no existe el archivo actual. Se genera la estructura desde
	 * la fuente (sin coordenadas; el zoom del mapa quedará deshabilitado hasta
	 * que haya un archivo con datos).
	 */
	private function bootstrap_from_source( &$out, $source ) {
		$out['fuente']      = self::SOURCE_DESC;
		$out['actualizado'] = gmdate( 'Y-m-d' );

		foreach ( $source['departamentos'] as $dept ) {
			$provincias = array();
			foreach ( $dept['provincias'] as $prov ) {
				$municipios = array();
				foreach ( $prov['municipios'] as $mun ) {
					if ( $this->is_territory( $mun['nombre'] ) ) {
						continue;
					}
					$municipios[] = array( 'nombre' => $mun['nombre'], 'centro' => null );
				}
				$provincias[] = array(
					'nombre'    => $prov['nombre'],
					'centro'    => null,
					'municipios' => $municipios,
				);
			}
			$out['departamentos'][] = array(
				'nombre'    => $dept['nombre'],
				'centro'    => null,
				'provincias' => $provincias,
			);
		}
	}

	/**
	 * Actualización aditiva: conserva el archivo actual (nombres y coordenadas ya
	 * validados) y solo agrega municipios/provincias nuevos que aparezcan en la
	 * fuente. Omite territorios indígenas y variantes de nombre conocidas para no
	 * crear duplicados (ej. "Charagua" vs "AIOC Charagua Iyambae").
	 */
	private function apply_source_updates( &$current, $source ) {
		$existing = array();
		$dept_idx = array();
		$prov_idx = array();

		foreach ( $current['departamentos'] as $di => $dept ) {
			$dn             = $this->norm( $dept['nombre'] );
			$dept_idx[ $dn ] = $di;
			foreach ( $dept['provincias'] as $pi => $prov ) {
				$pn                   = $this->norm( $prov['nombre'] );
				$prov_idx[ "$dn|$pn" ] = array( $di, $pi );
				foreach ( $prov['municipios'] as $mun ) {
					$existing[ "$dn|$pn|" . $this->norm( $mun['nombre'] ) ] = true;
				}
			}
		}

		foreach ( $source['departamentos'] as $dept ) {
			$dn = $this->norm( $dept['nombre'] );
			if ( ! isset( $dept_idx[ $dn ] ) ) {
				$current['departamentos'][] = array( 'nombre' => $dept['nombre'], 'centro' => null, 'provincias' => array() );
				$dept_idx[ $dn ]            = count( $current['departamentos'] ) - 1;
			}
			$di = $dept_idx[ $dn ];

			foreach ( $dept['provincias'] as $prov ) {
				$pn      = $this->norm( $prov['nombre'] );
				$prov_key = "$dn|$pn";
				if ( ! isset( $prov_idx[ $prov_key ] ) ) {
					$current['departamentos'][ $di ]['provincias'][] = array( 'nombre' => $prov['nombre'], 'centro' => null, 'municipios' => array() );
					$prov_idx[ $prov_key ] = array( $di, count( $current['departamentos'][ $di ]['provincias'] ) - 1 );
				}
				list( $di2, $pi ) = $prov_idx[ $prov_key ];

				$fallback = ! empty( $current['departamentos'][ $di2 ]['provincias'][ $pi ]['centro'] )
					? $current['departamentos'][ $di2 ]['provincias'][ $pi ]['centro']
					: ( ! empty( $current['departamentos'][ $di2 ]['centro'] ) ? $current['departamentos'][ $di2 ]['centro'] : null );

				foreach ( $prov['municipios'] as $mun ) {
					$key = "$dn|$pn|" . $this->norm( $mun['nombre'] );
					if ( isset( $existing[ $key ] ) ) {
						continue;
					}
					if ( $this->is_territory( $mun['nombre'] ) || $this->is_known_variant( $mun['nombre'] ) ) {
						continue;
					}
					$current['departamentos'][ $di2 ]['provincias'][ $pi ]['municipios'][] = array(
						'nombre' => $mun['nombre'],
						'centro' => $fallback,
					);
					$existing[ $key ] = true;
				}

				$this->recompute_centers( $current['departamentos'][ $di2 ], $pi );
			}
		}
	}

	/**
	 * Territorios indígenas originario campesinos (no son municipios).
	 */
	private function is_territory( $name ) {
		$norm = $this->norm( $name );
		return strpos( $norm, 'tioc ' ) === 0 || strpos( $norm, 'aioc ' ) === 0;
	}

	/**
	 * Nombres de la fuente que son variantes de municipios ya presentes en el
	 * archivo actual con otro nombre (se evita duplicar).
	 */
	private function is_known_variant( $name ) {
		$variants = array( 'Icla', 'Pampagrande', 'Santiago de Huayllamarca', 'Sopachuy' );
		return in_array( $name, $variants, true );
	}

	private function recompute_centers( &$dept, $pi ) {
		$prov = &$dept['provincias'][ $pi ];

		$slat = 0.0; $slon = 0.0; $cnt = 0;
		foreach ( $prov['municipios'] as $mun ) {
			if ( ! empty( $mun['centro'] ) ) {
				$slat += (float) $mun['centro'][0];
				$slon += (float) $mun['centro'][1];
				$cnt++;
			}
		}
		$prov['centro'] = $cnt > 0 ? array( round( $slat / $cnt, 6 ), round( $slon / $cnt, 6 ) ) : null;
		unset( $prov );

		$slat = 0.0; $slon = 0.0; $cnt = 0;
		foreach ( $dept['provincias'] as $p ) {
			foreach ( $p['municipios'] as $mun ) {
				if ( ! empty( $mun['centro'] ) ) {
					$slat += (float) $mun['centro'][0];
					$slon += (float) $mun['centro'][1];
					$cnt++;
				}
			}
		}
		$dept['centro'] = $cnt > 0 ? array( round( $slat / $cnt, 6 ), round( $slon / $cnt, 6 ) ) : null;
	}

	private function validate( $data ) {
		if ( ! isset( $data['departamentos'] ) || count( $data['departamentos'] ) !== 9 ) {
			return __( 'El resultado no tiene 9 departamentos. No se guardó.', 'colina-cotizaciones' );
		}

		$prov = 0;
		$mun  = 0;
		foreach ( $data['departamentos'] as $dept ) {
			if ( empty( $dept['provincias'] ) ) {
				return sprintf( __( 'El departamento %s no tiene provincias.', 'colina-cotizaciones' ), $dept['nombre'] );
			}
			foreach ( $dept['provincias'] as $p ) {
				$prov++;
				if ( empty( $p['municipios'] ) ) {
					return sprintf( __( 'La provincia %s no tiene municipios.', 'colina-cotizaciones' ), $p['nombre'] );
				}
				$mun += count( $p['municipios'] );
			}
		}

		if ( $prov < 110 || $mun < 330 ) {
			return sprintf( __( 'Conteos sospechosos (%d provincias, %d municipios). No se guardó.', 'colina-cotizaciones' ), $prov, $mun );
		}

		return true;
	}

	private function count( $data ) {
		$prov = 0;
		$mun  = 0;
		foreach ( $data['departamentos'] as $dept ) {
			foreach ( $dept['provincias'] as $p ) {
				$prov++;
				$mun += count( $p['municipios'] );
			}
		}
		return array( 'departamentos' => count( $data['departamentos'] ), 'provincias' => $prov, 'municipios' => $mun );
	}

	private function file_summary() {
		$data = $this->read_current();
		return $this->count( $data );
	}

	private function write_file( $data ) {
		$json = wp_json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
		if ( false === $json ) {
			return new WP_Error( 'cc_ubicaciones_encode', __( 'No se pudo codificar el JSON', 'colina-cotizaciones' ) );
		}

		// No reescribir el archivo si los datos no cambiaron realmente
		// (comparando todo menos los metadatos 'fuente' y 'actualizado').
		if ( file_exists( self::DATA_FILE ) ) {
			$old = json_decode( (string) file_get_contents( self::DATA_FILE ), true );
			if ( is_array( $old ) ) {
				$new_cmp = $data;
				unset( $new_cmp['fuente'], $new_cmp['actualizado'] );
				unset( $old['fuente'], $old['actualizado'] );
				if ( wp_json_encode( $new_cmp, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) === wp_json_encode( $old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) ) {
					return true;
				}
			}
		}

		$tmp = self::DATA_FILE . '.tmp';
		if ( false === file_put_contents( $tmp, $json ) ) {
			return new WP_Error( 'cc_ubicaciones_write', __( 'No se pudo escribir el archivo temporal', 'colina-cotizaciones' ) );
		}
		if ( ! rename( $tmp, self::DATA_FILE ) ) {
			@unlink( $tmp );
			return new WP_Error( 'cc_ubicaciones_write', __( 'No se pudo reemplazar el archivo', 'colina-cotizaciones' ) );
		}
		return true;
	}

	/**
	 * Normaliza un nombre para comparar: minúsculas, sin tildes, sin símbolos.
	 */
	private function norm( $name ) {
		$name = (string) $name;
		$name = mb_strtolower( $name, 'UTF-8' );
		$name = str_replace( array( 'ñ', 'Ñ' ), 'n', $name );

		$translit = array(
			'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
			'ä' => 'a', 'ë' => 'e', 'ï' => 'i', 'ö' => 'o', 'ü' => 'u',
			'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
		);
		$name = strtr( $name, $translit );
		$name = preg_replace( '/[^a-z0-9 ]/', ' ', $name );
		$name = preg_replace( '/\s+/', ' ', $name );
		return trim( $name );
	}
}
