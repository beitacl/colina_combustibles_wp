<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package indsro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function indsro_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    if ( !is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }
    return $classes;
}
add_filter( 'body_class', 'indsro_body_classes' );

/**
 * Get tags.
 */
function indsro_get_tag() {
    $html = '';
    if ( has_tag() ) {
        $html .= '<span class="fti-heading-3 blog-details-social-title">' . esc_html__( 'Tags: ', 'indsro' ) . '</span>';
        $html .= '<div class="blog-details-tag-wrap">';
        $html .= get_the_tag_list( '', '', '' );
        $html .= '</div>';
    }
    return $html;
}

/**
 * Get categories.
 */
function indsro_get_category() {

    $categories = get_the_category( get_the_ID() );
    $x = 0;
    foreach ( $categories as $category ) {
        if ( $x == 1 ) {
            break;
        }
        $x++;
     print '<a class="blog-cat" href="' . get_category_link( $category->term_id ) . '">' . esc_html( $category->name ) . '</a>';

    }
}

function indsro_get_recent_category() {

    $categories = get_the_category( get_the_ID() );
    $x = 0;
    foreach ( $categories as $category ) {
        if ( $x == 1 ) {
            break;
        }
        $x++;
     print '<span>' . esc_html( $category->name ) . '</span>';

    }
}

/** img alt-text **/
function indsro_img_alt_text( $img_er_id = null ) {
    if ( empty( $img_er_id ) ) {
        return esc_html__( 'Image Alt Text', 'indsro' );
    }

    // Convert URL to attachment ID if necessary
    if ( filter_var( $img_er_id, FILTER_VALIDATE_URL ) ) {
        $img_er_id = attachment_url_to_postid( $img_er_id );
    }

    $image_alt = get_post_meta( $img_er_id, '_wp_attachment_image_alt', true );
    $alt_text = ! empty( $image_alt ) ? $image_alt : get_the_title( $img_er_id );

    return $alt_text;
}




// indsro_ofer_sidebar_func
function indsro_offer_sidebar_func() {
    if ( is_active_sidebar( 'offer-sidebar' ) ) {

        dynamic_sidebar( 'offer-sidebar' );
    }
}
add_action( 'indsro_offer_sidebar', 'indsro_offer_sidebar_func', 20 );

// indsro_service_sidebar
function indsro_service_sidebar_func() {
    if ( is_active_sidebar( 'services-sidebar' ) ) {

        dynamic_sidebar( 'services-sidebar' );
    }
}
add_action( 'indsro_service_sidebar', 'indsro_service_sidebar_func', 20 );

// indsro_portfolio_sidebar
function indsro_portfolio_sidebar_func() {
    if ( is_active_sidebar( 'portfolio-sidebar' ) ) {

        dynamic_sidebar( 'portfolio-sidebar' );
    }
}
add_action( 'indsro_portfolio_sidebar', 'indsro_portfolio_sidebar_func', 20 );

// indsro_faq_sidebar
function indsro_faq_sidebar_func() {
    if ( is_active_sidebar( 'faq-sidebar' ) ) {

        dynamic_sidebar( 'faq-sidebar' );
    }
}
add_action( 'indsro_faq_sidebar', 'indsro_faq_sidebar_func', 20 );

// mega menu filter
add_filter( 'indsro_enable_megamenu', 'indsro_enable_megamenu' );
function indsro_enable_megamenu() {
	return true;
}

/* ------Disable Lazy loading---- */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

// menu badge function
add_filter('wp_nav_menu_objects', 'indsro_wp_nav_menu_objects', 10, 2);

function indsro_wp_nav_menu_objects( $items, $args ) {
	// loop
	foreach( $items as &$item ) {

        $menu_badge = function_exists( 'get_field' ) ? get_field( 'menu_badge', $item ) : '';
		// append icon
		if( !empty( $menu_badge ) ) {
			$item->title .= ' <span class="indsro-menu-badge">'.esc_attr($menu_badge).'</span>';
		}
	}
	// return
	return $items;

}

// post view function
function indsro_post_view($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '1');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}


// enable mega menu
add_filter( 'ct_enable_megamenu', 'itfirm_enable_megamenu' );
function itfirm_enable_megamenu() {
	return true;
}


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function indsro_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'indsro_pingback_header' );

/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'indsro_shortcode_extra_content_remove' );
function indsro_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}

// enable_rtl
function indsro_enable_rtl() {
    if ( cs_get_option( 'enable_rtl', false ) ) {
        return ' dir="rtl" ';
    } else {
        return '';
    }
}

function indsro_fonts_url() {
    $font_url = '';
    /**
    * Translators: If there are characters in your language that are not supported
    * by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'indsro' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Epilogue:ital,wght@0,100..900;1,100..900&family=Monda:wght@400;700&family=Teko:wght@300..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap';
    }
    return $font_url;
}

// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 *
 * pagination
 */
if ( !function_exists( 'indsro_pagination' ) ) {

    function _indsro_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function indsro_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul class="fti-pagination mt-50">';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li class="fti-pagination-item">' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _indsro_pagi_callback( $pagi );
    }
}

