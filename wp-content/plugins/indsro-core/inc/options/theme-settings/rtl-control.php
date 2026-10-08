<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => 'RTL ON/OFF',
    'parent' => 'theme_settings',
    'fields' => [
        [
            'id'      => 'enable_rtl',
            'title'   => esc_html__( 'Enable RTL', 'indsro-core' ),
            'type'    => 'switcher',
            'desc'    => esc_html__( 'Enable or Disable RTL', 'indsro-core' ),
            'default' => false,
        ],
    ],
] );