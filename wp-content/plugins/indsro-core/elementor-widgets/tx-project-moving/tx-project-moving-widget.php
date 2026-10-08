<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Project_Moving extends Element_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Element Helper widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'tx_project_moving';
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
        return __( 'Moving Project', 'indsro-core' );
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
        return ['btn', 'lists', 'info', 'info lists'];
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_design_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
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
            '_section_list_items',
            [
                'label' => __( 'Project', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // list image
        $repeater->add_control(
            'project_img',
            [
                'label'       => __( 'Project Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Unique social marketing design', 'indsro-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'category',
            [
                'label'       => __( 'Category', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'marketing', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // list_link
        $repeater->add_control(
            'list_link',
            [
                'label'       => __( 'Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        // button icon
        $repeater->add_control(
            'button_icon',
            [
                'label'   => __( 'Button Icon', 'indsro-core' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
            ]
        );

        // project lists
        $this->add_control(
            'project_lists',
            [
                'label'       => __( 'Project Lists', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // ENABLE SLIDER NAV
        $this->add_control(
            'enable_slider_nav',
            [
                'label'        => __( 'Enable Slider Navigation', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // END
        $this->end_controls_section();

    }

    protected function register_style_controls() {

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

        $style = !empty($settings['design_style']) ? $settings['design_style'] : 'style_1';

        switch ($style) {

            case 'style_2':
                include $dir . '/views/view-2.php';
                break;
            default:
                include $dir . '/views/view-1.php';
        }
    }
}
