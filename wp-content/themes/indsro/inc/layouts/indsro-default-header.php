<?php

/**
 * Default Header Style
 */
function indsro_default_header() {
    if ( has_nav_menu( 'main-menu' ) ) {
        $no_menu_class = '';
    } else {
        $no_menu_class = 'no-menu ';
    }

    ?>
	<header class="fti-header-3-area tx-header tx-DefaultHeader <?php echo esc_attr($no_menu_class); ?>">
		<div class="container fti-header-3-container">
			<div class="fti-header-3-wrap">

				<div class="header-left">
					<!-- logo -->
					<?php function_exists( 'indsro_header_logo' ) ? indsro_header_logo() : '';?>

					<!-- menu -->
					<div class="has-menu-3">
						<nav class="main-navigation d-none d-lg-block">
							<?php function_exists( 'indsro_header_menu' ) ? indsro_header_menu( 'main-menu' ) : null;?>
						</nav>
					</div>
				</div>

				<!-- action -->
				<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
				<div class="fti-header-3-action">
					<!-- menu btn -->
					<button class="fti-menu-btn-3 open_menu" id="menuToggle">
						<i class="fa-solid fa-bars"></i>
					</button>
				</div>
				<?php endif;?>
			</div>
		</div>
	</header>

	<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
	<div class="mobile-menu lenis lenis-smooth">
		<div class="mobile-menu-wrap">
			<div class="mobile-menu-bg">
				<span class="span1" ></span>
				<span class="span2" ></span>
			</div>

			<div class="mobile-menu-logo-wrap mb-100">
				<?php function_exists( 'indsro_side_info_logo' ) ? indsro_side_info_logo() : '';?>

				<div class="mobile-menu-close" id="menuToggle2">
					<i class="fa-duotone fa-circle-xmark"></i>
				</div>
			</div>

			<div class="mobile-menu-inner">

				<div class="mobile-menu-inner-left">
					<!-- mobile-menu-list -->
					<div class="mobile-menu-navigation">
						<nav class="mobile-main-navigation  clearfix ul-li">
							<?php function_exists( 'indsro_header_menu' ) ? indsro_header_menu( 'main-menu' ) : null;?>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mobile-menu lenis lenis-smooth">
		<div class="mobile-menu-wrap">
			<div class="mobile-menu-logo-wrap mb-40">

				<?php function_exists( 'indsro_side_info_logo' ) ? indsro_side_info_logo() : '';?>

				<div class="mobile-menu-close open_menu" id="menuToggle2">
					<i class="fa-solid fa-xmark"></i>
				</div>
			</div>

			<!-- mobile-menu-list -->
			<div class="mobile-menu-navigation">
				<nav class="mobile-main-navigation clearfix ul-li">
					<?php function_exists( 'indsro_header_menu' ) ? indsro_header_menu( 'main-menu' ) : null;?>
				</nav>
			</div>
		</div>
		<div class="mobile_menu_overlay open_menu"></div>
	</div>
	<?php endif; ?>
    <?php
}
