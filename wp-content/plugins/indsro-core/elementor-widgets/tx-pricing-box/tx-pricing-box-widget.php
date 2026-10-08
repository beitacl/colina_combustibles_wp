<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Pricing_Box extends Element_El_Widget {

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
        return 'tx_pricing_box';
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
        return __( 'TX Pricing Box', 'indsro-core' );
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
        return ['pricing', 'telnet', 'telnet pricing', 'price'];
    }

    public function elh_custom_animations() {
        return [
            'none'             => __( 'None', 'telnet-core' ),
            'appear_left'   => __( 'Appear Left', 'telnet-core' ),
            'appear_right'  => __( 'Appear Right', 'telnet-core' ),
            'appear_top'   => __( 'Appear Top', 'telnet-core' ),
        ];
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
            '_section_design_settings',
            [
                'label' => __( 'Design Settings', 'indsro-core' ),
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
                'label' => __( 'Header', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // enable_icon
        $this->add_control(
            'enable_icon',
            [
                'label'        => __( 'Enable Icon', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => 'style_10',
                ],
            ]
        );

        $this->add_control(
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
                    'design_style' => 'style_10',
                ],
            ]
        );

        // list icon
        $this->add_control(
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
                    'design_style' => 'style_10',
                ],
            ]
        );

        // list image
        $this->add_control(
            'list_image',
            [
                'label'       => __( 'Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition'   => [
                    'type'        => 'image',
                    'enable_icon' => 'yes',
                    'design_style' => 'style_10',
                ],
            ]
        );

        // pricing iamge
        $this->add_control(
            'pricing_image',
            [
                'label'       => __( 'Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition'   => [
                    'design_style' => 'style_1',
                ],
            ]
        );

        // pricing header title
        $this->add_control(
            'pricing_title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Pricing Title', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // short description
        $this->add_control(
            'pricing_description',
            [
                'label'       => __( 'Description', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'The Basic Plan offers essential features at an affordable price, ideal for startups and small businesses.', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_package_feature',
            [
                'label' => __( 'Package Feature', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // enable feature list
        $this->add_control(
            'enable_package_feature',
            [
                'label'        => __( 'Enable Feature List', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // package feature lists
        $repeater = new \Elementor\Repeater();

        // package feature icon
        $repeater->add_control(
            'package_feature_icon',
            [
                'label'       => __( 'Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-check',
                    'library' => 'solid',
                ],
                'label_block' => true,
            ]
        );

        // package feature title
        $repeater->add_control(
            'package_feature_title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Feature Title', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // package feature lists
        $this->add_control(
            'package_feature_lists',
            [
                'label'       => __( 'Feature Lists', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'package_feature_title' => __( 'Feature Title', 'indsro-core' ),
                    ],
                    [
                        'package_feature_title' => __( 'Feature Title', 'indsro-core' ),
                    ],
                    [
                        'package_feature_title' => __( 'Feature Title', 'indsro-core' ),
                    ],
                ],
                'title_field' => '{{{ package_feature_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_price',
            [
                'label' => __( 'Price', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label'       => __( 'Currency', 'indsro-core' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    ''             => __( 'None', 'indsro-core' ),
                    'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'indsro-core' ),
                    'bdt'          => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'indsro-core' ),
                    'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'indsro-core' ),
                    'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'indsro-core' ),
                    'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'indsro-core' ),
                    'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'indsro-core' ),
                    'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'indsro-core' ),
                    'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'indsro-core' ),
                    'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'indsro-core' ),
                    'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'indsro-core' ),
                    'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'indsro-core' ),
                    'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'indsro-core' ),
                    'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'indsro-core' ),
                    'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'indsro-core' ),
                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'indsro-core' ),
                    'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'indsro-core' ),
                    'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'indsro-core' ),
                    'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'indsro-core' ),
                    'custom'       => __( 'Custom', 'indsro-core' ),
                ],
                'default'     => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label'     => __( 'Custom Symbol', 'indsro-core' ),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic'   => [
                    'active' => true,
                ],
            ]
        );

        // PRICE
        $this->add_control(
            'price',
            [
                'label'   => __( 'Price', 'indsro-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // period
        $this->add_control(
            'period',
            [
                'label'   => __( 'Period', 'indsro-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Per Month', 'indsro-core' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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

        // button text
        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Button Text', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // button icon
        $this->add_control(
            'button_icon',
            [
                'label'       => __( 'Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block' => true,
            ]
        );

        // button link
        $this->add_control(
            'button_link',
            [
                'label'       => __( 'Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'default'     => [
                    'url' => '#',
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label'     => __( 'Settings', 'indsro-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        // enable animation
        $this->add_control(
            'enable_animation',
            [
                'label'        => __( 'Enable Animation', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

         // wow animation
         $this->add_control(
            'wow_animation',
            [
                'label'     => __( 'Wow Animation', 'indsro-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->elh_element_animations(),
                'default'   => 'fadeIn',
                'condition' => [
                    'enable_animation' => 'yes',
                    'design_style'     => [
                        'style_1',
                    ],
                ],
            ]
        );

        // wow duration
        $this->add_control(
            'wow_duration',
            [
                'label'     => __( 'Wow Duration', 'indsro-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => '1000',
                'condition' => [
                    'enable_animation' => 'yes',
                    'design_style'     => [
                        'style_1',
                    ],
                ],
            ]
        );

        // wow delay
        $this->add_control(
            'wow_delay',
            [
                'label'     => __( 'Wow Delay', 'indsro-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => '200',
                'condition' => [
                    'enable_animation' => 'yes',
                    'design_style'     => [
                        'style_1',
                    ],
                ],
            ]
        );

        // END
        $this->end_controls_section();

    }

    protected function register_style_controls() {

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

        if ( $settings['currency'] === 'custom' ) {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol( $settings['currency'] );
        }

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
