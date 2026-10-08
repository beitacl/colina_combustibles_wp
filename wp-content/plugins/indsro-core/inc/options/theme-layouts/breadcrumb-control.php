<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => esc_html__( 'Breadcrumb Layout', 'indsro-core' ),
    'parent' => 'theme_layout',
    'priority' => 3,
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Breadcrumb Layout', 'indsro-core' ) . '</h3>',
        ],
        [
            'id'      => 'breadcrumb_bg_img',
            'title'   => esc_html__( 'Breadcrumb Image', 'indsro-core' ),
            'type'    => 'media',
            'desc'    => esc_html__( 'Upload breadcrumb Image', 'indsro-core' ),
            'preview_width' => '500',
            'preview_height' => '300',
        ],

        // enable breadcrumb list
        [
            'id'      => 'enable_breadcrumb_list',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Enable Breadcrumb List', 'indsro-core' ),
            'default' => true,
        ],

        // enable_breadcrumb_shape
        [
            'id'      => 'enable_breadcrumb_shape',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Enable Breadcrumb Shape', 'indsro-core' ),
            'default' => true,
        ],

        // breadcrumb_shape_1
        [
            'id'      => 'breadcrumb_shape_1',
            'title'   => esc_html__( 'Breadcrumb Shape 1', 'indsro-core' ),
            'type'    => 'media',
            'desc'    => esc_html__( 'Upload breadcrumb shape 1', 'indsro-core' ),
            'dependency' => [
                'enable_breadcrumb_shape',
                '==',
                true
            ],
        ],

        // breadcrumb_shape_2
        [
            'id'      => 'breadcrumb_shape_2',
            'title'   => esc_html__( 'Breadcrumb Shape 2', 'indsro-core' ),
            'type'    => 'media',
            'desc'    => esc_html__( 'Upload breadcrumb shape 2', 'indsro-core' ),
            'dependency' => [
                'enable_breadcrumb_shape',
                '==',
                true
            ],
        ],

        // breadcrub padding
        [
            'id'          => 'breadcrumb_padding',
            'type'        => 'spacing',
            'title'       => esc_html__( 'Breadcrumb Padding', 'indsro-core' ),
            'output'      => '.tx-breadcrumb',
            'output_mode' => 'padding',
            'units'       => [ 'px', 'em' ],
            'default'     => [
                'top'    => '100px',
                'right'  => '0px',
                'bottom' => '100px',
                'left'   => '0px',
            ],
        ],

    ],
] );