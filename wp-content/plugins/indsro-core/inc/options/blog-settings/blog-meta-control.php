<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => 'Blog Meta Settings',
    'parent' => 'blog_settings',
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Blog Meta Settings', 'indsro-core' ) . '</h3>',
        ],

        // enable_author_meta
        [
            'id'      => 'enable_author_meta',
            'type'    => 'switcher',
            'title'   => 'Enable Author Meta',
            'default' => true,
        ],

        // enable default date
        [
            'id'      => 'enable_default_date',
            'type'    => 'switcher',
            'title'   => 'Enable Default Date',
            'default' => true,
        ],

        // enable_comment_meta
        [
            'id'      => 'enable_comment_meta',
            'type'    => 'switcher',
            'title'   => 'Enable Comment Meta',
            'default' => true,
        ],
    ],
] );