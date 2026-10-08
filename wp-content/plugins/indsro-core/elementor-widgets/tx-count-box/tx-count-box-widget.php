<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Count_Box extends Element_El_Widget {

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
        return 'tx_count_box';
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
        return __( 'TX Count Box', 'indsro-core' );
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
        return ['count', 'indsro', 'indsro counter'];
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

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_design_settings',
            [
                'label' => __( 'CHOOSE DESIGN', 'indsro-core' ),
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

        // COUNT BOX
        $this->start_controls_section(
            '_section_count_box',
            [
                'label' => __( 'Count Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // count title
        $this->add_control(
            'count_title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Happy Clients', 'indsro-core' ),
            ]
        );

        // count number
        $this->add_control(
            'count_number',
            [
                'label'       => __( 'Number', 'indsro-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 100,
            ]
        );

        // count prefix
        $this->add_control(
            'count_prefix',
            [
                'label'       => __( 'Prefix', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '+',
            ]
        );

        // count prefix 2
        $this->add_control(
            'count_prefix_2',
            [
                'label'       => __( 'Prefix 2', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '+',
                'condition'   => [
                    'design_style' => ['style_1', 'style_2'],
                ],
            ]
        );

        // enable bottom shape
        $this->add_control(
            'enable_bottom_shape',
            [
                'label'        => __( 'Enable Bottom Shape', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => ['style_4'],
                ],
            ]
        );

        $this->add_control(
            'enable_rating',
            [
                'label'        => __( 'Enable Rating', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => ['style_5'],
                ],
            ]
        );

        // rating star
        $this->add_control(
            'rating_star',
            [
                'label'     => __( 'Rating Star', 'indsro-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1' => __( '1 Star', 'indsro-core' ),
                    '2' => __( '2 Star', 'indsro-core' ),
                    '3' => __( '3 Star', 'indsro-core' ),
                    '4' => __( '4 Star', 'indsro-core' ),
                    '5' => __( '5 Star', 'indsro-core' ),
                ],
                'default'   => '5',
                'condition' => [
                    'design_style' => ['style_5'],
                ],
            ]
        );

        // count image
        $this->add_control(
            'count_image',
            [
                'label'              => __( 'Image', 'indsro-core' ),
                'type'               => Controls_Manager::MEDIA,
                'label_block'        => true,
                'frontend_available' => true,
                'style_transfer'     => true,
                'condition' => [
                    'design_style' => ['style_5'],
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // END
        $this->end_controls_section();

        // count box
        $this->start_controls_section(
            '_section_count_box_style',
            [
                'label' => __( 'Count Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_3',
                ],
            ]
        );

        // repeat
        $repeater = new Repeater();

        // count icon
        $repeater->add_control(
            'count_icon',
            [
                'label'              => __( 'Icon', 'indsro-core' ),
                'type'               => Controls_Manager::ICONS,
                'label_block'        => true,
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        // count number
        $repeater->add_control(
            'count_number',
            [
                'label'       => __( 'Number', 'indsro-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 100,
            ]
        );

        // count prefix
        $repeater->add_control(
            'count_prefix',
            [
                'label'       => __( 'Prefix', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '+',
            ]
        );

        // count title
        $repeater->add_control(
            'count_title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Happy Clients', 'indsro-core' ),
            ]
        );

        // count title icon
        $repeater->add_control(
            'count_title_icon',
            [
                'label'              => __( 'Icon', 'indsro-core' ),
                'type'               => Controls_Manager::ICONS,
                'label_block'        => true,
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        // count boxs
        $this->add_control(
            'count_boxs',
            [
                'label'  => __( 'Count Boxs', 'indsro-core' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        // END
        $this->end_controls_section();

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label'     => __( 'Settings', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_2',
                ],
            ]
        );

        // enable animation
        $this->add_control(
            'enable_animation',
            [
                'label'        => __( 'Enable Animation', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // wow animation
        $this->add_control(
            'wow_animation',
            [
                'label'     => __( 'Wow Animation', 'indsro-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->elh_element_animations(),
                'default'   => 'fadeIn',
                'condition' => [
                    'enable_animation' => 'yes',
                ],
            ]
        );

        // wow duration
        $this->add_control(
            'wow_duration',
            [
                'label'     => __( 'Wow Duration', 'indsro-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => '1000ms',
                'condition' => [
                    'enable_animation' => 'yes',
                ],
            ]
        );

        // wow delay
        $this->add_control(
            'wow_delay',
            [
                'label'     => __( 'Wow Delay', 'indsro-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => '200ms',
                'condition' => [
                    'enable_animation' => 'yes',
                ],
            ]
        );

        // END
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
