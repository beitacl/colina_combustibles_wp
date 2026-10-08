<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if(is_active_sidebar('shop-sidebar-1')){
	$indsroShopClass = 'col-lg-4 col-md-4 col-sm-4 col-12';
}else{
	$indsroShopClass = 'col-lg-3 col-md-3 col-sm-3 col-12';
}

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// get the product link
$product_link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
?>
<div class="<?php echo esc_attr($indsroShopClass);?>">
	<div <?php wc_product_class( '', $product ); ?>>
		<div class="product--img">
			<a href="<?php echo esc_url($product_link); ?>"><?php woocommerce_template_loop_product_thumbnail();?></a>
			<div class="product--btn">
			<?php


			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			woocommerce_template_loop_add_to_cart();
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
			</div>
		</div>
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<div class="product--holder">
			<h3 class="product--title"><a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>"><?php the_title();?></a></h3>
			<span class="product--price"><?php woocommerce_template_loop_price(); ?></span>
		</div>
	</div>
</div>
