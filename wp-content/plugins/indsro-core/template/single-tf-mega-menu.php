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
<html <?php language_attributes();?> <?php print hoom_enable_rtl();?>>
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
<div class="tf-blog-area pt-100 pb-100">
    <div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="tf-page-content">
					<?php
						if ( have_posts() ):
							while ( have_posts() ): the_post();
								get_template_part( 'post-formats/content', 'page' );
							endwhile;
						else:
							get_template_part( 'post-formats/content', 'none' );
						endif;
					?>
				</div>
			</div>
		</div>
    </div>
</div>

<?php get_footer();