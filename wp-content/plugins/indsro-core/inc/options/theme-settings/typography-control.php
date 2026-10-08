<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => esc_html__( 'Typography Settings', 'indsro-core' ),
    'parent' => 'theme_settings',
    'priority' => 3,
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Typography Settings', 'indsro-core' ) . '</h3>',
        ],
        [
            'id'     => 'body-typography',
            'type'   => 'typography',
            'output' => 'body, p, span, a',
            'title'  => esc_html__( 'Body Typography', 'indsro-core' ),
            'output_important' => true,
        ],
        [
            'id'     => 'heading-gl-typo',
            'type'   => 'typography',
            'output' => 'h1, h2, h3, h4, h5, h6',
            'title'  => esc_html__( 'Heading Typography', 'indsro-core' ),
            'output_important' => true,
        ],
    ],
] );