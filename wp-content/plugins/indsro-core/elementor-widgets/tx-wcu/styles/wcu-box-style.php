<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_wcu_box',
    [
        'label' => __( 'WCU BOX STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// wcu title color
$this->add_control(
    'wcu_title_color',
    [
        'label'     => __( 'Title Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-wcu-box .tx-wcu-title' => 'color: {{VALUE}};',
        ],
    ]
);

// end
$this->end_controls_section();