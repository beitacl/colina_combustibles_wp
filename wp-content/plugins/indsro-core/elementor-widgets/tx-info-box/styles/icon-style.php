<?php

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;

// icon style
$this->start_controls_section(
    '_section_style_icon',
    [
        'label' => __( 'ICON STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// icon bg color
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'icon_bg_color',
        'label'    => __( 'Background', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'exclude'  => ['image'],
        'selector' => '
            {{WRAPPER}} .service-icon
        ',
    ]
);

$this->add_control(
    'icon_bg_color_hover',
    [
        'label'     => esc_html__( 'Background Hover', 'Text-domain' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .log-service-item-1:hover .service-icon' => 'background-color: {{VALUE}};',
        ],
    ]
);

// end
$this->end_controls_section();