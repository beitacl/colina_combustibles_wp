<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => esc_html__( 'Copyright Text', 'indsro-core' ),
    'parent' => 'footer_settings',
    'priority' => 1,
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Copyright Text', 'indsro-core' ) . '</h3>',
        ],
        // copyright text
        [
            'id'      => 'tx_copyright',
            'title'   => esc_html__( 'Copyright Text', 'indsro-core' ),
            'type'    => 'textarea',
            'desc'    => esc_html__( 'Copyright Text', 'indsro-core' ),
            'default' => '© Copyright 2023, Indsro All Rights Reserved.',
        ],
    ],
] );
