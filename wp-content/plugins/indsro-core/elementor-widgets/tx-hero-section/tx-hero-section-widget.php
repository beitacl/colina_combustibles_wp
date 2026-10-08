<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Hero_Section extends Element_El_Widget {

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
        return 'tx_hero_section';
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
        return __( 'TX Hero Section', 'indsro-core' );
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
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        // IMAGE SECTION
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __( 'Image', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // IMAGE 1
        $this->add_control(
            'image_1',
            [
                'label'       => __( 'Image 1', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // IMAGE 2
        $this->add_control(
            'image_2',
            [
                'label'       => __( 'Image 2', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // IMAGE 3
        $this->add_control(
            'image_3',
            [
                'label'       => __( 'Image 3', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // IMAGE 4
        $this->add_control(
            'image_4',
            [
                'label'       => __( 'Image 4', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // END
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
                'type'        => Controls_Manager::TEXT,
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
                'default'     => 'Description Text',
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

        // BUTTON
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );

        // BUTTON TEXT
        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Button Text', 'indsro-core' ),
                'placeholder' => __( 'Button Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // BUTTON LINK
        $this->add_control(
            'button_link',
            [
                'label'       => __( 'Button Link', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // ENABLE BUTTON ICON
        $this->add_control(
            'enable_button_icon',
            [
                'label'        => __( 'Enable Button Icon', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // BUTTON ICON
        $this->add_control(
            'button_icon',
            [
                'label'       => __( 'Button Icon', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'enable_button_icon' => 'yes',
                ],
            ]
        );

        // END
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

        // ENABLE TITLE
        $this->add_control(
            'enable_title_2',
            [
                'label'        => __( 'Enable Title 2', 'indsro-core' ),
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

        // ENABLE BUTTON
        $this->add_control(
            'enable_button',
            [
                'label'        => __( 'Enable Button', 'indsro-core' ),
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
