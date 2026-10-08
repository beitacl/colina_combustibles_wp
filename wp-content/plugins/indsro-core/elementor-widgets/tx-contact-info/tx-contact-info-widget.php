<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Contact_Info extends Element_El_Widget {

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
        return 'tx_contact_info';
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
        return __( 'TX Contact Info', 'indsro-core' );
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
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
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
                    'design_style' => ['style_1'],
                ],
            ]
        );

        // contact info icon
        $this->add_control(
            'contact_info_icon',
            [
                'label'   => __( 'Contact Info Icon', 'indsro-core' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-phone',
                    'library' => 'fa-solid',
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
            ]
        );

        // end
        $this->end_controls_section();

        // contact info lists
        $this->start_controls_section(
            '_section_contact_infoLists',
            [
                'label'     => __( 'Contact Info Lists', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2', 'style_3', 'style_4'],
                ],
            ]
        );

        // image_1
        $this->add_control(
            'image_1',
            [
                'label'     => __( 'Background Image', 'indsro-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => ['style_4'],
                ],
            ]
        );

        // enable_contact_info
        $this->add_control(
            'enable_contact_info',
            [
                'label'        => __( 'Enable Contact Info', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
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

        // info heading
        $repeater->add_control(
            'info_heading',
            [
                'label'       => __( 'Info Heading', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Info Heading', 'indsro-core' ),
                'label_block' => true,
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

        // BUTTON
        $this->start_controls_section(
            '_section_button',
            [
                'label'     => __( 'Button', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2'],
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
