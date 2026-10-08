<?php

// WOOCOMERCE PAGINATION
function indsro_woo_pagination( $pagination ) {
    $pagi = '';
    if ( $pagination != '' ) {
        $pagi .= '<div class="tx-pagination tx-pagination__styleShop pagination-outer text-center mt-40">
        <ul class="pagination d-flex align-items-center justify-content-center mb-0">';
        foreach ( $pagination as $key => $pg ) {
            $pagi .= '<li class="page-item">' . $pg . '</li>';
        }
        $pagi .= '</ul></div>';
    }
    return $pagi;
}