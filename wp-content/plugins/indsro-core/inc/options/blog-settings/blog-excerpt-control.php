<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => 'Blog Excerpt Settings',
    'parent' => 'blog_settings',
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Blog Excerpt Settings', 'indsro-core' ) . '</h3>',
        ],
        // excerpt length
        [
            'id'      => 'excerpt_length',
            'type'    => 'number',
            'title'   => 'Excerpt Length',
            'default' => 180,
        ],
    ],
] );