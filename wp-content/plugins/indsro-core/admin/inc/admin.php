<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Welcome page
 */
function tx_welcome_page() {
	require_once __DIR__ . '/tf-welcome.php';
}

/**
 * Documentation page
 */
function tx_documentations_page() {
	require_once __DIR__ . '/tf-documentations.php';
}

/**
 * Get theme option URL
 */
function tx_theme_options_url() {
	return admin_url( 'admin.php?page=indsro-theme-option' );
}

/**
 * Get plugin install URL
 */
function tx_install_plugins_url() {
	return admin_url( 'admin.php?page=tgmpa-install-plugins&plugin_status=install' );
}

/**
 * Get license page URL
 */
function tx_license_page_url() {
	return admin_url( 'admin.php?page=theme-license' );
}

/**
 * Check if all required plugins are installed and activated
 */
function tx_all_plugins_installed_and_activated() {

	if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
		return false;
	}

	$tgmpa   = TGM_Plugin_Activation::get_instance();
	$plugins = $tgmpa->plugins;

	foreach ( $plugins as $plugin ) {

		if (
			! $tgmpa->is_plugin_installed( $plugin['slug'] ) ||
			! $tgmpa->is_plugin_active( $plugin['slug'] )
		) {
			return false;
		}
	}

	return true;
}

/**
 * Theme admin menu
 */
function ta_admin_menu() {

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	add_menu_page(
		tf_theme_name(),
		tf_theme_name(),
		'manage_options',
		'tf-admin-menu',
		'tx_welcome_page',
		'dashicons-smiley',
		4
	);

	// Welcome
	add_submenu_page(
		'tf-admin-menu',
		esc_html__( 'Welcome', 'indsro-core' ),
		esc_html__( 'Welcome', 'indsro-core' ),
		'manage_options',
		'tf-admin-menu',
		'tx_welcome_page'
	);

	// Install plugins
	if ( ! tx_all_plugins_installed_and_activated() ) {

		add_submenu_page(
			'tf-admin-menu',
			esc_html__( 'Install Plugins', 'indsro-core' ),
			esc_html__( 'Install Plugins', 'indsro-core' ),
			'manage_options',
			'tgmpa-install-plugins'
		);
	}

	// Theme options
	add_submenu_page(
		'tf-admin-menu',
		esc_html__( 'Theme Options', 'indsro-core' ),
		esc_html__( 'Theme Options', 'indsro-core' ),
		'manage_options',
		'indsro-theme-option'
	);

	// Demo import
	add_submenu_page(
		'tf-admin-menu',
		esc_html__( 'Demo Import', 'indsro-core' ),
		esc_html__( 'Demo Import', 'indsro-core' ),
		'manage_options',
		'indsro-demo-import',
		[ 'Indsro_Demo_UI', 'render_page' ]
	);

	// Documentation
	add_submenu_page(
		'tf-admin-menu',
		esc_html__( 'Documentation', 'indsro-core' ),
		esc_html__( 'Documentation', 'indsro-core' ),
		'manage_options',
		'tf-documentations',
		'tx_documentations_page'
	);

	// License
	if ( apply_filters( 'indsro_demo_require_license', true ) ) {
		add_submenu_page(
			'tf-admin-menu',
			esc_html__( 'License', 'indsro-core' ),
			esc_html__( 'License', 'indsro-core' ),
			'manage_options',
			'theme-license',
			'tx_license_page_url'
		);
	}
}
add_action( 'admin_menu', 'ta_admin_menu' );


/**
 * Admin notice if plugins missing
 */
function tx_check_plugins_status() {

	if ( tx_all_plugins_installed_and_activated() ) {
		return;
	}

	echo '<div class="notice notice-warning is-dismissible">
	<p>' . esc_html__( 'Some plugins are missing or inactive. Please install and activate all required plugins.', 'indsro-core' ) . '</p>
	</div>';
}

add_action( 'admin_notices', 'tx_check_plugins_status' );