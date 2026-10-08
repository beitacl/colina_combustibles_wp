<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_button',
    [
        'label' => __( 'BUTTON STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'button_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '
        {{WRAPPER}} .tx-button,
        {{WRAPPER}} .tx-button .text
        ',
    ]
);

// Border radious
$this->add_responsive_control(
    'button_border_radius',
    [
        'label'      => __( 'Border Radius', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors'  => [
            '{{WRAPPER}} .tx-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

// Group_Control_Border
$this->add_group_control(
    Group_Control_Border::get_type(),
    [
        'name'     => 'button_border',
        'label'    => __( 'Border', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .tx-button',
    ]
);

// padding
$this->add_responsive_control(
    'button_padding',
    [
        'label'      => __( 'Padding', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors'  => [
            '{{WRAPPER}} .tx-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

// margin
$this->add_responsive_control(
    'button_margin',
    [
        'label'      => __( 'Margin', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors'  => [
            '{{WRAPPER}} .tx-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->start_controls_tabs( '_tabs_button' );

$this->start_controls_tab(
    '_tab_button_normal',
    [
        'label' => __( 'Normal', 'indsro-core' ),
    ]
);

// color
$this->add_control(
    'button_color',
    [
        'label'     => __( 'Text Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-button'       => 'color: {{VALUE}};',
            '{{WRAPPER}} .tx-button .text' => 'color: {{VALUE}};',
        ],
    ]
);

// icon color
$this->add_control(
    'button_icon_color',
    [
        'label'     => __( 'Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-button .icon' => 'color: {{VALUE}};',
        ],
    ]
);

// group control bg color
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'button_bg_color',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '
            {{WRAPPER}} .tx-button
        ',
    ]
);

$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'button_after_color',
        'label'    => __( 'Button After Bg', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '
            {{WRAPPER}} .tx-button::after
        ',
    ]
);

$this->end_controls_tab();

$this->start_controls_tab(
    '_tab_button_hover',
    [
        'label' => __( 'Hover', 'indsro-core' ),
    ]
);

// color
$this->add_control(
    'button_color_hover',
    [
        'label'     => __( 'Text Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-button:hover'       => 'color: {{VALUE}};',
            '{{WRAPPER}} .tx-button:hover .text' => 'color: {{VALUE}};',
        ],
    ]
);

// icon color
$this->add_control(
    'button_icon_color_hover',
    [
        'label'     => __( 'Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-button:hover .icon' => 'color: {{VALUE}};',
        ],
    ]
);

// background color
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'button_bg_color_hover',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '
         {{WRAPPER}} .tx-button:hover
        ',
    ]
);

$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'button_after_bg_color_hover',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '
        {{WRAPPER}} .tx-button:hover::after
        ',
    ]
);

$this->end_controls_tab();

$this->end_controls_tabs();

$this->end_controls_section();