<?php
/**
 * Navbar hardcodeado (partial del tema hijo).
 *
 * Reemplaza el render del header que antes hacía Elementor (tf-header 4749).
 * Carga junto con el HTML del tema, sin procesar el builder de Elementor.
 *
 * @package indsro-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Logo del sitio: usamos el mismo attachment (logo-horizontal-grande-scaled-1.png)
// o el logo configurado en el tema si existe.
$cc_logo_id  = 7831; // logo-horizontal-grande-scaled-1.png
$cc_logo_url = $cc_logo_id ? wp_get_attachment_image_url( $cc_logo_id, 'full' ) : '';

if ( empty( $cc_logo_url ) ) {
	$cc_logo_url = get_template_directory_uri() . '/assets/img/logo/logo-2.webp';
}

$cc_home_url = home_url( '/' );
$cc_contact_url = 'https://colinacombustibles.com/contacto/';

// Menú principal
$cc_menu_args = array(
	'menu'           => 'main-menu',
	'menu_class'     => 'nav navbar-nav clearfix list-unstyled',
	'menu_id'        => 'main-nav',
	'fallback_cb'    => false,
	'echo'           => true,
);
?>
<header class="fti-header-3-area tx-header tx_sticky_header">
	<div class="container fti-header-3-container">
		<div class="fti-header-3-wrap">

			<div class="header-left">
				<!-- logo -->
				<a href="<?php echo esc_url( $cc_home_url ); ?>" aria-label="Inicio" class="fti-header-3-logo tx-logo">
					<img src="<?php echo esc_url( $cc_logo_url ); ?>" alt="Logo Colina Combustibles">
				</a>

				<!-- menu -->
				<div class="has-menu-3">
					<nav class="main-navigation d-none d-lg-block">
						<?php wp_nav_menu( $cc_menu_args ); ?>
					</nav>
				</div>
			</div>

			<!-- action -->
			<div class="fti-header-3-action">
				<a class="fti-btn-pr-4 header-btn-3 tx-button custom-first-btn"
					href="<?php echo esc_url( $cc_contact_url ); ?>"
					aria-label="Solicitar cotización">
					<span class="btn-text">Solicitar cotización</span>
					<span class="btn-icon">
						<i aria-hidden="true" class="fal fa-long-arrow-right"></i>
					</span>
				</a>

				<a id="header-btn-secondary" class="fti-btn-pr-4 header-btn-3 tx-button custom-second-btn"
					href="#"
					aria-label="Precios y saldos">
					<span class="btn-text">Precios y saldos</span>
				</a>

				<!-- menu btn -->
				<button class="fti-menu-btn-3 open_menu d-lg-none" id="menuToggle">
					<i class="fa-solid fa-bars"></i>
				</button>
			</div>
		</div>
	</div>
</header>

<div class="mobile-menu lenis lenis-smooth">
	<div class="mobile-menu-wrap">
		<div class="mobile-menu-logo-wrap mb-40">
			<a href="<?php echo esc_url( $cc_home_url ); ?>"
				class="mobile-menu-logo d-block tx-logo"
				aria-label="Inicio">
				<img src="<?php echo esc_url( $cc_logo_url ); ?>" alt="Logo Colina Combustibles">
			</a>

			<div class="mobile-menu-close open_menu" id="menuToggle2">
				<i class="fa-solid fa-xmark"></i>
			</div>
		</div>

		<!-- mobile-menu-list -->
		<div class="mobile-menu-navigation">
			<nav class="mobile-main-navigation clearfix ul-li">
				<?php wp_nav_menu( $cc_menu_args ); ?>
			</nav>
		</div>

		<!-- Injected mobile buttons -->
		<div class="mobile-menu-buttons">
			<a class="fti-btn-pr-4 header-btn-3 tx-button custom-first-btn"
				href="<?php echo esc_url( $cc_contact_url ); ?>"
				aria-label="Solicitar cotización">
				<span class="btn-text">Solicitar cotización</span>
			</a>

			<a class="fti-btn-pr-4 header-btn-3 tx-button custom-second-btn"
				href="#"
				aria-label="Precios y saldos">
				<span class="btn-text">Precios y saldos</span>
			</a>
		</div>
	</div>
	<div class="mobile_menu_overlay open_menu"></div>
</div>
