<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Info_Text extends Element_El_Widget {

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
        return 'tx_info_text';
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
        return __( 'TX Info Text', 'indsro-core' );
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
        return ['section', 'text', 'title'];
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_style_settings',
            [
                'label' => __( 'CHOOSE STYLE', 'indsro-core' ),
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
            '_section_title',
            [
                'label' => __( 'Title & Description', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // info text
        $this->add_control(
            'info_text',
            [
                'label'       => __( 'Info Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your info text', 'indsro-core' ),
                'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // info image 1
        $this->add_control(
            'info_image_1',
            [
                'label'   => __( 'Info Image 1', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => 'style_1',
                ],
            ]
        );

        // link_label
        $this->add_control(
            'link_label',
            [
                'label'       => __( 'Link Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Read More', 'indsro-core' ),
                'default'     => __( 'Read More', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // link_url
        $this->add_control(
            'link_url',
            [
                'label'       => __( 'Link URL', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'default'     => [
                    'url' => '#',
                ],
                'label_block' => true,
            ]
        );

        // info text alignment
        $this->add_control(
            'info_text_alignment',
            [
                'label'     => __( 'Info Text Alignment', 'indsro-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'indsro-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'indsro-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'indsro-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls() {

        // Style
        $this->start_controls_section(
            '_section_info_style',
            [
                'label' => __( 'Info Style', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

         // text align
         $this->add_responsive_control(
            'text_align',
            [
                'label'     => __( 'Text Align', 'indsro-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'indsro-core' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'indsro-core' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'indsro-core' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tx-infoText' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // text color
        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Text Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-infoText' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-infoText p' => 'color: {{VALUE}};',

                ],
            ]
        );

        // typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'label'    => __( 'Typography', 'indsro-core' ),
                'selector' => '
                {{WRAPPER}} .tx-infoText,
                {{WRAPPER}} .tx-infoText p
                ',
            ]
        );

        // link color
        $this->add_control(
            'link_color',
            [
                'label'     => __( 'Link Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-infoText a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // link hover color
        $this->add_control(
            'link_hover_color',
            [
                'label'     => __( 'Link Hover Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-infoText a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'link_typography',
                'label'    => __( 'Link Typography', 'indsro-core' ),
                'selector' => '{{WRAPPER}} .tx-infoText a',
            ]
        );

        // end
        $this->end_controls_section();


    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

        $style = !empty( $settings['design_style'] ) ? $settings['design_style'] : 'style_1';

        switch ( $style ) {
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
