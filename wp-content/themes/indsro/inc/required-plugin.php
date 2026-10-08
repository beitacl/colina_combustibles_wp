<?php

add_action( 'tgmpa_register', 'indsro_register_required_plugins' );

function indsro_register_required_plugins() {

    $plugins = [
        [
            'name'               => esc_html__( 'Indsro Core', 'indsro' ),
            'slug'               => 'indsro-core',
            'source'             => esc_url( 'https://themexriver.com/wp/indsro/indsro-plug/indsro-core.zip' ),
            'external_url'       => esc_url( 'https://themexriver.com/wp/indsro/indsro-plug/indsro-core.zip' ),
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ],
        [
            'name'     => esc_html__( 'Elementor Page Builder', 'indsro' ),
            'slug'     => 'elementor',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'WP Classic Editor', 'indsro' ),
            'slug'     => 'classic-editor',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Contact Form 7', 'indsro' ),
            'slug'     => 'contact-form-7',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'WooCommerce', 'indsro' ),
            'slug'     => 'woocommerce',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'One Click Demo Import', 'indsro' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'SVG Support', 'indsro' ),
            'slug'     => 'svg-support',
            'required' => false,
        ],

    ];

    $config = [
        'id'           => 'indsro',
        'parent_slug'  => 'indsro',
        'menu'         => 'tgmpa-install-plugins',
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'default_path' => '',
    ];

    tgmpa( $plugins, $config );
}
