<?php

CSF::createSection( $prefix . '_theme_options', [
    'title'  => esc_html__( 'Footer Layout', 'indsro-core' ),
    'parent' => 'theme_layout',
    'priority' => 2,
    'fields' => [
        [
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__( 'Footer Layout', 'indsro-core' ) . '</h3>',
        ],
        // Footer Style
        [
            'id'      => 'footer_style',
            'type'    => 'select',
            'title'   => __( 'Select Footer Style', 'indsro-core' ),
            'options' => Indsro_Core_Helper::get_footer_types(),
        ],
        [
            'type'    => 'subheading',
            'content' => '<p>' . esc_html__( 'Please click the button to change Footer content', 'indsro-core' ) . ' <a href="' . esc_url( admin_url( 'edit.php?post_type=tf-footer' ) ) . '">' . esc_html__( 'Edit Footer', 'indsro-core' ) . '</a></p> ',
        ],
    ],
] );