<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_pricing_style',
    [
        'label' => __( 'PRICING STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// pricing title color
$this->add_control(
    'pricing_title_color',
    [
        'label'     => __( 'Pricing Title Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-pricing-1-card .card-top .card-title-wrap .title' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'pricing_title_typography',
        'label'     => esc_html__( 'Pricing Title Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-pricing-1-card .card-top .card-title-wrap .title',
    ]
);

// PRICE COLOR
$this->add_control(
    'price_color',
    [
        'label'     => __( 'Price Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-pricing-1-card .card-top .card-title-wrap .price' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'price_typography',
        'label'     => esc_html__( 'Price Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-pricing-1-card .card-top .card-title-wrap .price',
    ]
);

// PERIOD COLOR
$this->add_control(
    'period_color',
    [
        'label'     => __( 'Period Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-pricing-1-card .card-top .card-title-wrap .price .month' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'period_typography',
        'label'     => esc_html__( 'Period Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-pricing-1-card .card-top .card-title-wrap .price .month',
    ]
);

// CONTENT COLOR
$this->add_control(
    'content_color',
    [
        'label'     => __( 'Content Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-pricing-1-card .disc' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'content_typography',
        'label'     => esc_html__( 'Content Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-pricing-1-card .disc',
    ]
);

// LIST COLOR
$this->add_control(
    'list_color',
    [
        'label'     => __( 'List Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-pricing-1-card .list-item' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'list_typography',
        'label'     => esc_html__( 'List Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-pricing-1-card .list-item',
    ]
);

// BORDER COLORS
$this->add_control(
    'border_color',
    [
        'label'     => __( 'Border Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-pricing-1-card .disc' => 'border-color: {{VALUE}};',
            '{{WRAPPER}} .fti-pricing-1-card .list' => 'border-color: {{VALUE}};',
        ],
    ]
);

// end
$this->end_controls_section();