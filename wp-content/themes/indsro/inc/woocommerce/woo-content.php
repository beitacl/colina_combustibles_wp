<?php

// product content function
function indsro_woocommerce_template_loop_content() {
    print '<div class="tx-content shop-block_one-overlay_inner">';
        print '<div class="shop-block_one-overlay_inner">';
            print function_exists('indsro_add_cart_button') ? indsro_add_cart_button() : '';
        print '</div>';

        print '<div class="shop-block_one-content">';
        print function_exists('indsro_product_title') ? indsro_product_title() : '';
        print '<div class="tx-productPrice price shop-block_one-price">';
            print function_exists('indsro_get_price') ? indsro_get_price() : '';
        print '</div>';
        print '</div>';

    print '</div>';

}
