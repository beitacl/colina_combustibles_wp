<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

// CALL INFO STYLE
$this->start_controls_section(
    '_section_style_call_info',
    [
        'label' => __( 'Call Info', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// CALL INFO ICON COLOR
$this->add_control(
    'call_info_icon_color',
    [
        'label'     => __( 'Call Info Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .chy-call-2-icon i' => 'color: {{VALUE}};',
        ],
    ]
);

// CALL ICON BG COLOR
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'call_icon_bg_color',
        'label'    => __( 'Background Color', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'selector' => '
            {{WRAPPER}} .chy-call-2-icon
        ',
    ]
);

// CALL INFO LABEL COLOR
$this->add_control(
    'call_info_label_color',
    [
        'label'     => __( 'Call Info Label Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .chy-call-1-content .text' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'call_info_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .chy-call-1-content .text',
    ]
);

// CALL INFO TEXT COLOR
$this->add_control(
    'call_info_text_color',
    [
        'label'     => __( 'Call Info Text Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .chy-call-1-content .phone' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'call_info_text_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .chy-call-1-content .phone',
    ]
);

// END
$this->end_controls_section();