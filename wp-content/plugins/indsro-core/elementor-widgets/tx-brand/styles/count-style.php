<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;

// Brand style
$this->start_controls_section(
    '_section_style_count_',
    [
        'label' => __( 'COUNT STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);


// brand bg color
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'count_bg_color',
        'label'    => __( 'Background', 'indsro-core' ),
        'types'    => ['classic', 'gradient'],
        'exclude' => ['image'],
        'selector' => '
            {{WRAPPER}} .chy-brand-logo-4-counter
        ',
    ]
);

// end
$this->end_controls_section();