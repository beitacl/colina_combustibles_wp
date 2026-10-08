<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'    => esc_html__( 'Logo Settings', 'indsro-core' ),
    'parent'   => 'header_settings',
    'priority' => 1,
    'fields'   => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Logo Settings', 'indsro-core' ) . '</h3>',
            'desc'    => esc_html__( 'This option only for changing the default logo, If you set Header from Elementor Please Check The Header Builder for changing header logo and content', 'indsro-core' ),
        ],
        // tx_logo
        [
            'id'            => 'tx_logo',
            'title'         => esc_html__( 'Default Logo', 'indsro-core' ),
            'type'          => 'media',
            'desc'          => esc_html__( 'Upload Logo', 'indsro-core' ),
            'default'       => [
                'url'    => get_template_directory_uri() . '/assets/img/logo/logo-white.webp',
                'width'  => '150px',
                'height' => '50px',
            ],
            'preview'       => true,
            'preview_width' => '150',
        ],

        // indsro_site_logo
        [
            'id'            => 'tx_sideInfo_logo',
            'title'         => esc_html__( 'Side Info Logo', 'indsro-core' ),
            'type'          => 'media',
            'desc'          => esc_html__( 'Upload Side Info Logo', 'indsro-core' ),
            'default'       => [
                'url'    => get_template_directory_uri() . '/assets/img/logo/logo-2.webp',
                'width'  => '150px',
                'height' => '50px',
            ],
            'preview'       => true,
            'preview_width' => '150',
        ],

        // logo width
        [
            'id'          => 'tx_logo_width',
            'type'        => 'slider',
            'title'       => 'Logo Width',
            'min'         => 80,
            'max'         => 500,
            'step'        => 1,
            'unit'        => 'px',
            'default'     => 142,
            'output'      => '.tx-header .tx-logo img',
            'output_mode' => 'max-width',
        ],

    ],
] );