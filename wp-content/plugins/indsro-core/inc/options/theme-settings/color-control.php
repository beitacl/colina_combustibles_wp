<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'    => esc_html__( 'Color Settings', 'indsro-core' ),
    'parent'   => 'theme_settings',
    'priority' => 2,
    'fields'   => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Color Settings', 'indsro-core' ) . '</h3>',
        ],
        [
            'id'      => '__fti_pr_1',
            'type'    => 'color',
            'title'   => 'Theme Color 1',
            'default' => '#EC6C06',
        ],
        [
            'id'      => '__fti_pr_2',
            'type'    => 'color',
            'title'   => 'Theme Color 2',
            'default' => '#EA5501',
        ],
        [
            'id'      => '__fti_pr_3',
            'type'    => 'color',
            'title'   => 'Theme Color 3',
            'default' => '#ff5317',
        ],
    ],
] );