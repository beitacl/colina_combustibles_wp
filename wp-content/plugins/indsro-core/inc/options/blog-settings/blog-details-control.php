<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => esc_html__( 'Blog Details Settings', 'indsro-core' ),
    'parent' => 'blog_settings',
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Blog Details Settings', 'indsro-core' ) . '</h3>',
        ],
        // enable social share
        [
            'id'      => 'tx_enable_social_share',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Enable Social Share', 'indsro-core' ),
            'default' => false,
        ],

        // social share heading
        [
            'id'      => 'tx_social_share_heading',
            'type'    => 'text',
            'title'   => esc_html__( 'Social Share Heading', 'indsro-core' ),
            'default' => esc_html__( 'Share Article', 'indsro-core' ),
            'dependency' => [ 'tx_enable_social_share', '==', 'true' ],
        ],

        // enable blog navigation
        [
            'id'      => 'tx_enable_blog_navigation',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Enable Blog Navigation', 'indsro-core' ),
            'default' => false,
        ],

    ],
] );
