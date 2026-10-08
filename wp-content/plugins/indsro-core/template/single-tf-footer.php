<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ta
 */
?>

<!doctype html>
<html <?php language_attributes();?> <?php print function_exists('hoom_enable_rtl') ? hoom_enable_rtl() : ""; ?> >
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

<!-- wrapper-box start -->
<?php do_action( 'ta_before_main_content' );?>

<?php
	if ( have_posts() ):
		while ( have_posts() ): the_post();
			get_template_part( 'post-formats/content', 'page' );
		endwhile;
	else:
		get_template_part( 'post-formats/content', 'none' );
	endif;
?>

<?php get_footer();