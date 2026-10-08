<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Cta extends Element_El_Widget {

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
        return 'tx_cta';
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
        return __( 'TX Cta', 'indsro-core' );
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
        return ['btn', 'cta', 'indsro', 'indsro cta'];
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
            '_section_choose_design',
            [
                'label' => __( 'Choose Design', 'indsro-core' ),
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
                    'style_7' => __( 'Style 7', 'indsro-core' ),
                    'style_8' => __( 'Style 8', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        // images
        $this->start_controls_section(
            '_section_images',
            [
                'label' => __( 'Images', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
                'condition'   => [
                    'design_style' => ['style_1', 'style_5', 'style_7', 'style_8'],
                ],
            ]
        );

        // END
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label'     => __( 'Title & Description', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_5', 'style_7', 'style_8'],
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
                    'design_style'     => ['style_1', 'style_2', 'style_3', 'style_7', 'style_8'],
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
                    'design_style'       => ['style_1', 'style_2', 'style_3', 'style_7', 'style_8'],
                ],
            ]
        );

        $this->end_controls_section();

        // BUTTON
        $this->start_controls_section(
            '_section_button',
            [
                'label'     => __( 'Button', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_5', 'style_8'],
                ],
            ]
        );

        // enable button
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

        // INFO BOX
        $this->start_controls_section(
            '_section_info_box',
            [
                'label'     => __( 'Info Box', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        // ENABLE INFO BOX
        $this->add_control(
            'enable_info_box',
            [
                'label'        => __( 'Enable Info Box', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // INFO BOX IMAGE
        $this->add_control(
            'info_box_image',
            [
                'label'       => __( 'Info Box Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'enable_info_box' => 'yes',
                ],
            ]
        );

        // INFO TEXT
        $this->add_control(
            'info_text',
            [
                'label'       => __( 'Info Text', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'The opportunity to work abroad is a popular prospect, one',
                'placeholder' => __( 'Info Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_info_box' => 'yes',
                ],
            ]
        );

        // END
        $this->end_controls_section();

        // CONTACT FORM
        $this->start_controls_section(
            '_section_contact_form',
            [
                'label'     => __( 'Contact Form', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_6'],
                ],
            ]
        );

        // contact_sub_title
        $this->add_control(
            'contact_sub_title',
            [
                'label'       => __( 'Contact Sub Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'rows'        => 4,
                'default'     => 'Contact Sub Title',
                'placeholder' => __( 'Contact Sub Title Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => ['style_3'],
                ],
            ]
        );

        // contact_title
        $this->add_control(
            'contact_title',
            [
                'label'       => __( 'Contact Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Contact Title',
                'placeholder' => __( 'Contact Title Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => ['style_3'],
                ],
            ]
        );

        // short_info
        $this->add_control(
            'short_info',
            [
                'label'       => __( 'Short Info', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => 'The opportunity to work abroad is a popular prospect, one',
                'placeholder' => __( 'Short Info Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => ['style_3'],
                ],
            ]
        );

        // ENABLE CONTACT FORM
        $this->add_control(
            'enable_contact_form',
            [
                'label'        => __( 'Enable Contact Form', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // CONTACT FORM SHORTCODE
        $this->add_control(
            'contact_form_shortcode',
            [
                'label'       => __( 'Contact Form Shortcode', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '[contact-form-7 id="5" title="Contact form 1"]',
                'placeholder' => __( 'Contact Form Shortcode', 'indsro-core' ),
                'condition'   => [
                    'enable_contact_form' => 'yes',
                ],
            ]
        );

        // END
        $this->end_controls_section();

        // video box
        $this->start_controls_section(
            '_section_video_box',
            [
                'label'     => __( 'Video Box', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_4', 'style_7'],
                ],
            ]
        );

        // enable video box
        $this->add_control(
            'enable_video_box',
            [
                'label'        => __( 'Enable Video Box', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // video_link
        $this->add_control(
            'video_link',
            [
                'label'       => __( 'Video Link', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
            ]
        );

        // video_icon
        $this->add_control(
            'video_icon',
            [
                'label'       => __( 'Video Icon', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // end
        $this->end_controls_section();

        // contact info box
        $this->start_controls_section(
            '_section_contact_info_box',
            [
                'label'     => __( 'Contact Info Box', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_5'],
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

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label'     => __( 'Settings', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_5', 'style_7', 'style_8'],
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
        case 'style_8':
            include $dir . '/views/view-8.php';
            break;
        case 'style_7':
            include $dir . '/views/view-7.php';
            break;
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
