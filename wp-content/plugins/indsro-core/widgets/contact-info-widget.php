<?php

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {

    CSF::createWidget( 'conact_info_widget', [
        'title'       => 'Indsro Contact Info Widget',
        'classname'   => 'tx-contactInfo-widget',
        'fields'      => [
            // image
            [
                'id'    => 'bg_image',
                'type'  => 'media',
                'title' => 'Image',
            ],
            [
                'id'    => 'icon',
                'type'  => 'icon',
                'title' => 'Icon',
            ],
            // number
            [
                'id'    => 'number',
                'type'  => 'text',
                'title' => 'Number',
            ],
            // link
            [
                'id'    => 'number_link',
                'type'  => 'text',
                'title' => 'Link',
            ],
            // office hour
            [
                'id'    => 'office_hour',
                'type'  => 'textarea',
                'title' => 'Office Hour',
            ],
        ],
    ] );

    if ( !function_exists( 'conact_info_widget' ) ) {
        function conact_info_widget( $args, $instance ) {

            echo $args['before_widget'];

            $bg_image = isset($instance['bg_image']['url']) ? $instance['bg_image']['url'] : '';
            $icon = isset($instance['icon']) ? $instance['icon'] : '';
            $number = isset($instance['number']) ? $instance['number'] : '';
            $number_link = isset($instance['number_link']) ? $instance['number_link'] : '';
            $office_hour = isset($instance['office_hour']) ? $instance['office_hour'] : '';

            $html = '';

            $html .= '
            <div class="sidebar-box-bottom bg-default wow fadeInUp" data-background="'.esc_url($bg_image).'">
                <i class="'.esc_attr($icon).'"></i>
                <a href="'.esc_url($number_link).'">'.esc_html($number).'</a>
                <span>'.esc_html($office_hour).'</span>
            </div>
            ';


            echo $html;

            echo $args['after_widget'];

        }
    }

}
