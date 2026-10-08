<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Moving_Text extends Element_El_Widget {

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
        return 'tx_moving_text';
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
        return __( 'TX Moving Text', 'indsro-core' );
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
        return ['btn', 'lists', 'info', 'info lists'];
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
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
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_list_items',
            [
                'label' => __( 'List Items', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

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
                    'type' => 'icon',
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
                    'type' => 'image',
                    'enable_icon' => 'yes',
                ],
            ]
        );

        // info label
        $repeater->add_control(
            'custom_cls',
            [
                'label'       => __( 'Item Class', 'indsro-core' ),
                'default'       => __( 'title-1', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'condition'      => [
                    'enable_link' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'info_label',
            [
                'label'       => __( 'Info Label', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Info Label', 'indsro-core' ),
                'label_block' => true,
            ]
        );

        // enable link
        $repeater->add_control(
            'enable_link',
            [
                'label'        => __( 'Enable Link', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // list_link
        $repeater->add_control(
            'list_link',
            [
                'label'       => __( 'Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url' => '#',
                ],
                'condition'      => [
                    'enable_link' => 'yes',
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
                'condition'      => [
                    'design_style' => ['style_1', 'style_3'],
                ],
            ]
        );
        // info label
        $this->add_control(
            'info_label',
            [
                'label'       => __( 'Moving Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Info Label', 'indsro-core' ),
                'label_block' => true,
                'condition'      => [
                    'design_style' => ['style_2'],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_items',
            [
                'label' => __( 'Style', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'types' => [ 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .chy-marquee-5-area',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__( 'Moving BG Color ', 'indsro-core' ),
                        'description' => esc_html__( 'Choose background type and style.', 'indsro-core' ),
                        'separator' => 'before',
                    ]
                ]
			]
		);

        $this->add_control(
			'title-c',
			[
				'label' => esc_html__( 'Title Color', 'gesto-plugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .chy-marquee-5-wrap .title-1, .chy-marquee-5-wrap .title-2' => 'color: {{VALUE}}',
					'{{WRAPPER}} .chy-marquee-5-wrap .title-1, .chy-marquee-5-wrap .title-2' => '-webkit-text-stroke: 1px {{VALUE}}; color:{{VALUE}}',
					'{{WRAPPER}} .marquee-text-6-wrap .title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '
                {{WRAPPER}} .chy-marquee-5-wrap .title-1, .chy-marquee-5-wrap .title-2,
                {{WRAPPER}} .marquee-text-6-wrap .title
                ',
			]
		);

        // text hover color
        $this->add_control(
            'text_hover_color',
            [
                'label'     => __( 'Text Hover Color', 'indsro-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .chy-marquee-5-wrap .title-1:hover, .chy-marquee-5-wrap .title-2:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .marquee-text-6-wrap .title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_section();

    }

    protected function register_style_controls() {

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

        $style = !empty($settings['design_style']) ? $settings['design_style'] : 'style_1';

        switch ($style) {
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