// rtl_enable
function rtl_enable() {
    $my_current_lang = apply_filters( 'wpml_current_language', NULL );
    $rtl_enable = cs_get_option( 'enable_rtl', false );
    if ( $my_current_lang != 'en' && $rtl_enable ) {
        return true;
    } else {
        return false;
    }
}

function indsro_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ]
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
        'href' => [],
        'title' => [],
        'class' => [],
        'id' => [],
        ];
        $allowed_html['div'] = [
        'class' => [],
        'id' => [],
        ];
        $allowed_html['img'] = [
        'src' => [],
        'class' => [],
        'alt' => [],
        ];
        $allowed_html = [
            'bdi' => [],
            'br' => [],
        ];
    }

    return $allowed_html;
}

// indsro_kses_basic
function indsro_kses_basic( $string = '' ) {
    return wp_kses( $string, indsro_get_allowed_html_tags( 'basic' ) );
}

// indsro_kses_intermediate
function indsro_kses_intermediate( $string = '' ) {
    return wp_kses( $string, indsro_get_allowed_html_tags( 'intermediate' ) );
}


// indsro_search_form
function indsro_search_popup_form() {
    ?>
    <div class="search-popup">
		<div class="color-layer"></div>
		<button class="close-search"><span class="far fa-times fa-fw"></span></button>
		<form method="get" action="<?php print esc_url( home_url( '/' ) );?>">
			<div class="form-group">
                <input type="search" name="s" placeholder="<?php print esc_attr__( 'Search Here', 'indsro' );?>" value="<?php print esc_attr( get_search_query() )?>">
				<button type="submit"><i class="fas fa-search fa-fw"></i></button>
			</div>
		</form>
	</div>
    <?php
}

// indsro_search_form
function indsro_search_mobile() {
    ?>
    <div class="search-box">
        <form method="get" action="<?php print esc_url( home_url( '/' ) );?>">
            <div class="form-group">
                <input type="search" name="s" placeholder="<?php print esc_attr__( 'SEARCH HERE', 'indsro' );?>" value="<?php print esc_attr( get_search_query() )?>">
                <button type="submit"><span class="icon fas fa-search fa-fw"></span></button>
            </div>
        </form>
    </div>
    <?php
}

// indsro product search_form
function indsro_woo_search_form() {
    ?>
    <form method="get" action="<?php print esc_url(home_url('/')); ?>">
        <div class="indsro-woo-search">
            <input type="hidden" name="post_type" value="product">
            <input type="search" name="s" placeholder="<?php print esc_attr__('Product name E. G.', 'indsro'); ?>">

            <?php $terms = (!empty(get_terms('product_cat'))) ? get_terms('product_cat') : ''; ?>
            <select class="indsro-woo-search__select" name="product_cat">
                <option selected disabled><?php print esc_html__('Categories', 'indsro'); ?></option>
                <?php foreach ($terms as $term): ?>
                <option value="<?php print esc_attr($term->slug); ?>"><?php print esc_html($term->name); ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit"><i class="fal fa-search"></i></button>
        </div>
    </form>
    <?php
}


function advanced_search_query($query) {

    if($query->is_search()) {
        // category terms search.
        if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
            $query->set('tax_query', array(array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array($_GET['product_cat']) )
            ));
        }
    }
    return $query;
}
add_action('pre_get_posts', 'advanced_search_query', 1000);

function indsro_woo_search_popup() {
    ?>
    <div class="search-popup-wrapper">
        <div class="inner-wrapper">
            <button class="close-button" data-search-close><i class="fal fa-times"></i></button>
            <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                <div class="indsro-woo-search indsro-woo-search__popup">
                    <input type="hidden" name="post_type" value="product">
                    <input type="search" name="s" placeholder="<?php print esc_attr__('Product name E. G.', 'indsro'); ?>">

                    <?php $terms = (!empty(get_terms('product_cat'))) ? get_terms('product_cat') : ''; ?>
                    <select class="indsro-woo-search__select" name="product_cat">
                        <option selected disabled><?php print esc_html__('Categories', 'indsro'); ?></option>
                        <?php foreach ($terms as $term): ?>
                        <option value="<?php print esc_attr($term->slug); ?>"><?php print esc_html($term->name); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit"><i class="fal fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <?php
}

// indsro_copyright_text
function indsro_copyright_text() {
    print cs_get_option( 'tx_copyright', indsro_kses_basic( '© Copyright 2023, Indsro All Rights Reserved.', 'indsro' ) );
}

// post view function
function indsro_post_view_count( $postID ) {
    $countKey = 'post_views_count';
    $count = get_post_meta( $postID, $countKey, true );
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $countKey );
        add_post_meta( $postID, $countKey, '1' );
    } else {
        $count++;
        update_post_meta( $postID, $countKey, $count );
    }
}

function indsro_add_cart_button() {
    if ( INDSRO_WOOCOMMERCE_ACTIVED ) {
        global $product;

        $product_id = get_the_ID();
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