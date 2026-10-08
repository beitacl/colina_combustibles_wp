<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;

defined( 'ABSPATH' ) || die();

class Tx_Feature_Lists extends Element_El_Widget {

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
        return 'tx_feature_lists';
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
        return __( 'TX Feature Lists', 'indsro-core' );
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
                    'style_4' => __( 'Style 4', 'indsro-core' ),
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
                'label' => __( 'List Items', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // feature image
        $this->add_control(
            'feature_icon',
            [
                'label'       => __( 'Feature Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-check',
                    'library' => 'solid',
                ],
                'label_block' => true,
                'condition'   => [
                    'design_style' => 'style_3',
                ],
            ]
        );

        // feature image
        $this->add_control(
            'feature_image',
            [
                'label'       => __( 'Feature Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition'   => [
                    'design_style' => 'style_3',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        // design style
        $repeater->add_control(
            'design_style',
            [
                'label'              => __( 'Design Style', 'indsro-core' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'style_1' => __( 'Style 1', 'indsro-core' ),
                    'style_2' => __( 'Style 2', 'indsro-core' ),
                    'style_3' => __( 'Style 3', 'indsro-core' ),
                    'style_4' => __( 'Style 4', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        // enable_icon
        $repeater->add_control(
            'enable_icon',
            [
                'label'        => __( 'Enable Icon', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // feature icon type
        $repeater->add_control(
            'type',
            [
                'label'          => __( 'Feature Icon', 'indsro-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'icon'  => [
                        'title' => __( 'Icon', 'indsro-core' ),
                        'icon'  => 'far fa-smile',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'indsro-core' ),
                        'icon'  => 'fa fa-image',
                    ],
                ],
                'default'        => 'icon',
                'toggle'         => false,
                'style_transfer' => true,
                'condition'      => [
                    'enable_icon' => 'yes',
                ],
            ]
        );

        // list icon
        $repeater->add_control(
            'feature_icon',
            [
                'label'       => __( 'Feature Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-check',
                    'library' => 'solid',
                ],
                'label_block' => true,
                'condition'   => [
                    'type' => 'icon',
                ],
            ]
        );

        // feature image
        $repeater->add_control(
            'feature_image',
            [
                'label'       => __( 'Feature Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition'   => [
                    'type' => 'image',
                ],
            ]
        );

        // info label
        $repeater->add_control(
            'feature_text',
            [
                'label'       => __( 'Feature Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Feature Text', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label'       => __( 'Info Lists', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'feature_text' => __( 'Info Text', 'indsro-core' ),
                    ],
                ],
                'title_field' => '{{{ feature_text }}}',
            ]
        );

        // aling items
        $this->add_responsive_control(
            'align_items',
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
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls() {

        // count style
        $this->start_controls_section(
            '_section_label_style',
            [
                'label' => __( 'Icon Style', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // icon color
        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // icon bg color
        $this->add_control(
            'icon_bg_color',
            [
                'label'     => __( 'Icon Background Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // count end
        $this->end_controls_section();

        // text style
        $this->start_controls_section(
            '_section_text_style',
            [
                'label' => __( 'Text', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // margin bottom
        $this->add_responsive_control(
            'text_margin_bottom',
            [
                'label'      => __( 'Margin Bottom', 'indsro-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => 0,
                        'max'  => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-listItems li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // text color
        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems li'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-listItems li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // bottom border color
        $this->add_control(
            'bottom_border_color',
            [
                'label'     => __( 'Bottom Border Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems li::after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .tx-listItems a::after'  => 'background: {{VALUE}};',
                ],
            ]
        );

        // hover color
        $this->add_control(
            'hover_color',
            [
                'label'     => __( 'Hover Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems li:hover'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-listItems li:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-listItems li::after'  => 'background: {{VALUE}};',
                    '{{WRAPPER}} .tx-listItems a::after'   => 'background: {{VALUE}};',
                ],
            ]
        );

        // hover border color
        $this->add_control(
            'hover_border_color',
            [
                'label'     => __( 'Hover Border Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-listItems li:hover::after'   => 'background: {{VALUE}};',
                    '{{WRAPPER}} .tx-listItems li:hover a::after' => 'background: {{VALUE}};',
                ],
            ]
        );

        // text typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => __( 'Typography', 'indsro-core' ),
                'selector' => '
                {{WRAPPER}} .tx-listItems li,
                {{WRAPPER}} .tx-listItems li a
                ',
            ]
        );

        // text end
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

        $style = !empty( $settings['design_style'] ) ? $settings['design_style'] : 'style_1';

        switch ( $style ) {

        case 'style_10':
            include $dir . '/views/view-10.php';
            break;
        case 'style_9':
            include $dir . '/views/view-9.php';
            break;
        case 'style_8':
            include $dir . '/views/view-8.php';
            break;
        case 'style_7':
            include $dir . '/views/view-7.php';
            break;
        case 'style_6':
            include $dir . '/views/view-6.php';
            break;
        case 'style_5':
            include $dir . '/views/view-5.php';
            break;
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
