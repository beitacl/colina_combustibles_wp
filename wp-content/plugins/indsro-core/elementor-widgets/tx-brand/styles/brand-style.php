<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;

// Brand style
$this->start_controls_section(
    '_section_style_brand',
    [
        'label' => __( 'BRAND STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'brand_bg_color',
        'label'    => __( 'Gradient Background', 'indsro-core' ),
        'types'    => ['gradient'],
        'exclude'  => ['image', 'video'],
        'selector' => '.chy-brand-logo-4-item',
    ]
);

// end
$this->end_controls_section();