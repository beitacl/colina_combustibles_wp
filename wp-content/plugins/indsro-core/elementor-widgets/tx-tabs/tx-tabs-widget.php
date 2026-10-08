<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Tabs extends Element_El_Widget {

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
        return 'tx_tabs';
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
        return __( 'TX Tabs', 'indsro-core' );
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
        return ['country', 'tab'];
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
                    'style_1' => __( 'Style 1', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_project_tab',
            [
                'label' => __( 'Tabs', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // repeater
        $repeater = new Repeater();

        // is_active
        $repeater->add_control(
            'is_active',
            [
                'label'        => __( 'Active', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // tab_title
        $repeater->add_control(
            'tab_title',
            [
                'label'       => __( 'Tab Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Tab Title', 'indsro-core' ),
                'placeholder' => __( 'Type your title here', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // tab_image
        $repeater->add_control(
            'tab_image',
            [
                'label'   => __( 'Tab Image', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // tab_content
        $repeater->add_control(
            'tab_content',
            [
                'label'       => __( 'Tab Content', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Tab Content', 'indsro-core' ),
                'placeholder' => __( 'Type your content here', 'indsro-core' ),
                'show_label'  => false,
            ]
        );


        // button_text
        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'Text-domain' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label'       => esc_html__( 'Button Link', 'Text-domain' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        // lists items
        $this->add_control(
            'txTab_lists',
            [
                'label'  => __( 'Tabs', 'indsro-core' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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
        case 'style_2':
            include $dir . '/views/view-2.php';
            break;
        default:
            include $dir . '/views/view-1.php';
        }
    }
}
