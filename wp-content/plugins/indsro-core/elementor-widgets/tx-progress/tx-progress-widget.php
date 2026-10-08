<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class Tx_Progress extends Element_El_Widget {

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
        return 'tx_progress';
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
        return __( 'TX Progress', 'indsro-core' );
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
        return ['indsro', 'skill', 'speed', 'progress', 'bar'];
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
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        // BUTTON & TEXT
        $this->start_controls_section(
            '_section_progress',
            [
                'label' => __( 'Progress', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // progress value
        $this->add_control(
            'progress_value',
            [
                'label'       => __( 'Progress Value', 'indsro-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['%'],
                'range'       => [
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default'     => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'label_block' => true,
                'selectors'   => [
                    '{{WRAPPER}} .s-progress' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // title
        $this->add_control(
            'progress_title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Title', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // progress boxs
        $this->start_controls_section(
            '_section_progress_box',
            [
                'label' => __( 'Progress Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_10',
                ],
            ]
        );

        // repeater
        $repeater = new \Elementor\Repeater();

        // progress_value
        $repeater->add_control(
            'progress_value',
            [
                'label'       => __( 'Progress Value', 'indsro-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['%'],
                'range'       => [
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default'     => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'label_block' => true,
                'selectors'   => [
                    '{{WRAPPER}} .s-progress' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // progress_title
        $repeater->add_control(
            'progress_title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Title', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // progress_description
        $repeater->add_control(
            'progress_description',
            [
                'label'       => __( 'Description', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Description', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // add repeater
        $this->add_control(
            'progress_boxes',
            [
                'label'  => __( 'Progress Boxes', 'indsro-core' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        // end
        $this->end_controls_section();

    }

    protected function register_style_controls() {

        //  PROGRESS BAR STYLE
        $this->start_controls_section(
            '_section_progress_bar_style',
            [
                'label' => __( 'Progress Bar', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // progress bg color
        $this->add_control(
            'progress_bg_color',
            [
                'label'     => __( 'Progress Background Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ee4619',
            ]
        );

        // bgcolor
        $this->add_control(
            'progress_color',
            [
                'label'     => __( 'Progress Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        // END SECTION
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