<?php

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {

    // Set a unique slug-like ID
    $tx_user = 'tx_user_option';

    // Create profile options
    CSF::createProfileOptions( $tx_user, [
        'data_type' => 'serialize',
        'title'     => __( 'User Profile', 'indsroplugin' ),
    ] );

    // Create a section
    CSF::createSection( $tx_user, [
        'fields' => [

            // tx_enable_author_box
            [
                'id'      => 'tx_enable_author_box',
                'type'    => 'switcher',
                'title'   => __( 'Enable Author Box', 'indsroplugin' ),
                'default' => true,
            ],
            [
                'id'         => 'tx_user_social',
                'type'       => 'repeater',
                'title'      => __( 'Social Links', 'indsroplugin' ),
                'dependency' => ['tx_enable_author_box', '==', 'true'],
                'fields'     => [
                    [
                        'id'    => 'tx_user_social_icon',
                        'type'  => 'icon',
                        'title' => __( 'Social Icon', 'indsroplugin' ),
                    ],
                    [
                        'id'    => 'tx_user_social_link',
                        'type'  => 'text',
                        'title' => __( 'Social Link', 'indsroplugin' ),
                    ],
                ],
                'title_field' => 'tx_user_social_icon',
            ],
        ],
    ] );

}
