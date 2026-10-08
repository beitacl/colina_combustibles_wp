<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Project_Section extends Element_El_Widget {

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
        return 'tx_project_section';
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
        return __( 'TX Project Section', 'indsro-core' );
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
        return ['slide', 'service'];
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
            ]
        );

        // END
        $this->end_controls_section();

        // PROJECT BOX LISTS 1
        $this->start_controls_section(
            '_section_project_box',
            [
                'label' => __( 'Project Boxs', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // REPEATER
        $repeater = new Repeater();

        // design style
        $repeater->add_control(
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

        // select animation
        $repeater->add_control(
            'choose_anim',
            [
                'label'              => __( 'Choose Animation', 'indsro-core' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'none'      => __( 'None', 'indsro-core' ),
                    'faderight' => __( 'Fade Right', 'indsro-core' ),
                    'fadeleft'  => __( 'Fade Left', 'indsro-core' ),
                ],
                'default'            => 'none',
                'frontend_available' => true,
                'style_transfer'     => true,
                'condition'          => [
                    'design_style' => 'style_2',
                ],
            ]
        );

        // PROJECT IMAGE
        $repeater->add_control(
            'project_image',
            [
                'label'   => __( 'Project Image', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // PROJECT TITLE
        $repeater->add_control(
            'project_title',
            [
                'label'       => __( 'Project Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Project Title', 'indsro-core' ),
                'placeholder' => __( 'Project Title', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // project button text
        $repeater->add_control(
            'project_button_text',
            [
                'label'       => __( 'Project Button Text', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'View Project', 'indsro-core' ),
                'placeholder' => __( 'View Project', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => 'style_2',
                ],
            ]
        );

        // PROJECT LINK
        $repeater->add_control(
            'project_link',
            [
                'label'       => __( 'Project Link', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // button icon
        $repeater->add_control(
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
                    'design_style' => 'style_2',
                ],
            ]
        );

        // project date
        $repeater->add_control(
            'project_date',
            [
                'label'       => __( 'Project Date', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '10 FEBRUART 2024', 'indsro-core' ),
                'placeholder' => __( '10 FEBRUART 2024', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => 'style_2',
                ],
            ]
        );

        // name label
        $repeater->add_control(
            'name_label',
            [
                'label'       => __( 'Name Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Client:', 'indsro-core' ),
                'placeholder' => __( 'Client:', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => 'style_2',
                ],
            ]
        );

        // client name
        $repeater->add_control(
            'client_name',
            [
                'label'       => __( 'Client Name', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Devon Lane', 'indsro-core' ),
                'placeholder' => __( 'Devon Lane', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => 'style_2',
                ],
            ]
        );

        // enable feature lists
        $repeater->add_control(
            'enable_feature_lists',
            [
                'label'        => __( 'Enable Feature Lists', 'indsro-core' ),
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

        // feature lists lable
        $repeater->add_control(
            'feature_lists_label',
            [
                'label'       => __( 'Feature Lists Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Services:', 'indsro-core' ),
                'placeholder' => __( 'Services:', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style'         => 'style_2',
                    'enable_feature_lists' => 'yes',
                ],
            ]
        );

        // feature lists
        $repeater->add_control(
            'feature_lists',
            [
                'label'       => __( 'Feature Lists Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Services:', 'indsro-core' ),
                'placeholder' => __( 'Services:', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style'         => 'style_2',
                    'enable_feature_lists' => 'yes',
                ],
            ]
        );

        // enable_tag_lists
        $repeater->add_control(
            'enable_tag_lists',
            [
                'label'        => __( 'Enable Tag Lists', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => 'style_1',
                ],
            ]
        );

        // PROJECT TAGS LISTS
        $repeater->add_control(
            'project_tags_lists',
            [
                'label'     => __( 'Tag Lists', 'indsro-core' ),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => [
                    // tag text
                    [
                        'name'        => 'tag_text',
                        'label'       => __( 'Tag Text', 'indsro-core' ),
                        'label_block' => true,
                        'type'        => Controls_Manager::TEXT,
                        'default'     => __( 'Tag Text', 'indsro-core' ),
                        'placeholder' => __( 'Tag Text', 'indsro-core' ),
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],
                    // tag link
                    [
                        'name'        => 'tag_link',
                        'label'       => __( 'Tag Link', 'indsro-core' ),
                        'label_block' => true,
                        'type'        => Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],
                ],
                'condition' => [
                    'enable_tag_lists' => 'yes',
                    'design_style'     => 'style_1',
                ],
            ]
        );

        // PROJECT BOX LISTS 1
        $this->add_control(
            'project_box_lists_1',
            [
                'label'       => __( 'Project Box Lists 1', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ project_title }}}',
            ]
        );

        // END
        $this->end_controls_section();

        // PROJECT BOX LISTS 2
        $this->start_controls_section(
            '_section_project_box_lists_2',
            [
                'label'     => __( 'Project Box Lists 2', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_1',
                ],
            ]
        );

        // ENABLE PROJECT BOX LISTS 1
        $this->add_control(
            'enable_project_box_lists_2',
            [
                'label'        => __( 'Enable Project Box Lists 2', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // REPEATER
        $repeater = new Repeater();

        // PROJECT IMAGE
        $repeater->add_control(
            'project_image',
            [
                'label'   => __( 'Project Image', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // PROJECT TITLE
        $repeater->add_control(
            'project_title',
            [
                'label'       => __( 'Project Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Project Title', 'indsro-core' ),
                'placeholder' => __( 'Project Title', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // PROJECT LINK
        $repeater->add_control(
            'project_link',
            [
                'label'       => __( 'Project Link', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // enable_tag_lists
        $repeater->add_control(
            'enable_tag_lists',
            [
                'label'        => __( 'Enable Tag Lists', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // PROJECT TAGS LISTS
        $repeater->add_control(
            'project_tags_lists',
            [
                'label'     => __( 'Tag Lists', 'indsro-core' ),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => [
                    // tag text
                    [
                        'name'        => 'tag_text',
                        'label'       => __( 'Tag Text', 'indsro-core' ),
                        'label_block' => true,
                        'type'        => Controls_Manager::TEXT,
                        'default'     => __( 'Tag Text', 'indsro-core' ),
                        'placeholder' => __( 'Tag Text', 'indsro-core' ),
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],

                    // tag link
                    [
                        'name'        => 'tag_link',
                        'label'       => __( 'Tag Link', 'indsro-core' ),
                        'label_block' => true,
                        'type'        => Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],
                ],
                'condition' => [
                    'enable_tag_lists' => 'yes',
                ],
            ]
        );

        // PROJECT BOX LISTS 1
        $this->add_control(
            'project_box_lists_2',
            [
                'label'       => __( 'Project Box Lists 2', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ project_title }}}',
            ]
        );

        // END
        $this->end_controls_section();

        // PROJECT BOX LISTS 2
        $this->start_controls_section(
            '_section_project_box_lists_3',
            [
                'label'     => __( 'Project Box Lists 3', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_1',
                ],
            ]
        );

        // ENABLE PROJECT BOX LISTS 1
        $this->add_control(
            'enable_project_box_lists_3',
            [
                'label'        => __( 'Enable Project Box Lists 3', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // REPEATER
        $repeater = new Repeater();

        // PROJECT IMAGE
        $repeater->add_control(
            'project_image',
            [
                'label'   => __( 'Project Image', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // PROJECT TITLE
        $repeater->add_control(
            'project_title',
            [
                'label'       => __( 'Project Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Project Title', 'indsro-core' ),
                'placeholder' => __( 'Project Title', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // PROJECT LINK
        $repeater->add_control(
            'project_link',
            [
                'label'       => __( 'Project Link', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // enable_tag_lists
        $repeater->add_control(
            'enable_tag_lists',
            [
                'label'        => __( 'Enable Tag Lists', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // PROJECT TAGS LISTS
        $repeater->add_control(
            'project_tags_lists',
            [
                'label'     => __( 'Tag Lists', 'indsro-core' ),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => [
                    // tag text
                    [
                        'name'        => 'tag_text',
                        'label'       => __( 'Tag Text', 'indsro-core' ),
                        'label_block' => true,
                        'type'        => Controls_Manager::TEXT,
                        'default'     => __( 'Tag Text', 'indsro-core' ),
                        'placeholder' => __( 'Tag Text', 'indsro-core' ),
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],

                    // tag link
                    [
                        'name'        => 'tag_link',
                        'label'       => __( 'Tag Link', 'indsro-core' ),
                        'label_block' => true,
                        'type'        => Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],
                ],
                'condition' => [
                    'enable_tag_lists' => 'yes',
                ],
            ]
        );

        // PROJECT BOX LISTS 1
        $this->add_control(
            'project_box_lists_3',
            [
                'label'       => __( 'Project Box Lists 3', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ project_title }}}',
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

        case 'style_2':
            include $dir . '/views/view-2.php';
            break;
        default:
            include $dir . '/views/view-1.php';
        }
    }
}
