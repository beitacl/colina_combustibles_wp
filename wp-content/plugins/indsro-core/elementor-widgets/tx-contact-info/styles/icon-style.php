<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;


// ICON STYLE
$this->start_controls_section(
    '_section_style_icon',
    [
        'label' => __( 'Icon Style', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// ICON BG COLOR
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'icon_bg_color',
        'label'    => __( 'Icon Background', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'exclude'  => ['image', 'video'],
        'selector' => '{{WRAPPER}} .contact-page-contact-list .icon',
    ]
);

// ICON COLOR
$this->add_control(
    'icon_color',
    [
        'label'     => __( 'Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .contact-page-contact-list .icon' => 'color: {{VALUE}};',
        ],
    ]
);

// ICON SIZE
$this->add_responsive_control(
    'icon_size',
    [
        'label'      => __( 'Icon Size', 'indsro-core' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'selectors'  => [
            '{{WRAPPER}} .contact-page-contact-list .icon' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
    ]
);

// END
$this->end_controls_section();