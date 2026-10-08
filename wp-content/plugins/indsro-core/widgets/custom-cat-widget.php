<?php

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {

    CSF::createWidget( 'custom_cat_widget', [
        'title'       => 'Indsro Category Widget',
        'classname'   => 'tx-cat-widget',
        'description' => 'Widget description.',
        'fields'      => [
            [
                'id'    => 'title',
                'type'  => 'text',
                'title' => 'Title',
            ],
            [
                'id'     => 'select_cats',
                'type'   => 'repeater',
                'title'  => 'Repeater Field',
                'fields' => [
                    // select cat
                    [
                        'id'         => 'select_cat',
                        'type'       => 'select',
                        'title'      => 'Select Field',
                        'options'    => 'categories',
                        'query_args' => [
                            'taxonomy' => 'category',
                        ],
                    ],
                ],
            ],

        ],
    ] );

    if ( !function_exists( 'custom_cat_widget' ) ) {
        function custom_cat_widget( $args, $instance ) {

            echo $args['before_widget'];

            if ( !empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
            }

            $html = '';

            if (!empty($instance['select_cats']) && is_array($instance['select_cats'])) {
                $html .= '<div class="tx-cat-widget category-widget ul-li-block">';
                $html .= '<ul class="tx-cat-list sidebar-category">';

                foreach ($instance['select_cats'] as $cat) {
                    $html .= '<li class="wow fadeInUp">';
                    $html .= '<a href="' . get_category_link($cat['select_cat']) . '">';

                    // Get the category object and check if it exists
                    $category = get_category($cat['select_cat']);
                    if ($category) {
                        $html .= '<span class="text">' . get_cat_name($cat['select_cat']) . '</span>';
                        $html .= '<span class="number">(' . $category->count . ')</span>';
                        $html .= '<span class="icon-1"><i class="flaticon-right-up"></i></span>';
                    } else {
                        // Handle the case where the category object is null
                        $html .= '<span class="text">Category Not Found</span>';
                    }

                    $html .= '</a>';
                    $html .= '</li>';
                }

                $html .= '</ul>';
                $html .= '</div>';
            }

            echo $html;

            echo $args['after_widget'];

        }
    }

}
