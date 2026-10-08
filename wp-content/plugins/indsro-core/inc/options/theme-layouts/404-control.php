<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => esc_html__( '404 Page Layout', 'indsro-core' ),
    'parent' => 'theme_layout',
    'priority' => 4,
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( '404 Page Layout', 'indsro-core' ) . '</h3>',
        ],
        [
            'id'    => 'tx_error_image',
            'type'  => 'media',
            'title' => esc_html__( 'Error Code Image', 'indsro-core' ),
            'default' => get_template_directory_uri() . '/assets/img/oops/oops.webp',
        ],
        [
            'id'      => 'tx_error_title',
            'type'    => 'text',
            'title'   => esc_html__( '404 Title', 'indsro-core' ),
            'default' => esc_html__( 'Oops! Page Not found.', 'indsro-core' ),
        ],
        [
            'id'      => 'tx_error_link_text',
            'type'    => 'text',
            'title'   => esc_html__( '404 Button', 'indsro-core' ),
            'default' => esc_html__( 'Go Back to Home ', 'indsro-core' ),
        ],
    ],
] );