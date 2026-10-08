<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => 'Preloader ON/OFF',
    'parent' => 'theme_settings',
    'priority' => 1,
    'fields' => [
        [
            'id'      => 'preloader_enable',
            'title'   => esc_html__( 'Enable Preloader', 'indsro-core' ),
            'type'    => 'switcher',
            'desc'    => esc_html__( 'Enable or Disable Preloader', 'indsro-core' ),
            'default' => true,
        ],

        // preloader image
        [
            'id'       => 'preloader_image',
            'type'     => 'media',
            'title'    => esc_html__( 'Preloader Image', 'indsro-core' ),
            'desc'     => esc_html__( 'Upload Preloader Image', 'indsro-core' ),
            'default'  => [
                'url' => get_template_directory_uri() . '/assets/img/logo/logo-2.webp',
            ],
            'dependency' => ['preloader_enable', '==', 'true'],
        ],

        // preloader gif
        [
            'id'       => 'preloader_gif',
            'type'     => 'media',
            'title'    => esc_html__( 'Preloader Gif', 'indsro-core' ),
            'desc'     => esc_html__( 'Upload Preloader Gif', 'indsro-core' ),
            'default'  => [
                'url' => get_template_directory_uri() . '/assets/img/preloader.gif',
            ],
            'dependency' => ['preloader_enable', '==', 'true'],
        ],

        // preloader canvas background color
        [
            'id'      => 'preloader_canvas_bg_color',
            'type'    => 'color',
            'title'   => esc_html__( 'Canvas Background Color', 'indsro-core' ),
            'default' => '#000',
            'output'  => '#tx_preloader',
            'dependency' => ['preloader_enable', '==', 'true'],
            'output_mode' => 'background-color',
        ],

        // size
        [
            'id'          => 'preloader_image_width',
            'type'        => 'slider',
            'title'       => 'Width',
            'min'         => 50,
            'max'         => 300,
            'step'        => 1,
            'unit'        => 'px',
            'output'      => '#tx_preloader .logo',
            'output_mode' => 'width',
        ],

        // preloader icon size
        [
            'id'          => 'preloader_icon_size',
            'type'        => 'slider',
            'title'       => 'Icon Size',
            'min'         => 20,
            'max'         => 200,
            'step'        => 1,
            'unit'        => 'px',
            'output'      => '#tx_preloader .icon-ani img',
            'output_mode' => 'width',
        ],
    ],
] );