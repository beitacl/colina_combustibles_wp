<?php
// indsro_search_filter_form
if ( !function_exists( 'indsro_search_filter_form' ) ) {
    function indsro_search_filter_form( $form ) {

        $form = sprintf(
            '<div class="search-widget"><form class="tx-search-widget tx-input-field sidebar-search-box" action="%s" method="get">
                <input type="search" value="%s" required name="s" placeholder="%s" class="search-input sidebar-search-input">
                <button type="submit" aria-label="search" class="search-btn sidebar-search-icon"><i class="fal fa-search"></i></button>
		    </form></div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search...', 'indsro' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'indsro_search_filter_form' );
    add_filter('render_block_core/search', 'indsro_search_filter_form');
}


// woocommerce search widget form
if ( INDSRO_WOOCOMMERCE_ACTIVED && !function_exists( 'indsro_woocommerce_product_search' ) ) {
    function indsro_woocommerce_product_search( $form ) {

        $form = sprintf(
            '<div class="search-widget"><form class="tx-search-widget tx-input-field sidebar-search-box" action="%s" method="get">
                <input type="search" value="%s" required name="s" placeholder="%s" class="search-input sidebar-search-input">
                <button type="submit" aria-label="search" class="search-btn sidebar-search-icon"><i class="fal fa-search"></i></button>
            </form></div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search...', 'indsro' )
        );

        return $form;
    }
    add_filter( 'get_product_search_form', 'indsro_woocommerce_product_search' );
    add_filter('render_block_core/search', 'indsro_woocommerce_product_search');
}