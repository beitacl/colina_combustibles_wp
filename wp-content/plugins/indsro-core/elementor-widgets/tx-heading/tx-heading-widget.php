<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class Tx_Heading extends Element_El_Widget {

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
        return 'tx_heading';
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
        return __( 'TX Heading', 'indsro-core' );
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
        return ['section', 'heading', 'title'];
    }

    public function elh_element_animations() {
        return [
            'none'              => __( 'None', 'telnet-core' ),
            'fadeIn'            => __( 'Fade In', 'telnet-core' ),
            'fadeInUp'          => __( 'Fade In Up', 'telnet-core' ),
            'fadeInDown'        => __( 'Fade In Down', 'telnet-core' ),
            'fadeInLeft'        => __( 'Fade In Left', 'telnet-core' ),
            'fadeInRight'       => __( 'Fade In Right', 'telnet-core' ),
            'fadeInUpBig'       => __( 'Fade In Up Big', 'telnet-core' ),
            'fadeInDownBig'     => __( 'Fade In Down Big', 'telnet-core' ),
            'fadeInLeftBig'     => __( 'Fade In Left Big', 'telnet-core' ),
            'fadeInRightBig'    => __( 'Fade In Right Big', 'telnet-core' ),
            'bounceIn'          => __( 'Bounce In', 'telnet-core' ),
            'bounceInUp'        => __( 'Bounce In Up', 'telnet-core' ),
            'bounceInDown'      => __( 'Bounce In Down', 'telnet-core' ),
            'bounceInLeft'      => __( 'Bounce In Left', 'telnet-core' ),
            'bounceInRight'     => __( 'Bounce In Right', 'telnet-core' ),
            'rotateIn'          => __( 'Rotate In', 'telnet-core' ),
            'rotateInUpLeft'    => __( 'Rotate In Up Left', 'telnet-core' ),
            'rotateInDownLeft'  => __( 'Rotate In Down Left', 'telnet-core' ),
            'rotateInUpRight'   => __( 'Rotate In Up Right', 'telnet-core' ),
            'rotateInDownRight' => __( 'Rotate In Down Right', 'telnet-core' ),
            'lightSpeedIn'      => __( 'Light Speed In', 'telnet-core' ),
            'rollIn'            => __( 'Roll In', 'telnet-core' ),
            'zoomIn'            => __( 'Zoom In', 'telnet-core' ),
            'zoomInUp'          => __( 'Zoom In Up', 'telnet-core' ),
            'zoomInDown'        => __( 'Zoom In Down', 'telnet-core' ),
            'zoomInLeft'        => __( 'Zoom In Left', 'telnet-core' ),
            'zoomInRight'       => __( 'Zoom In Right', 'telnet-core' ),
            'slideInUp'         => __( 'Slide In Up', 'telnet-core' ),
            'slideInDown'       => __( 'Slide In Down', 'telnet-core' ),
            'slideInLeft'       => __( 'Slide In Left', 'telnet-core' ),
            'slideInRight'      => __( 'Slide In Right', 'telnet-core' ),
        ];
    }

    public function elh_custom_animations() {
        return [
            'none'                 => __( 'None', 'telnet-core' ),
            'split-in-right'       => __( 'Split In Right', 'telnet-core' ),
            'split-in-right-2'     => __( 'Split In Right 2', 'telnet-core' ),
            'split-in-left'        => __( 'Split In Left', 'telnet-core' ),
            'split-in-up'          => __( 'Split In Up', 'telnet-core' ),
            'split-in-down'        => __( 'Split In Down', 'telnet-core' ),
            'split-in-rotate'      => __( 'Split In Rotate', 'telnet-core' ),
            'split-in-scale'       => __( 'Split In Scale', 'telnet-core' ),
            'split-in-fade'        => __( 'Split In Fade', 'telnet-core' ),
            'fti-split-in-right-4' => __( 'Split In Right 4', 'telnet-core' ),
        ];
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
                    'style_5' => __( 'Style 5', 'indsro-core' ),
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

        // sub title
        $this->add_control(
            'sub_title',
            [
                'label'       => __( 'Sub Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Sub Title',
                'placeholder' => __( 'Sub Title Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_sub_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => __( 'Title HTML Tag', 'indsro-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'h1' => [
                        'title' => __( 'H1', 'indsro-core' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => __( 'H2', 'indsro-core' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => __( 'H3', 'indsro-core' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => __( 'H4', 'indsro-core' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => __( 'H5', 'indsro-core' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => __( 'H6', 'indsro-core' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default'   => 'h2',
                'toggle'    => false,
                'condition' => [
                    'enable_title' => 'yes',
                ],
            ]
        );

        // description
        $this->add_control(
            'description',
            [
                'label'       => __( 'Description', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'The opportunity to work abroad is a popular prospect, one',
                'placeholder' => __( 'Description Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_description' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_align',
            [
                'label'     => __( 'Alignment', 'indsro-core' ),
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
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
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

        // ENABLE SUB TITLE SHAPE 1
        $this->add_control(
            'enable_sub_title_shape_1',
            [
                'label'        => __( 'Enable Sub Title Shape 1', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => 'style_5',
                ],
            ]
        );

        // ENABLE SUB TITLE SHAPE 2
        $this->add_control(
            'enable_sub_title_shape_2',
            [
                'label'        => __( 'Enable Sub Title Shape 2', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition'    => [
                    'design_style' => 'style_5',
                ],
            ]
        );

        // ENABLE SUB TITLE
        $this->add_control(
            'enable_sub_title',
            [
                'label'        => __( 'Enable Sub Title', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // enable sub title shape
        $this->add_control(
            'enable_sub_title_shape',
            [
                'label'        => __( 'Enable Sub Title Shape', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // ENABLE TITLE
        $this->add_control(
            'enable_title',
            [
                'label'        => __( 'Enable Title', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // ENABLE DESCRIPTION
        $this->add_control(
            'enable_description',
            [
                'label'        => __( 'Enable Description', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'section_anim',
            [
                'label'     => esc_html__( 'Animation Setting', 'indsro-core' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // enable sub title animation
        $this->add_control(
            'enable_sub_title_anim',
            [
                'label'        => __( 'Enable Sub Title Animation', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'enable_sub_title' => 'yes',
                ],
            ]
        );

        // sub title animation name
        $this->add_control(
            'sub_title_animation',
            [
                'label'     => __( 'Sub Title Animation', 'indsro-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->elh_element_animations(),
                'condition' => [
                    'enable_sub_title_anim' => 'yes',
                    'enable_sub_title'      => 'yes',
                ],
            ]
        );

        // sub title anim delay
        $this->add_control(
            'sub_title_anim_delay',
            [
                'label'     => __( 'Sub Title Animation Delay', 'indsro-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 0,
                'condition' => [
                    'enable_sub_title_anim' => 'yes',
                    'enable_sub_title'      => 'yes',
                ],
            ]
        );

        // sub title anim duration
        $this->add_control(
            'sub_title_anim_duration',
            [
                'label'     => __( 'Sub Title Animation Duration', 'indsro-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1,
                'condition' => [
                    'enable_sub_title_anim' => 'yes',
                    'enable_sub_title'      => 'yes',
                ],
            ]
        );

        // enable title animation
        $this->add_control(
            'enable_title_anim',
            [
                'label'        => __( 'Enable Title Animation', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'enable_title' => 'yes',
                ],
            ]
        );

        // title animation name
        $this->add_control(
            'title_animation',
            [
                'label'     => __( 'Title Animation', 'indsro-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->elh_custom_animations(),
                'condition' => [
                    'enable_title_anim' => 'yes',
                    'enable_title'      => 'yes',
                ],
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

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $style = !empty( $settings['design_style'] ) ? $settings['design_style'] : 'style_1';

        switch ( $style ) {
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
