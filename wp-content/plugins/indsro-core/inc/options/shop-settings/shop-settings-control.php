<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'    => esc_html__( 'Shop Settings ON/OFF', 'indsro-core' ),
    'parent'   => 'shop_settings',
    'priority' => 4,
    'fields'   => [
        [
            'id'      => 'enable_custom_add_to_cart_text',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Enable custom add to cart text', 'indsro-core' ),
            'default' => false,
            'desc'    => esc_html__( 'Enable/Disable custom add to cart text', 'indsro-core' ),
        ],
        [
            'id'      => 'custom_add_to_cart_text',
            'type'    => 'text',
            'title'   => esc_html__( 'Custom add to cart text', 'indsro-core' ),
            'default' => esc_html__( 'Purchase Now', 'indsro-core' ),
            'desc'    => esc_html__( 'Custom add to cart text', 'indsro-core' ),
            'dependency' => [
                'enable_custom_add_to_cart_text',
                '==',
                'true'
            ]
        ],
    ],
] );