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

class Tx_Social_Links extends Element_El_Widget {

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
        return 'tx_social_links';
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
        return __( 'TX Social Links', 'indsro-core' );
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
        return ['social','links'];
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_settings',
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
                    'style_2' => __( 'Style 2', 'indsro-core' ),
                    'style_3' => __( 'Style 3', 'indsro-core' ),
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
                'label' => __( 'Social Links', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // list icon
        $repeater->add_control(
            'social_icon',
            [
                'label'       => __( 'Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-check',
                    'library' => 'solid',
                ],
                'label_block' => true,
            ]
        );

        // list_link
        $repeater->add_control(
            'social_link',
            [
                'label'       => __( 'Social Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'social_links',
            [
                'label'       => __( 'Social Links', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
            ]
        );

        $this->add_responsive_control(
            'align_items',
            [
                'label'   => __( 'Alignment', 'indsro-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => __( 'Left', 'indsro-core' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'indsro-core' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'indsro-core' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls() {


        // Style
        $this->start_controls_section(
            'social_style',
            [
                'label' => __( 'Social Style', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // alignment
        $this->add_control(
            'social_alignment',
            [
                'label'     => __( 'Alignment', 'indsro-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'indsro-core' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'indsro-core' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'indsro-core' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // social icon color
        $this->add_control(
            'social_icon_color',
            [
                'label'     => __( 'Icon Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // hover color
        $this->add_control(
            'social_icon_hover_color',
            [
                'label'     => __( 'Icon Hover Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );


        // end
        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

        $style = !empty($settings['design_style']) ? $settings['design_style'] : 'style_1';

        switch ($style) {

            case 'style_4':
                include $dir . '/views/view-4.php';
                break;
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
