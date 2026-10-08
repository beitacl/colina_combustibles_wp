<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_service_style',
    [
        'label' => __( 'SERVICE STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// service box bg color
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'service_box_bg_color',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .fti-services-1-item',
    ]
);

// box hover bg c9lor
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'service_box_bg_color_hover',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .fti-services-1-item:hover',
    ]
);

// CAT COLOR
$this->add_control(
    'service_cat_color',
    [
        'label'     => __( 'Cat Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-project-1-item .project-title-wrap .project-subtitle' => 'color: {{VALUE}};',
        ],
        'condition' => [
            'design_style' => 'style_4'
        ]
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'service_cat_typography',
        'label'     => esc_html__( 'Cat Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-project-1-item .project-title-wrap .project-subtitle',
        'condition' => [
            'design_style' => 'style_4'
        ]
    ]
);

// title color
$this->add_control(
    'service_title_color',
    [
        'label'     => __( 'Title Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-services-1-item .title' => 'color: {{VALUE}};',
            '{{WRAPPER}} .fti-project-1-item .project-title-wrap .project-title' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'service_title_typography',
        'label'     => esc_html__( 'Title Typography', 'indsro-core' ),
        'selector'  => '
        {{WRAPPER}} .fti-services-1-item .title,
        {{WRAPPER}} .fti-project-1-item .project-title-wrap .project-title
        ',
    ]
);

// content color
$this->add_control(
    'service_content_color',
    [
        'label'     => __( 'Content Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-para-1-small' => 'color: {{VALUE}};',
            '{{WRAPPER}} .fti-project-1-item .project-title-wrap .disc' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'service_content_typography',
        'label'     => esc_html__( 'Content Typography', 'indsro-core' ),
        'selector'  => '
        {{WRAPPER}} .fti-para-1-small,
        {{WRAPPER}} .fti-project-1-item .project-title-wrap .disc
        ',
    ]
);


// end
$this->end_controls_section();