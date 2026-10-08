<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Headers extends Element_El_Widget {

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
        return 'tx_headers';
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
        return __( 'TX Headers', 'indsro-core' );
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
        return ['btn', 'header', 'indsro', 'indsro header'];
    }

    // get menu by slug
    public function get_menu() {
        $menus = wp_get_nav_menus();
        $menu_list = [];
        if ( $menus ) {
            foreach ( $menus as $menu ) {
                $menu_list[$menu->slug] = $menu->name;
            }
        }
        return $menu_list;
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
                    'style_1' => __( 'Header One', 'indsro-core' ),
                    'style_2' => __( 'Header two', 'indsro-core' ),
                    'style_3' => __( 'Header three', 'indsro-core' ),
                    'style_4' => __( 'Header Four', 'indsro-core' ),
                    'style_5' => __( 'Header Five', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        // contact info lists
        $this->start_controls_section(
            '_section_contact_infoLists',
            [
                'label'     => __( 'Contact Info Lists', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'enable_contact_info' => 'yes',
                ],
            ]
        );

        // info_text
        $this->add_control(
            'info_text',
            [
                'label'       => __( 'Info Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Info Text', 'indsro-core' ),
                'placeholder' => __( 'Enter your info text', 'indsro-core' ),
            ]
        );

        // reapeter
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

        // info label
        $repeater->add_control(
            'info_label',
            [
                'label'       => __( 'Info Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Info Label', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
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
                'default'        => 'icon',
                'toggle'         => false,
                'style_transfer' => true,
            ]
        );

         // enable_link
         $repeater->add_control(
            'enable_link',
            [
                'label'        => __( 'Enable Link', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // info_link
        $repeater->add_control(
            'info_link',
            [
                'label'       => __( 'Info Link', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'show_label'  => false,
                'condition'   => [
                    'enable_link' => 'yes',
                    'link_type'   => 'url',
                ],
            ]
        );

        // info text
        $repeater->add_control(
            'info_text',
            [
                'label'       => __( 'Info Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Info Text', 'indsro-core' ),
                'placeholder' => __( 'Enter your info text', 'indsro-core' ),
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label'       => __( 'Info Lists', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'info_label' => __( 'Info Text', 'indsro-core' ),
                    ],
                ],
                'title_field' => '{{{ info_label }}}',
            ]
        );

        // end
        $this->end_controls_section();

        // logo section
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => __( 'Logo', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // logo
        $this->add_control(
            'logo',
            [
                'label'       => __( 'Logo', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );

        // enable mobile logo
        $this->add_control(
            'enable_mobile_logo',
            [
                'label'        => __( 'Enable Mobile Logo', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'description'  => __( 'Enable mobile logo only for mobile device', 'indsro-core' ),
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // sideino logo
        $this->add_control(
            'mobile_logo',
            [
                'label'       => __( 'Mobile Logo', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'condition'   => [
                    'enable_mobile_logo' => 'yes',
                ],
            ]
        );

        // enable custom link
        $this->add_control(
            'enable_custom_link',
            [
                'label'        => __( 'Enable Custom Link', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // custom link
        $this->add_control(
            'custom_link',
            [
                'label'       => __( 'Custom Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'show_label'  => false,
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'enable_custom_link' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_width',
            [
                'label'      => esc_html__( 'Max Width', 'gesto-plugin' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],

                'selectors'  => [
                    '{{WRAPPER}} .tx-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // shape image
        $this->add_control(
            'shape_image',
            [
                'label'       => __( 'Shape Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'condition'   => [
                    'design_style' => ['style_4'],
                ],
            ]
        );

        // end logo section
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_menu',
            [
                'label' => __( 'Menu Options', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // select menu
        $this->add_control(
            'select_menu',
            [
                'label'       => __( 'Select Menu', 'indsro-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_menu(),
                'label_block' => true,
                'multiple'    => false,
            ]
        );

        // select mobile menu
        $this->add_control(
            'select_mobile_menu',
            [
                'label'       => __( 'Select Mobile Menu', 'indsro-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_menu(),
                'label_block' => true,
                'multiple'    => false,
            ]
        );

        $this->end_controls_section();

        // BUTTON SECTION
        $this->start_controls_section(
            '_section_button',
            [
                'label'     => __( 'Button', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );

        // button text
        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Get Started', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // button link
        $this->add_control(
            'button_link',
            [
                'label'       => __( 'Button Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'show_label'  => false,
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        // button icon
        $this->add_control(
            'button_icon',
            [
                'label'       => __( 'Button Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fal fa-long-arrow-right',
                    'library' => 'solid',
                ],
                'label_block' => true,
            ]
        );

        // END BUTTON SECTION
        $this->end_controls_section();

        // side info section
        $this->start_controls_section(
            '_section_scoial_info',
            [
                'label' => __( 'Social Links', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'enable_social_links' => 'yes',
                ],
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

        // search box
        $this->start_controls_section(
            '_section_search',
            [
                'label'     => __( 'Search Box', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'enable_search' => 'yes',
                ],
            ]
        );

        // search placeholder
        $this->add_control(
            'search_placeholder',
            [
                'label'       => __( 'Search Placeholder', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Search...', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // search button text
        $this->add_control(
            'search_button_text',
            [
                'label'       => __( 'Search Button Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Search', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // search button icon
        $this->add_control(
            'search_button_icon',
            [
                'label'       => __( 'Search Button Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fal fa-search',
                    'library' => 'solid',
                ],
                'label_block' => true,
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
                    'design_style' => ['style_4'],
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

        // settings section
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'SETTINGS', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // enable sticky header
        $this->add_control(
            'enable_sticky_header',
            [
                'label'        => __( 'ENABLE STICKY HEADER', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // ENABLE CONTACT INFO
        $this->add_control(
            'enable_contact_info',
            [
                'label'        => __( 'ENABLE CONTACT INFO?', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // enable button
        $this->add_control(
            'enable_button',
            [
                'label'        => __( 'Enable Button', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // enable search
        $this->add_control(
            'enable_search',
            [
                'label'        => __( 'Enable Search', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
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

        // enable_cart_icon
        $this->add_control(
            'enable_cart_icon',
            [
                'label'        => __( 'Enable Cart Icon', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        // end settings section
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
