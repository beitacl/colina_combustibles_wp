<?php

/**
 * [indsro_product_title description]
 * @return [type] [description]
 */
function indsro_product_title() {
    return '<h6 class="tx-product-title shop-block_one-heading"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h6>';
}

/**
 * [indsro_product_cart_button description]
 * @return [type] [description]
 */
function woocommerce_custom_sale_text($text, $post, $_product) {
    $show_discount_percentage = cs_get_option( 'show_discount_percentage', false );
    if($show_discount_percentage == false) {
        return '<span class="tx-product-badge tx-product-badge__sale off-tag position-absolute">'.__('Sell', 'indsro').'</span>';
    }
}


function indsro_woo_category() {
    global $product;
    $current_cats = get_the_terms( get_the_ID(), 'product_cat' );
    //only start if we have some tags
    if ( $current_cats && ! is_wp_error( $current_cats ) ) {

    //create a list to hold our tags
    echo '<div class="pp__c-top d-flex align-items-center"><div class="pp__cat pp__cat--2">';

    //for each tag we create a list item
    foreach ($current_cats as $cat) {

        $cat_title = $cat->name; // tag name
        $cat_link = get_term_link( $cat );// tag archive link

        echo '<a href="'.$cat_link.'">'.$cat_title.' </a>';
    }

    echo '</div></div>';
    }
}

function indsro_get_price() {
    ob_start(); ?>
    <span class="woocommerce-Price-amount amount price"><?php print indsro_get_price_html(); ?></span>
    <?php
    return ob_get_clean();
}

function indsro_product_price( $product_id, $oldp = false ) {

    $product = wc_get_product( $product_id );

    $old = '';
    $price = $product->get_regular_price();

    if ( $product->get_sale_price() != '' ) {

        $price = $product->get_sale_price();

        if ( $oldp ) {
            $old = '
            <span class="regular">
                / <del>' . get_woocommerce_currency_symbol( get_woocommerce_currency() ) . $product->get_regular_price() . '</del>
            </span>';
        }
    }

    $price = get_woocommerce_currency_symbol( get_woocommerce_currency() ) . $price;

    if ( $product->get_type() == 'grouped' ) {
        return false;
    }

    return '<h6 class="price">' . $price . $old . '</h6> ' ;
}

function indsro_get_price_html() {
    global $product;
    return $product->get_price_html();
}

/**
 * [indsro_comment_rating description]
 * @param  [type] $rating [description]
 * @return [type]         [description]
 */
function indsro_comment_rating($rating)
{
    $review = '' . esc_html($rating) . ' Rating';
    $html = '';
    $html .= '<div class="tx-ratingStars d-flex align-items-center">';
    for ($i = 0; $i <= 4; $i++) {
        if ($i < floor($rating)) {
            $html .= '<i class="fas fa-star"></i>';
        } else {
            $html .= '<i class="fal fa-star"></i>';
        }
    }
    $html .= '</div>';
    return $html;
}


add_filter('woocommerce_product_additional_information_heading', 'indsro_tab_heading');

add_filter('woocommerce_product_description_heading', 'indsro_tab_heading');

/**
 * [indsro_tab_heading description]
 * @param  [type] $heading [description]
 * @return [type]          [description]
 */
function indsro_tab_heading($heading)
{
    return '';
}

function indsro_woocommerce_get_sidebar()
{
    dynamic_sidebar('product-sidebar');
}

// add to cart function
function indsro_add_cart_button() {
    global $product;
    $class = 'product_type_' . $product->get_type() . ' add_to_cart_button action ' . ($product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '');

    $enable_custom_add_to_cart_text = cs_get_option('enable_custom_add_to_cart_text', false);
    $custom_add_to_cart_text = cs_get_option('custom_add_to_cart_text', __('Purchase Now', 'indsro'));

    if($enable_custom_add_to_cart_text == true ){
        $add_cart_text = $custom_add_to_cart_text;
    } else {
        $add_cart_text = $product->add_to_cart_text();
    }

    $attributes = array(
        'data-product_id' => $product->get_id(),
        'data-product_sku' => $product->get_sku(),
        'aria-label' => $product->add_to_cart_description(),
        'rel' => 'nofollow',
    );

    $button_html = '';
    $button_html = '<a href="' . $product->add_to_cart_url() . '" ';
    $button_html .= 'class="tx-button mr-0 btn-style-one theme-btn' . ' ' . esc_attr($class) . '" ';
    $button_html .= 'data-product_id="' . $product->get_id() . '" ';
    $button_html .= 'data-product_sku="' . $product->get_sku() . '" ';
    $button_html .= 'aria-label="' . $product->add_to_cart_description() . '" ';
    $button_html .= 'rel="nofollow"><div class="btn-wrap">
        <span class="text-one">'.esc_html($add_cart_text).' <i class="flaticon-arrow-pointing-to-right"></i></span>
        <span class="text-two">'.esc_html($add_cart_text).' <i class="flaticon-arrow-pointing-to-right"></i></span>
    </div></a>';

    return $button_html;
}

// product actions function
function indsro_product_actions() {

    if(function_exists('indsro_quick_view_button') && INDSRO_CORE && INDSRO_WOOCOMMERCE_ACTIVED && class_exists( 'WPCleverWoosq' )) {
    ?>
        <div class="eye">
            <?php print indsro_quick_view_button(); ?>
        </div>
        <?php
    }
}

function indsro_woocommerce_template_single_price(){
    print indsro_get_price_html();
}

function woocommerce_template_single_stock()
{
    global $product;
    if ($product->get_stock_quantity() > 0) {
        print '<div class="cart-title">';
        print '<h6>Availability: <span>In Stock</span></h6>';
        print '</div>';
    } else {
        if ($product->backorders_allowed()) {
            print '<div class="cart-title">';
            print '<h6>Availability: <span>On Backorder</span></h6>';
            print '</div>';
        } else {
            print '<div class="cart-title">';
            print '<h6>Availability: <span>Out of stock</span></h6>';
            print '</div>';
        }
    }
}

// Releted Product limit
function indsro_related_products_limit() {
    global $product;

      $args['posts_per_page'] = 3;
      return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'indsro_related_products_args', 20 );
function indsro_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 4 related products
    $args['columns'] = 2; // arranged in 2 columns
    return $args;
}