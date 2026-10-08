<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_sub_title',
    [
        'label' => __( 'SUB HEADING STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// sub title icon width
$this->add_responsive_control(
    'sub_title_icon_width',
    [
        'label'      => __( 'Icon Width', 'indsro-core' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => ['px', 'em'],
        'selectors'  => [
            '{{WRAPPER}} .tx-heading-section .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

// sub title icon size
$this->add_responsive_control(
    'sub_title_icon_size',
    [
        'label'      => __( 'Icon Size', 'indsro-core' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => ['px', 'em'],
        'selectors'  => [
            '{{WRAPPER}} .tx-heading-section .icon' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
    ]
);

// sub title icon color
$this->add_control(
    'sub_title_icon_color',
    [
        'label'     => __( 'Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-heading-section .icon' => 'color: {{VALUE}};',
        ],
    ]
);

// icon bg color
$this->add_control(
    'sub_title_icon_bg_color',
    [
        'label'     => __( 'Icon Background Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-heading-section .icon' => 'background-color: {{VALUE}};',
        ],
    ]
);



// sub title color
$this->add_control(
    'sub_title_color',
    [
        'label'     => __( 'Sub Title Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-subTitle' => 'color: {{VALUE}};',
        ],
    ]
);

// sub title bg color
$this->add_control(
    'sub_title_bg_color',
    [
        'label'     => __( 'Background Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-subTitle' => 'background-color: {{VALUE}};',
        ],
    ]
);

// sub title padding
$this->add_responsive_control(
    'sub_title_padding',
    [
        'label'      => __( 'Padding', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors'  => [
            '{{WRAPPER}} .tx-subTitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

// sub title margin
$this->add_responsive_control(
    'sub_title_margin',
    [
        'label'      => __( 'Margin', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors'  => [
            '{{WRAPPER}} .tx-subTitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

// sub title typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'sub_title_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '
        {{WRAPPER}} .tx-subTitle
        ',
    ]
);

// sub title border radius
$this->add_responsive_control(
    'sub_title_border_radius',
    [
        'label'      => __( 'Border Radius', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px'],
        'selectors'  => [
            '{{WRAPPER}} .tx-subTitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();