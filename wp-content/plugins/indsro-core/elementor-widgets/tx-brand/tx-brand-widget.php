<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Brand extends Element_El_Widget {

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
        return 'tx_brand';
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
        return __( 'TX Brand', 'indsro-core' );
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
        return ['brand', 'image', 'icon', 'indsro'];
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
            '_section_choose_style',
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
            '_section_title',
            [
                'label' => __( 'Brands Image', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
			'brands_image',
			[
				'label' => esc_html__( 'Add Images', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

        $this->end_controls_section();


        // brand section repeat
        $this->start_controls_section(
            '_section_brand',
            [
                'label' => __( 'Brand', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        // repeatable
        $repeater = new \Elementor\Repeater();

        // brand image 1
        $repeater->add_control(
            'brand_image_1',
            [
                'label' => esc_html__( 'Add Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'show_label' => false,
                'default' => [],
            ]
        );

        // brand image 2
        $repeater->add_control(
            'brand_image_2',
            [
                'label' => esc_html__( 'Add Image 2', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'show_label' => false,
                'default' => [],
            ]
        );

        // brand images
        $this->add_control(
            'brand_images',
            [
                'label' => esc_html__( 'Add Brands', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
            ]
        );

        // end
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

        $style = !empty($settings['design_style']) ? $settings['design_style'] : 'style_1';

        switch ($style) {

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
