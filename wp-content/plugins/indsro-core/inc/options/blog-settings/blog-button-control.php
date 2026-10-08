<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => 'Blog Button Settings',
    'parent' => 'blog_settings',
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Blog Button Settings', 'indsro-core' ) . '</h3>',
        ],
        // enable_blog_button
        [
            'id'      => 'enable_blog_button',
            'type'    => 'switcher',
            'title'   => 'Enable Blog Button',
            'default' => true,
        ],
        // blog_button_text
        [
            'id'      => 'blog_button_text',
            'type'    => 'text',
            'title'   => 'Blog Button Text',
            'default' => 'Read More',
            'dependency' => [
                'enable_blog_button',
                '==',
                'true'
            ],
        ],
    ],
] );