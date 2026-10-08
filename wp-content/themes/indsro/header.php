<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-layouts
 *
 * @package indsro
 */

$preloader_enable = cs_get_option( 'preloader_enable', true );
$enable_scroll_up = cs_get_option( 'enable_scroll_up', true );
$preloader_image = cs_get_option( 'preloader_image', get_template_directory_uri() . '/assets/img/logo/logo-2.webp');

if(isset($preloader_image['url'])) {
    $preloader_image = $preloader_image['url'];
} else {
    $preloader_image = get_template_directory_uri() . '/assets/img/logo/logo-2.webp';
}
?>

<!doctype html>
<html <?php if(function_exists('language_attributes')) {language_attributes();} ?> <?php if(function_exists('indsro_enable_rtl')) { print indsro_enable_rtl();} ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>
<?php wp_body_open();?>

<div class="page-wrapper">

    <div class="offcanvas-overlay"></div>

    <!-- preloader start -->
    <?php if( $preloader_enable == true ) : ?>
    <div id="preloader">
        <div class="preloader-wrap">
            <div class="loading">
                <img class="logo" src="<?php echo esc_url($preloader_image) ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $preloader_image ); } ?>">
                <div class="icon-ani">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- preloader end -->

    <!-- back to top start -->
    <?php if( $enable_scroll_up == true ) : ?>
    <div class="scroll-top show">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </div>
    <?php endif; ?>
    <!-- back to top end -->

    <!-- header start -->
    <?php do_action( 'indsro_header_style' ); ?>
    <!-- header end -->

    <!-- wrapper-box start -->
    <?php do_action( 'indsro_before_main_content' ); ?>