<?php

namespace ElementHelper;

defined( 'ABSPATH' ) || die();

class Element_El_Woocommerce {

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var ElementHelper The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return ElementHelper An instance of the class.
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     */
    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;

    }

    public static function category_list() {
        $args = [
            'number' => 100,
        ];

        $list = [ 'Select Category' => '' ];

        if ( INDSRO_CORE_WOOCOMMERCE_ACTIVED ) {

            $product_categories = get_terms( 'product_cat', $args );
            if ( !empty( $product_categories ) ) {

                foreach ( $product_categories as $product_categorie ) {
                    $list[$product_categorie->name] = $product_categorie->slug;
                }
            }
        }

        return $list;
    }

    public static function add_to_cart_button_text( $product_id ) {
        if ( INDSRO_CORE_WOOCOMMERCE_ACTIVED ) {
            $product = wc_get_product( $product_id );
            if ( $product ) {
                $defaults = [
                    'quantity' => 1,
                    'class'    => implode( ' ', array_filter( [
                        '',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? '' : '',
                        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
                    ] ) ),
                ];

                extract( $defaults );

                return sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s add_to_cart_button tx-button blta-product-action-btn"><i class="fa-solid fa-cart-shopping"></i></a>',
                    esc_url( $product->add_to_cart_url() ),
                    esc_attr( isset( $quantity ) ? $quantity : 1 ),
                    esc_attr( $product->get_id() ),
                    esc_attr( $product->get_sku() ),
                    esc_attr( isset( $class ) ? $class : 'button' )
                );
            }
        }
    }

    public static function product_price( $product_id, $oldp = false ) {

        $product = wc_get_product( $product_id );

        $old = '';
        $price = $product->get_regular_price();

        if ( $product->get_sale_price() != '' ) {

            $price = $product->get_sale_price();

            if ( $oldp ) {
                $old = '<span class="old-price gray-color pr-2">
                <del>' . get_woocommerce_currency_symbol( get_woocommerce_currency() ) . $product->get_regular_price() . '</del></span>';
            }
        }

        $price = get_woocommerce_currency_symbol( get_woocommerce_currency() ) . $price;

        if ( $product->get_type() == 'grouped' ) {
            return false;
        }

        return '<span class="price">'. $old . $price . '</span> ' ;
    }

    public static function product_rating( $product_id ) {

        global $product;
        $rating = $product->get_average_rating();
        $rating_count = $product->get_review_count();
        $review = 'Rating ' . $rating . ' out of 5';
        $html = '';
        $html .= '<div class="rating" title="' . $review . '">';
        for ( $i = 0; $i <= 4; $i++ ) {
            if ($i < floor($rating)) {
                $html .= '<i class="fi flaticon-star"></i> ';
            } else {
                $html .= '<i class="ti-star"></i>';
            }
        }
        $html .= '<span class="review_text"> ' . $rating_count . ' review</span>';
        $html .= '</div>';
        return $html;
    }

    /**
     * product_get_terms
     */
    public static function product_get_terms( $id, $tax ) {

        $terms = get_the_terms( get_the_ID(), $tax );

        $list = '';
        if ( $terms && !is_wp_error( $terms ) ):
            $i = 1;
            $cats_count = count( $terms );

            foreach ( $terms as $term ) {
                $exatra = ( $cats_count > $i ) ? ', ' : '';
                $list .= $term->name . $exatra;
                $i++;
            }
        endif;

        return trim( $list, ',' );
    }

    // tx_wishlist_button
    public static function wishlist_button( $product_id ) {
        if ( class_exists( 'WPCleverWoosw' ) && INDSRO_CORE_WOOCOMMERCE_ACTIVED ) {
            global $product;
            $product = wc_get_product( $product_id );
            $html = '';
            if ( $product_id ) {
                $html .= '<div class="tx-wishlistButton blta-product-action-btn">';
                $html .= do_shortcode('[woosw id="'.esc_attr( $product_id ).'"]');
                $html .= '</div>';
            }

            return $html;
        }
    }

    // indsro product_thumb
    public static function product_thumb( $product_id, $size = 'woocommerce_thumbnail' ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), $size );
        $image = $image[0];
        return $image;
    }

    public static function product_stock( $product_id ) {
        $product = wc_get_product( $product_id );
        return $product->get_stock_quantity();
    }

}

Element_El_Woocommerce::instance();