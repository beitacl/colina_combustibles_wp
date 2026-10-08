<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Image_Box extends Element_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Indsro Core widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tx_image_box';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'TX Image Box', 'indsro-core' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.themexriver.com/widgets/icon-box/';
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'elh-widget-icon eicon-preview-medium';
    }

    public function get_keywords() {
        return ['service', 'gird', 'icon'];
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

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __( 'Design Style', 'indsro-core' ),
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
                    'style_6' => __( 'Style 6', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        // IMAEG BOX
        $this->start_controls_section(
            '_section_image_box',
            [
                'label' => __( 'Image Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // image
        $this->add_control(
            'image_1',
            [
                'label'              => __( 'Image 1', 'indsro-core' ),
                'type'               => Controls_Manager::MEDIA,
                'default'            => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        // image
        $this->add_control(
            'image_2',
            [
                'label'              => __( 'Image 2', 'indsro-core' ),
                'type'               => Controls_Manager::MEDIA,
                'default'            => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'frontend_available' => true,
                'style_transfer'     => true,
                'condition'          => [
                    'design_style' => ['style_1', 'style_3', 'style_5', 'style_6'],
                ],
            ]
        );

        // image 3
        $this->add_control(
            'image_3',
            [
                'label'              => __( 'Image 3', 'indsro-core' ),
                'type'               => Controls_Manager::MEDIA,
                'default'            => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'frontend_available' => true,
                'style_transfer'     => true,
                'condition'          => [
                    'design_style' => ['style_3', 'style_5'],
                ],
            ]
        );

        $this->end_controls_section();

        // info text
        $this->start_controls_section(
            '_section_info_text',
            [
                'label' => __( 'Info Text', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_5'],
                ],
            ]
        );

        // info heading
        $this->add_control(
            'info_heading',
            [
                'label'       => __( 'Heading', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '3.2K Projects Success!', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // info text
        $this->add_control(
            'info_text',
            [
                'label'       => __( 'Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Collaborate learn about your project.', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // end
        $this->end_controls_section();

        // SECTION SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
                    'design_style'     => [
                        'style_2',
                    ],
                ],
            ]
        );

        // END
        $this->end_controls_section();

    }

    protected function register_style_controls() {
        // image style
        $this->start_controls_section(
            '_section_image_style',
            [
                'label' => __( 'Image', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // image border radius
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'indsro-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .item-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // end
        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * Used to generate the final HTML displayed on the frontend.
     *
     * Note that if skin is selected, it will be rendered by the skin itself,
     * not the widget.
     *
     * @since 1.0.0
     * @access public
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

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