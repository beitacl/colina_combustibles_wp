<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Hero_Slider extends Element_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Element Helper widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'tx_hero_slider';
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
        return __( 'TX Hero Slide', 'indsro-core' );
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
        return ['indsro', 'slide'];
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_design_settings',
            [
                'label' => __( 'Choos Design', 'indsro-core' ),
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

        // images
        $this->start_controls_section(
            '_section_images',
            [
                'label' => __( 'Images', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2', 'style_4', 'style_5'],
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
                'condition' => [
                    'design_style' => ['style_4', 'style_5'],
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
                'condition' => [
                    'design_style' => ['style_4', 'style_5'],
                ],
            ]
        );

        // IMAGE_4
        $this->add_control(
            'image_4',
            [
                'label'       => __( 'Image 4', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => ['style_4'],
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
                'condition' => [
                    'design_style' => 'style_2',
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

        // COUNT BOX
        $this->start_controls_section(
            '_section_count_box',
            [
                'label' => __( 'Count Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_2',
                ],
            ]
        );

        // enable count box
        $this->add_control(
            'enable_count_box',
            [
                'label'        => __( 'Enable Count Box', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
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

        // END
        $this->end_controls_section();

        // SLIDE ITEMS
        $this->start_controls_section(
            '_section_slide_items',
            [
                'label' => __( 'Slide Items', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // design style
        $repeater->add_control(
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
                'description'        => __( 'Please ensure the style matches the one you selected above.', 'indsro-core' ),
            ]
        );

        // image_1
        $repeater->add_control(
            'image_1',
            [
                'label'   => __( 'Image 1', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // image_1
        $repeater->add_control(
            'image_2',
            [
                'label'   => __( 'Image 2', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_4', 'style_5'],
                ],
            ]
        );

        // sub title
        $repeater->add_control(
            'sub_title',
            [
                'label'       => __( 'Sub Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your sub title', 'indsro-core' ),
                'default'     => __( 'We are the best', 'indsro-core' ),
                'label_block' => true,
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_5'],
                ],
            ]
        );

        // title
        $repeater->add_control(
            'title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'indsro-core' ),
                'default'     => __( 'We are the best', 'indsro-core' ),
                'label_block' => true,
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_5'],
                ],
            ]
        );

        // tag
        $repeater->add_control(
            'title_tag',
            [
                'label'   => __( 'Title HTML Tag', 'indsro-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
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
                'default' => 'h2',
                'toggle'  => false,
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_5'],
                ],
            ]
        );

        // description
        $repeater->add_control(
            'description',
            [
                'label'       => __( 'Description', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your description', 'indsro-core' ),
                'default'     => __( 'We are the best', 'indsro-core' ),
            ]
        );

        // button text
        $repeater->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your button text', 'indsro-core' ),
                'default'     => __( 'Get Started', 'indsro-core' ),
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_5'],
                ],
            ]
        );

        // button link
        $repeater->add_control(
            'button_link',
            [
                'label'       => __( 'Button Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'Enter your button link', 'indsro-core' ),
                'default'     => [
                    'url' => '#',
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_5'],
                ],
            ]
        );

        // button icon
        $repeater->add_control(
            'button_icon',
            [
                'label'       => __( 'Button Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'placeholder' => __( 'Enter your button icon', 'indsro-core' ),
                'default'     => [
                    'value'   => 'fas fa-long-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_5'],
                ],
            ]
        );

        // enable author box
        $repeater->add_control(
            'enable_author_box',
            [
                'label'        => __( 'Enable Author Box', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => 'style_4',
                ],
            ]
        );

        // author image
        $repeater->add_control(
            'author_image',
            [
                'label'       => __( 'Author Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'enable_author_box' => 'yes',
                    'design_style' => 'style_4',
                ],
            ]
        );

        // author info
        $repeater->add_control(
            'author_info',
            [
                'label'       => __( 'Author Info', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Author Info',
                'placeholder' => __( 'Enter your author info', 'indsro-core' ),
                'condition'   => [
                    'enable_author_box' => 'yes',
                    'design_style' => 'style_4',
                ],
            ]
        );

        // add repeater
        $this->add_control(
            'slides',
            [
                'label'  => __( 'Slides', 'indsro-core' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // contact info box
        $this->start_controls_section(
            '_section_contact_infos',
            [
                'label' => __( 'Contact Infos', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_1',
                ],
            ]
        );

        // enable email info
        $this->add_control(
            'enable_email_info',
            [
                'label'        => __( 'Enable Email Info', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // contact_email_info_label
        $this->add_control(
            'contact_email_info_label',
            [
                'label'       => __( 'Email Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Email:', 'indsro-core' ),
                'placeholder' => __( 'Enter your email label', 'indsro-core' ),
                'condition'   => [
                    'enable_email_info' => 'yes',
                ],
            ]
        );

        // contact info text
        $this->add_control(
            'contact_email_info_text',
            [
                'label'       => __( 'Contact Info Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Contact Info Text', 'indsro-core' ),
                'placeholder' => __( 'Enter your contact info text', 'indsro-core' ),
                'condition'   => [
                    'enable_email_info' => 'yes',
                ],
            ]
        );

        // enable contact info
        $this->add_control(
            'email_link_type',
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
                    'enable_email_info' => 'yes',
                ],
            ]
        );

        // enable contact info
        $this->add_control(
            'enable_phone_info',
            [
                'label'        => __( 'Enable Phone Info', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // contact_info_label
        $this->add_control(
            'contact_info_label',
            [
                'label'       => __( 'Phone Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Phone:', 'indsro-core' ),
                'placeholder' => __( 'Enter your phone label', 'indsro-core' ),
                'condition'   => [
                    'enable_phone_info' => 'yes',
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
                    'enable_phone_info' => 'yes',
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
                    'enable_phone_info' => 'yes',
                ],
            ]
        );

        // end
        $this->end_controls_section();

        // side info section
        $this->start_controls_section(
            '_section_scoial_info',
            [
                'label' => __( 'Social Links', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_1',
                ],
            ]
        );

        // enable social links
        $this->add_control(
            'enable_social_links',
            [
                'label'        => __( 'Enable Social Links', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // reapeter
        $repeater = new \Elementor\Repeater();

        // social_icon
        $repeater->add_control(
            'social_icon',
            [
                'label'       => __( 'Social Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fab fa-facebook-f',
                    'library' => 'solid',
                ],
                'label_block' => true,
            ]
        );

        // social_link
        $repeater->add_control(
            'social_link',
            [
                'label'       => __( 'Social Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'show_label'  => false,
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        // social_links
        $this->add_control(
            'social_links',
            [
                'label'  => __( 'Social Links', 'indsro-core' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        // END side info section
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_brand_images',
            [
                'label' => __( 'Brands Image', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_5',
                ],
            ]
        );

        // enable brand
        $this->add_control(
            'enable_brands',
            [
                'label'        => __( 'Enable Brands', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
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

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // ENALE LEFT SIDE INFO
        $this->add_control(
            'enable_left_side_info',
            [
                'label'        => __( 'Enable Left Side Info', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // ENABLE SLIDER NAVIGATION
        $this->add_control(
            'enable_slider_navigation',
            [
                'label'        => __( 'Enable Slider Navigation', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // enable_slider_pagination
        $this->add_control(
            'enable_slider_pagination',
            [
                'label'        => __( 'Enable Slider Pagination', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => 'style_3',
                ],
            ]
        );

        // enable_overley_shape
        $this->add_control(
            'enable_overley_shape',
            [
                'label'        => __( 'Enable Overley Shape', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => ['style_2', 'style_3'],
                ],
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
                'condition'    => [
                    'design_style' => 'style_2',
                ],
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
                'condition'    => [
                    'design_style' => 'style_2',
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
