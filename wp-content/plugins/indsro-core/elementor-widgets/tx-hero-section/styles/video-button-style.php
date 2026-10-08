<?php
use Elementor\Controls_Manager;

// video button style
$this->start_controls_section(
    '_section_style_video_button',
    [
        'label' => __( 'VIDEO BUTTON STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// button color
$this->add_control(
    'video_button_color',
    [
        'label'     => __( 'Button Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .chy-plybtn-3 .text' => 'color: {{VALUE}};',
        ],
    ]
);

// end
$this->end_controls_section();