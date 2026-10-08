<?php
namespace ElementHelper;

defined( 'ABSPATH' ) || die();

class Element_El_Icons {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [__CLASS__, 'add_elh_el_icons_tab'] );
        add_filter( 'elementor/icons_manager/additional_tabs', [__CLASS__, 'add_elh_flaticon_tab'] );
    }

    public static function add_elh_el_icons_tab( $tabs ) {
        $tabs['element-helper-icons'] = [
            'name'          => 'element-helper-icons',
            'label'         => __( 'Fontawesome Icons (Pro)', 'element-helper' ),
            'url'           => TA_ASSETS . 'css/font-awesome.min.css',
            'enqueue'       => [TA_ASSETS . 'css/font-awesome.min.css'],
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'fab fa-font-awesome',
            'ver'           => ELH_VERSION,
            'fetchJson'     => TA_ASSETS . 'js/elh-fontAwesome-icons.js?v=' . ELH_VERSION,
            'native'        => false,
        ];
        return $tabs;
    }

    public static function add_elh_flaticon_tab( $tabs ) {
        $tabs['element-helper-flaticon'] = [
            'name'          => 'element-helper-flaticon',
            'label'         => __( 'Flaticon Icons', 'element-helper' ),
            'url'           => TA_ASSETS . 'css/flaticon-indsro.css',
            'enqueue'       => [TA_ASSETS . 'css/flaticon-indsro.css'],
            'prefix'        => 'flaticon-',
            'displayPrefix' => 'flaticon',
            'labelIcon'     => 'fab fa-fonticons',
            'ver'           => ELH_VERSION,
            'fetchJson'     => TA_ASSETS . 'js/elh-flaticon.js?v=' . ELH_VERSION,
            'native'        => false,
        ];
        return $tabs;
    }
}