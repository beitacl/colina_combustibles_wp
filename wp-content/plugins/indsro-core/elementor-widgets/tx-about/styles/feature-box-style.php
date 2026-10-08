<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_feature_box',
    [
        'label' => __( 'FEATURE STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// FEATURE ICON COLOR
$this->add_control(
    'feature_icon_color',
    [
        'label'     => __( 'Feature Icon Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-right .features .feature .icon-1' => 'color: {{VALUE}};',
            '{{WRAPPER}} .fti-choose-1-left .choose-item .icon-1'       => 'color: {{VALUE}};',
        ],
    ]
);

// ICON BG COLOR
$this->add_control(
    'feature_icon_bg_color',
    [
        'label'     => __( 'Feature Icon Background Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-right .features .feature .icon-1' => 'background-color: {{VALUE}};',
        ],
    ]
);

// BORDER COLOR
$this->add_control(
    'feature_border_color',
    [
        'label'     => __( 'Feature Border Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-right .features .feature .icon-1' => 'border-color: {{VALUE}};',
        ],
    ]
);

// dot color
$this->add_control(
    'feature_dot_color',
    [
        'label'     => __( 'Feature Dot Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-right .features .feature .feature-divider' => 'border-color: {{VALUE}};',
        ],
    ]
);

// FEATURE TITLE COLOR
$this->add_control(
    'feature_title_color',
    [
        'label'     => __( 'Feature Title Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-right .features .feature .title'      => 'color: {{VALUE}};',
            '{{WRAPPER}} .fti-choose-1-left .choose-item-title-wrap .title' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'feature_title_typography',
        'label'    => esc_html__( 'Feature Title Typography', 'indsro-core' ),
        'selector' => '
            {{WRAPPER}} .fti-about-1-right .features .feature .title,
            {{WRAPPER}} .fti-choose-1-left .choose-item-title-wrap .title
        ',
    ]
);

// CONTENT COLOR
$this->add_control(
    'feature_content_color',
    [
        'label'     => __( 'Feature Content Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-right .features .feature .disc' => 'color: {{VALUE}};',
            '{{WRAPPER}} .fti-para-1-small'                           => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'feature_content_typography',
        'label'    => esc_html__( 'Feature Content Typography', 'indsro-core' ),
        'selector' => '
            {{WRAPPER}} .fti-about-1-right .features .feature .disc,
            {{WRAPPER}} .fti-para-1-small
        ',
    ]
);

// END
$this->end_controls_section();