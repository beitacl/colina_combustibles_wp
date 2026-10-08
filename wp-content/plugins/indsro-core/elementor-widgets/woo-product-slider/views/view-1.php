<div class="blta-product-1-slider">
    <div class="swiper-container product-1-slider-active fix">
        <div class="swiper-wrapper">

            <?php foreach ($posts as $post): ?>
            <div class="swiper-slide">
                <div class="blta-product-1-slider-item-bg">
                    <div class="blta-product-1-slider-item">
                        <div class="blta-product-1-slider-item-img d-flex justify-content-center align-items-center">
                            <?php
                                $product_thumbnail = \ElementHelper\Element_El_Woocommerce::product_thumb($post->ID);
                                if (!empty($product_thumbnail)) {
                                    $product_title_or_name = get_the_title($post->ID);
                                    $alt_text = 'Product: ' . esc_attr($product_title_or_name);
                                    echo '<img src="' . esc_attr($product_thumbnail) . '" alt="' . $alt_text . '">';
                                }
                            ?>
                        </div>
                        <spna class="blta-product-1-slider-item-price blta-heading-1 font-500">
                            <?php print \ElementHelper\Element_El_Woocommerce::product_price($post->ID, true); ?>
                        </spna>
                        <h3 class="blta-product-1-slider-item-name blta-heading-1 font-700">
                            <?php
                                $title = $post->post_title;
                                printf('<a href="%2$s">%1$s</a>',
                                    esc_html($title),
                                    esc_url(get_the_permalink($post->ID))
                                );
                            ?>
                        </h3>

                        <div class="blta-product-1-slider-item-hover-content text-center">
                            <div class="blta-product-1-slider-item-btn d-flex justify-content-center align-content-center mb-35">
                                <?php echo \ElementHelper\Element_El_Woocommerce::wishlist_button($post->ID); ?>
                                <?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button_text($post->ID); ?>
                            </div>
                            <spna class="blta-product-1-slider-item-price blta-heading-1 font-500">
                                <?php
                                    // product stock remaining count
                                    $stock = \ElementHelper\Element_El_Woocommerce::product_stock($post->ID);
                                    if ($stock > 0) {
                                        echo esc_html__('In Stock', 'telnet-core');
                                    } else {
                                        echo esc_html__('Out of Stock', 'telnet-core');
                                    }
                                ?>
                            </spna>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
    <div class="blta-product-1-slider-btn d-flex justify-content-center align-items-center">
        <div class="blta-slider-btn-1 blta_product_1_prev">
            <i class="far fa-long-arrow-left"></i>
        </div>
        <div class="blta-slider-btn-1 blta_product_1_next">
            <i class="far fa-long-arrow-right"></i>
        </div>
    </div>
    <?php endif; ?>
</div>