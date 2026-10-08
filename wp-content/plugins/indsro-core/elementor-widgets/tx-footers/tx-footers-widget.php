<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Footers extends Element_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Indsro Core widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'tx_footers';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __( 'TX Footers', 'indsro-core' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.themexriver.com/widgets/gradient-heading/';
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'elh-widget-icon eicon-t-letter';
    }

    public function get_keywords() {
        return ['btn', 'header', 'indsro', 'indsro header'];
    }

    // get menu by slug
    public function get_menu() {
        $menus = wp_get_nav_menus();
        $menu_list = [];
        if ( $menus ) {
            foreach ( $menus as $menu ) {
                $menu_list[$menu->slug] = $menu->name;
            }
        }
        return $menu_list;
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_design_settings',
            [
                'label' => __( 'DESIGN STYLE', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label'              => __( 'Design Style', 'indsro-core' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'style_1' => __( 'Footer One', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        //Footer widgets
        $this->start_controls_section(
            '_section_footer_widgets',
            [
                'label' => __( 'Footer Widgets', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // repeater
        $repeater = new Repeater();

        // widget title
        $repeater->add_control(
            'footer_widget_title',
            [
                'label'       => __( 'Widget Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Widget Title', 'indsro-core' ),
            ]
        );

        // footer menu
        $repeater->add_control(
            'footer_widget_menu',
            [
                'label'   => __( 'Select Menu', 'indsro-core' ),
                'type'    => Controls_Manager::SELECT2,
                'options' => $this->get_menu(),
            ]
        );

        // list items
        $this->add_control(
            'footer_widgets',
            [
                'label'       => __( 'Footer Widgets', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ footer_widget_title }}}',
            ]
        );

        $this->end_controls_section();

        // footer app widget
        $this->start_controls_section(
            '_section_footer_app_widget',
            [
                'label' => __( 'Footer App Widget', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // app widget title
        $this->add_control(
            'footer_app_widget_title',
            [
                'label'       => __( 'Widget Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Get app', 'indsro-core' ),
            ]
        );

        // repeater
        $repeater = new Repeater();

        // app link
        $repeater->add_control(
            'footer_app_link',
            [
                'label'       => __( 'App Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        // app image
        $repeater->add_control(
            'footer_app_image',
            [
                'label'   => __( 'App Image', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // list items
        $this->add_control(
            'footer_app_widgets',
            [
                'label'       => __( 'Footer App Widgets', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();


    }

    protected function register_style_controls() {

        $dir = dirname( __FILE__ );
        $style_files = glob( $dir . '/styles/*.php' );

        if ( $style_files ) {
            foreach ( $style_files as $style_file ) {
                include $style_file;
            }
        }

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

        $style = !empty( $settings['design_style'] ) ? $settings['design_style'] : 'style_1';

        switch ( $style ) {
        case 'style_3':
            include $dir . '/views/view-3.php';
            break;
        case 'style_2':
            include $dir . '/views/view-2.php';
            break;
        default:
            include $dir . '/views/view-1.php';
        }
    }
}
