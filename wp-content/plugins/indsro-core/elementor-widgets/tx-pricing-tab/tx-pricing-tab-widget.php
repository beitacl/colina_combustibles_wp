<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Pricing_Tab extends Element_El_Widget {

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
        return 'tx_pricing_tab';
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
        return __( 'TX Pricing Tab', 'indsro-core' );
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
        return ['price', 'tab'];
    }

    public function elh_custom_animations() {
        return [
            'none'             => __( 'None', 'telnet-core' ),
            'appear_left'   => __( 'Appear Left', 'telnet-core' ),
            'appear_right'  => __( 'Appear Right', 'telnet-core' ),
            'appear_top'   => __( 'Appear Top', 'telnet-core' ),
        ];
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
                'condition' => [
                    'design_style' => 'style_2',
                ],
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
            '_section_pricing_tab',
            [
                'label' => __( 'Pricing Tab', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // repeater
        $repeater = new Repeater();

        // design style
        $repeater->add_control(
            'design_style',
            [
                'label'              => __( 'Design Style', 'indsro-core' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'style_1' => __( 'Style 1', 'indsro-core' ),
                    'style_2' => __( 'Style 2', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        // is_active
        $repeater->add_control(
            'is_active',
            [
                'label'        => __( 'Active', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
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

        // tab_price
        $repeater->add_control(
            'currency',
            [
                'label' => __('Currency', 'indsro-core'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'indsro-core'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'indsro-core'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'indsro-core'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'indsro-core'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'indsro-core'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'indsro-core'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'indsro-core'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'indsro-core'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'indsro-core'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'indsro-core'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'indsro-core'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'indsro-core'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'indsro-core'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'indsro-core'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'indsro-core'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'indsro-core'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'indsro-core'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'indsro-core'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'indsro-core'),
                    'custom' => __('Custom', 'indsro-core'),
                ],
                'default' => 'dollar',
            ]
        );

        $repeater->add_control(
            'currency_custom',
            [
                'label' => __('Custom Symbol', 'indsro-core'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // PRICE
        $repeater->add_control(
            'price',
            [
                'label' => __('Price', 'indsro-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        // period
        $repeater->add_control(
            'period',
            [
                'label' => __('Period', 'indsro-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Per Month', 'indsro-core'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        // tab image
        $repeater->add_control(
            'tab_image',
            [
                'label' => __('Tab Image', 'indsro-core'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        // enable video button
        $repeater->add_control(
            'enable_video_button',
            [
                'label' => __('Enable Video Button', 'indsro-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'indsro-core'),
                'label_off' => __('Hide', 'indsro-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // video icon
        $repeater->add_control(
            'video_icon',
            [
                'label' => __('Video Icon', 'indsro-core'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_video_button' => 'yes',
                ]
            ]
        );

        // video link
        $repeater->add_control(
            'video_link',
            [
                'label' => __('Video Link', 'indsro-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'enable_video_button' => 'yes',
                ]
            ]
        );

        // price content subtitle
        $repeater->add_control(
            'price_content_subtitle',
            [
                'label' => __('Price Content Subtitle', 'indsro-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Price Content Subtitle', 'indsro-core'),
                'dynamic' => [
                    'active' => true
                ],
                'label_block' => true,
            ]
        );

        // price content title
        $repeater->add_control(
            'price_content_title',
            [
                'label' => __('Price Content Title', 'indsro-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Price Content Title', 'indsro-core'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        // enable feature lists
        $repeater->add_control(
            'enable_feature_lists',
            [
                'label' => __('Enable Feature Lists', 'indsro-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'indsro-core'),
                'label_off' => __('Hide', 'indsro-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // price feature icon
        $repeater->add_control(
            'price_feature_icon',
            [
                'label' => __('Price Feature Icon', 'indsro-core'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_feature_lists' => 'yes',
                ]
            ]
        );

        // price content description
        $repeater->add_control(
            'price_feature_lists',
            [
                'label' => __('Price Features', 'indsro-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Price Feature', 'indsro-core'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'enable_feature_lists' => 'yes',
                ]
            ]
        );

        // price content button text
        $repeater->add_control(
            'price_content_button_text',
            [
                'label' => __('Price Content Button Text', 'indsro-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Price Content Button Text', 'indsro-core'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        // price content button link
        $repeater->add_control(
            'price_content_button_link',
            [
                'label' => __('Price Content Button Link', 'indsro-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'choicy-core'),
                'placeholder' => __('Select a section template for as tab content', 'choicy-core'),
                'description' => sprintf(__('Wondering what is section template or need to create one? Please click %1$shere%2$s ', 'choicy-core'),
                    '<a target="_blank" href="' . esc_url(admin_url('/edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section')) . '">',
                    '</a>'
                ),
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates(),
                'label_block' => true,
                'condition' => [
                    'design_style' => 'style_2',
                ],
            ]
        );

        // lists items
        $this->add_control(
            'pricingTab_lists',
            [
                'label'   => __( 'Pricing Tabs', 'indsro-core' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_2',
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

    private static function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'baht'         => '&#3647;',
            'bdt'          => '&#2547;',
            'dollar'       => '&#36;',
            'euro'         => '&#128;',
            'franc'        => '&#8355;',
            'guilder'      => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound'        => '&#163;',
            'peso'         => '&#8369;',
            'peseta'       => '&#8359',
            'lira'         => '&#8356;',
            'ruble'        => '&#8381;',
            'shekel'       => '&#8362;',
            'rupee'        => '&#8360;',
            'real'         => 'R$',
            'krona'        => 'kr',
            'won'          => '&#8361;',
            'yen'          => '&#165;',
        ];

        return isset( $symbols[$symbol_name] ) ? $symbols[$symbol_name] : '';
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
