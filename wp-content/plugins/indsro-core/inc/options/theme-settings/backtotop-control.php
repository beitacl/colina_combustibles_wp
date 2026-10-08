<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => 'Scroll Up ON/OFF ',
    'parent' => 'theme_settings',
    'fields' => [
        [
            'id'      => 'enable_scroll_up',
            'title'   => esc_html__( 'Enable Scroll Up Button', 'indsro-core' ),
            'type'    => 'switcher',
            'desc'    => esc_html__( 'Enable or Disable Scroll Up Button', 'indsro-core' ),
            'default' => true,
        ],
    ],
] );