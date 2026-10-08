<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Career_Box extends Element_El_Widget {

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
        return 'tx_career_box';
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
        return __( 'Tx Career Box', 'indsro-core' );
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
        return ['career', 'job'];
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
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        // SERVICES
        $this->start_controls_section(
            '_section_info_box',
            [
                'label' => __( 'Info Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // position name
        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Title', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // location icon
        $this->add_control(
            'location_icon',
            [
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block'      => true,
                'default'          => [
                    'value'   => 'fal fa-long-arrow-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // location name
        $this->add_control(
            'location',
            [
                'label'       => __( 'Location', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Location', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // job type icon
        $this->add_control(
            'job_type_icon',
            [
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block'      => true,
                'default'          => [
                    'value'   => 'fal fa-long-arrow-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // job type name
        $this->add_control(
            'job_type_name',
            [
                'label'       => __( 'Job Type', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Job Type', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // exprerience label
        $this->add_control(
            'experience_label',
            [
                'label'       => __( 'Experience Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Experience', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // experience text
        $this->add_control(
            'experience_text',
            [
                'label'       => __( 'Experience Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( '2 Years', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // deade line label
        $this->add_control(
            'deadline_label',
            [
                'label'       => __( 'Deadline Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Deadline', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // deadline text
        $this->add_control(
            'deadline_text',
            [
                'label'       => __( 'Deadline Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( '2 Days', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // button text
        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Apply Now', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // button_link
        $this->add_control(
            'button_link',
            [
                'label'       => __( 'Button Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url' => '#',
                ],
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls() {
        // title style
        $this->start_controls_section(
            '_section_style_title',
            [
                'label' => __( 'Info Box Style', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // background control field and exclude video
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background',
                'label'    => __( 'Background', 'indsro-core' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => [
                    'image',
                    'video',
                ],
                'selector' => '{{WRAPPER}} .tx-serviceBox',
            ]
        );

        // title color
        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-block_three-heading a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Typography', 'indsro-core' ),
                'selector' => '{{WRAPPER}} .service-block_three-heading a',
            ]
        );

        // description color
        $this->add_control(
            'description_color',
            [
                'label'     => __( 'Description Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-block_three-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_3'],
                ],
            ]
        );

        // description typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'description_typography',
                'label'     => __( 'Typography', 'indsro-core' ),
                'selector'  => '{{WRAPPER}} .service-block_three-text',
                'condition' => [
                    'design_style' => ['style_1', 'style_3'],
                ],
            ]
        );

        // button color
        $this->add_control(
            'button_color',
            [
                'label'     => __( 'Button Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-block_three-more' => 'color: {{VALUE}};',
                ],
            ]
        );

        // button typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __( 'Typography', 'indsro-core' ),
                'selector' => '{{WRAPPER}} .service-block_three-more',
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
        case 'style_2':
            include $dir . '/views/view-2.php';
            break;
        default:
            include $dir . '/views/view-1.php';
        }
    }

}