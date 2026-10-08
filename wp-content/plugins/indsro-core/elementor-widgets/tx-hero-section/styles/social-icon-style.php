<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;


$this->start_controls_section(
    '_section_style_social_icon',
    [
        'label' => __( 'SOCIAL ICONS STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// social heding text typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'social_title_typography',
        'label'    => __( 'Social Title Typography', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .tx-socialLists .text',
    ]
);

// social heading line bg color
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'social_title_bg_color',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '
            {{WRAPPER}} .chy-hero-4-social .text::after,
            {{WRAPPER}} .chy-hero-4-social .text
        ',
    ]
);

// Icon Size
$this->add_responsive_control(
    'social_icon_size',
    [
        'label'      => __( 'Icon Size', 'indsro-core' ),
        'type'       => Controls_Manager::SLIDER,
        'selectors'  => [
            '{{WRAPPER}} .tx-socialLists i' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->start_controls_tabs( '_tabs_social' );

$this->start_controls_tab(
    '_tab_social_normal',
    [
        'label' => __( 'Normal', 'indsro-core' ),
    ]
);

// icon color
$this->add_control(
    'social_icon_color',
    [
        'label'     => __( 'Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-socialLists i' => 'color: {{VALUE}};',
        ],
    ]
);

// group control bg color
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'social_bg_color',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '
            {{WRAPPER}} .tx-socialLists a
        ',
    ]
);

$this->end_controls_tab();

$this->start_controls_tab(
    '_tab_social_hover',
    [
        'label' => __( 'Hover', 'indsro-core' ),
    ]
);

// icon color
$this->add_control(
    'social_icon_color_hover',
    [
        'label'     => __( 'Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-socialLists li:hover i' => 'color: {{VALUE}};',
        ],
    ]
);

// background color
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'social_bg_color_hover',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '
        {{WRAPPER}} .tx-socialLists li:hover a
        ',
    ]
);

$this->end_controls_tab();

$this->end_controls_tabs();

$this->end_controls_section();