<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Get_Quote extends Element_El_Widget {

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
        return 'tx_get_quote';
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
        return __( 'TX Get Quote', 'indsro-core' );
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
        return ['btn', 'contact info', 'info', 'info lists'];
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

        // sub title icon type
        $this->add_control(
            'sub_title_icon_type',
            [
                'label'     => __( 'Icon Type', 'indsro-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'icon'  => __( 'Icon', 'indsro-core' ),
                    'image' => __( 'Image', 'indsro-core' ),
                ],
                'default'   => 'icon',
                'condition' => [
                    'enable_sub_title_icon' => 'yes',
                ],
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
                    'sub_title_icon_type'   => 'icon',
                ],
            ]
        );

        // sub title image
        $this->add_control(
            'sub_title_image',
            [
                'label'       => __( 'Sub Title Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'enable_sub_title_icon' => 'yes',
                    'sub_title_icon_type'   => 'image',
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

        // contact info box
        $this->start_controls_section(
            '_section_contact_info_box',
            [
                'label'     => __( 'Contact Info Box', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_4'],
                ],
            ]
        );

        // enable contact info
        $this->add_control(
            'enable_contact_info',
            [
                'label'        => __( 'Enable Contact Info', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // contact info icon
        $this->add_control(
            'contact_info_icon',
            [
                'label'     => __( 'Contact Info Icon', 'indsro-core' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-phone',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_contact_info' => 'yes',
                ],
            ]
        );

        // contact info label
        $this->add_control(
            'contact_info_label',
            [
                'label'       => __( 'Contact Info Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Contact Info Label', 'indsro-core' ),
                'placeholder' => __( 'Enter your contact info label', 'indsro-core' ),
                'condition'   => [
                    'enable_contact_info' => 'yes',
                ],
            ]
        );

        // contact info text
        $this->add_control(
            'contact_info_text',
            [
                'label'       => __( 'Contact Info Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Contact Info Text', 'indsro-core' ),
                'placeholder' => __( 'Enter your contact info text', 'indsro-core' ),
                'condition'   => [
                    'enable_contact_info' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'link_type',
            [
                'label'          => __( 'Choose Link Type', 'indsro-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'url'   => [
                        'title' => __( 'URL', 'indsro-core' ),
                        'icon'  => 'far fa-globe',
                    ],
                    'email' => [
                        'title' => __( 'Email', 'indsro-core' ),
                        'icon'  => 'fa fa-envelope',
                    ],
                    'phone' => [
                        'title' => __( 'Phone', 'indsro-core' ),
                        'icon'  => 'fa fa-phone',
                    ],
                ],
                'toggle'         => false,
                'style_transfer' => true,
                'default'        => 'email',
                'condition'      => [
                    'enable_contact_info' => 'yes',
                ],
            ]
        );

        // end
        $this->end_controls_section();

        // images
        $this->start_controls_section(
            '_section_images',
            [
                'label' => __( 'Images', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition'   => [
                    'design_style' => ['style_3', 'style_4', 'style_5'],
                ],
            ]
        );

        // IMAGE_1
        $this->add_control(
            'image_1',
            [
                'label'       => __( 'Image 1', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // IMAGE_2
        $this->add_control(
            'image_2',
            [
                'label'       => __( 'Image 2', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // IMAGE_3
        $this->add_control(
            'image_3',
            [
                'label'       => __( 'Image 3', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'design_style' => ['style_3'],
                ],
            ]
        );

        // END
        $this->end_controls_section();

        // tab section
        $this->start_controls_section(
            '_section_tab',
            [
                'label' => __( 'Quote Tab', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_3', 'style_4' , 'style_5', 'style_6'],
                ],
            ]
        );

        // enable tab
        $this->add_control(
            'enable_tab',
            [
                'label'        => __( 'Enable Tab', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // repeater
        $repeater = new Repeater();

        // design style
        $repeater->add_control(
            'design_style',
            [
                'label'     => __( 'Design Style', 'indsro-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'style_1' => __( 'Style 1', 'indsro-core' ),
                    'style_2' => __( 'Style 2', 'indsro-core' ),
                    'style_3' => __( 'Style 3', 'indsro-core' ),
                    'style_4' => __( 'Style 4', 'indsro-core' ),
                ],
                'default'   => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        // is_active
        $repeater->add_control(
            'is_active',
            [
                'label'        => __( 'Is Active', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // tab content image
        $repeater->add_control(
            'tab_title_image',
            [
                'label'       => __( 'Tab Title Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        // tab title
        $repeater->add_control(
            'tab_title',
            [
                'label'       => __( 'Tab Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your tab title', 'indsro-core' ),
                'default'     => __( 'Tab Title', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // tab title icon
        $repeater->add_control(
            'tab_title_icon',
            [
                'label'     => __( 'Contact Info Icon', 'indsro-core' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-phone',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'design_style' => ['style_4'],
                ],
            ]
        );

        // tab content image
        $repeater->add_control(
            'tab_content_image',
            [
                'label'       => __( 'Tab Content Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        // tab form shortcode
        $repeater->add_control(
            'tab_form_shortcode',
            [
                'label'       => __( 'Tab Form Shortcode', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your tab form shortcode', 'indsro-core' ),
                'default'     => '[contact-form-7 id="123" title="Contact form 1"]',
                'label_block' => true,
            ]
        );

        // tab list
        $this->add_control(
            'tab_lists',
            [
                'label'   => __( 'Tab List', 'indsro-core' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'condition' => [
                    'enable_tab' => 'yes',
                ],
            ]
        );

        // end
        $this->end_controls_section();

        // CONTACT NUMBER
        $this->start_controls_section(
            '_section_contact_info',
            [
                'label' => __( 'Quote Form', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_2'],
                ],
            ]
        );

        // quote heading
        $this->add_control(
            'quote_heading',
            [
                'label'       => __( 'Quote Heading', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Get A Quote', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'quote_form_shortcode',
            [
                'label'     => __( 'Qutoe Form Shortcode', 'indsro-core' ),
                'type'      => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section();

         // FEATURE BOXS
         $this->start_controls_section(
            '_section_feature_boxs',
            [
                'label'     => __( 'Feature Boxs', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'style_5'],
                ],
            ]
        );

        // ENABLE FEATURE BOXS
        $this->add_control(
            'enable_feature_boxs',
            [
                'label'        => __( 'Enable Feature Boxs', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // repeater
        $repeater = new Repeater();

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

        $repeater->add_control(
            'type',
            [
                'label'          => __( 'List Icon', 'indsro-core' ),
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
            'list_icon',
            [
                'label'       => __( 'Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-check',
                    'library' => 'solid',
                ],
                'label_block' => true,
                'condition'   => [
                    'type'        => 'icon',
                    'enable_icon' => 'yes',
                ],
            ]
        );

        // list image
        $repeater->add_control(
            'list_image',
            [
                'label'       => __( 'Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition'   => [
                    'type'        => 'image',
                    'enable_icon' => 'yes',
                ],
            ]
        );

        // list title
        $repeater->add_control(
            'list_title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'List Title', 'indsro-core' ),
                'placeholder' => __( 'List Title', 'indsro-core' ),
            ]
        );

        // list description
        $repeater->add_control(
            'list_description',
            [
                'label'       => __( 'Description', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => __( 'List Description', 'indsro-core' ),
                'placeholder' => __( 'List Description', 'indsro-core' ),
            ]
        );

        // feature boxs
        $this->add_control(
            'feature_boxs',
            [
                'label'       => __( 'Feature Boxs', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ list_title }}}',
                'condition'   => [
                    'enable_feature_boxs' => 'yes',
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
