<?php
return [
    'woocommerce_before_shop_loop'              => [
        [ 'woocommerce_result_count', 20 ],
    ],

    'woocommerce_after_shop_loop_item'          => [
        [ 'woocommerce_template_loop_add_to_cart', 10 ],
    ],

    'woocommerce_before_main_content'           => [
        [ 'woocommerce_breadcrumb', 20 ],
        [ 'woocommerce_output_content_wrapper', 10 ],
    ],

    'woocommerce_after_main_content'            => [
        [ 'woocommerce_output_content_wrapper_end', 10 ],
    ],

    'woocommerce_before_shop_loop_item_title'   => [
        [ 'woocommerce_show_product_loop_sale_flash', 10 ],
        [ 'woocommerce_template_loop_product_thumbnail', 10 ],
    ],

    'woocommerce_after_shop_loop_item_title'    => [
        [ 'woocommerce_template_loop_price', 10 ],
        [ 'woocommerce_template_loop_rating', 5 ],
    ],

    'woocommerce_sidebar'                       => [
        [ 'woocommerce_get_sidebar', 10 ],
    ],

    'woocommerce_single_product_summary'        => [
        [ 'woocommerce_template_single_title', 5 ],
        [ 'woocommerce_template_single_price', 10 ],
        [ 'woocommerce_template_single_excerpt', 20 ],
        [ 'woocommerce_template_single_add_to_cart', 30 ],
        [ 'woocommerce_template_single_meta', 40 ],
        [ 'woocommerce_template_single_sharing', 50 ],
        [ 'woocommerce_template_single_rating', 10 ],

    ],
    'woocommerce_before_single_product_summary' => [
        [ 'woocommerce_show_product_sale_flash', 10 ],
    ],

];