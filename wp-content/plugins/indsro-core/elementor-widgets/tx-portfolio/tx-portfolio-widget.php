<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Portfolio extends Element_El_Widget {

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
        return 'tx_portfolio';
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
        return __( 'TX Portfolio', 'indsro-core' );
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
        return ['portfolio', 'tab'];
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_design_settings',
            [
                'label' => __( 'DESIGN STYLE', 'indsro-core' ),
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
            '_section_title',
            [
                'label' => __( 'Title & Description', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // enable sub title icon
        $this->add_control(
            'enable_sub_title_icon',
            [
                'label'        => __( 'Enable Sub Title Icon', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // sub title icon
        $this->add_control(
            'sub_title_icon',
            [
                'label'       => __( 'Sub Title Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'placeholder' => __( 'Enter your sub title icon', 'indsro-core' ),
                'default'     => [
                    'value'   => 'fas fa-house-user',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'enable_sub_title_icon' => 'yes',
                ],
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_project_tab',
            [
                'label' => __( 'Portfolio Filter', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // see all icon
        $this->add_control(
            'see_all_icon',
            [
                'label'       => __( 'See All Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'placeholder' => __( 'Enter your icon', 'indsro-core' ),
                'default'     => [
                    'value'   => 'fas fa-house-user',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // see all
        $this->add_control(
            'see_all',
            [
                'label'              => __( 'See All Text', 'indsro-core' ),
                'type'               => Controls_Manager::TEXT,
                'default'            => __( 'See All', 'indsro-core' ),
                'label_block'        => true,
                'placeholder'        => __( 'See All', 'indsro-core' ),
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        // repeater
        $repeater = new Repeater();

        // tab_title icon
        $repeater->add_control(
            'tab_title_icon',
            [
                'label' => esc_html__( 'Tab Title Icon', 'Text-domain' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
            ]
        );

        // tab_title
        $repeater->add_control(
            'tab_title',
            [
                'label'       => __( 'Tab Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Tab Title', 'indsro-core' ),
                'placeholder' => __( 'Type your title here', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // filter_id
        $repeater->add_control(
            'filter_id',
            [
                'label'       => __( 'Filter ID', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'filter-id', 'indsro-core' ),
                'placeholder' => __( 'Type your filter id here', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // lists items
        $this->add_control(
            'portfolio_filters',
            [
                'label'  => __( 'Portfolio Filters', 'indsro-core' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_project_items',
            [
                'label' => __( 'Portfolio Items', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // repeater
        $repeater = new Repeater();

        // filter_id
        $repeater->add_control(
            'filter_id',
            [
                'label'       => __( 'Filter ID', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Add ID: 1, 2, 3', 'indsro-plugin' ),
            ]
        );

        // IMAGE SIZE
        $repeater->add_control(
            'image_sizes',
            [
                'label'   => __( 'Image Size', 'indsro-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'grid-size-50' => __( 'Large', 'indsro-core' ),
                    'grid-size-25' => __( 'Small', 'indsro-core' ),
                ],
                'default' => 'grid-size-50',
            ]
        );

        // image
        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Image', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // button text
        $repeater->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'View Project', 'indsro-core' ),
                'placeholder' => __( 'Type your button text here', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // button icon
        $repeater->add_control(
            'button_icon',
            [
                'label'   => __( 'Button Icon', 'indsro-core' ),
                'type'    => Controls_Manager::ICONS,
            ]
        );

        // project link
        $repeater->add_control(
            'project_link',
            [
                'label'       => __( 'Project Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        // lists items
        $this->add_control(
            'portfolio_items',
            [
                'label'  => __( 'Portfolio Items', 'indsro-core' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        // end
        $this->end_controls_section();

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
        case 'style_2':
            include $dir . '/views/view-2.php';
            break;
        default:
            include $dir . '/views/view-1.php';
        }
    }
}
