<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package indsro
 */

get_header();

$indsro_error_image = cs_get_option( 'tx_error_image', get_template_directory_uri() . '/assets/img/error.webp' );
if(isset($indsro_site_logo['url'])) {
	$image_url = $indsro_error_image['url'];
} else {
	$image_url = get_template_directory_uri() . '/assets/img/error.webp';
}
$indsro_error_title = cs_get_option('tx_error_title', __('Oops! Page Not found.', 'indsro'));
$indsro_error_link_text = cs_get_option('tx_error_link_text', __('Back To Home Page', 'indsro'));

?>
<div class="fti-oops-area pt-130 pb-130">
	<div class="container">
		<div class="fti-oops-wrap">
			<?php if(!empty( $image_url )) : ?>
			<div class="main-img">
				<img src="<?php echo esc_url($image_url); ?>"
				alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text($image_url); } ?>" />
			</div>
			<?php endif; ?>
			<div class="content">
				<?php if(!empty( $indsro_error_title )) : ?>
				<h2 class="fti-section-title-4"><?php print esc_html($indsro_error_title);?></h2>
				<?php endif; ?>

				<?php if(!empty( $indsro_error_link_text )) : ?>
				<div class="btn-wrap">
					<a class="fti-btn-pr-4 back-btn" href="<?php echo esc_url(home_url()); ?>">
						<span class="btn-text"><?php print esc_html($indsro_error_link_text);?></span>
						<span class="btn-icon">
							<i class="flaticon-right-arrow"></i>
						</span>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
