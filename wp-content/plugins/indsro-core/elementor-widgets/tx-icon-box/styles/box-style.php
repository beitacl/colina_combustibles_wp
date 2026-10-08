<?php

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;

// box style
$this->start_controls_section(
    '_section_style_box',
    [
        'label' => __( 'Box Style', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// box background
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'box_background',
        'label'    => __( 'Background', 'indsro-core' ),
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .txIcon-box',
    ]
);

// END
$this->end_controls_section();