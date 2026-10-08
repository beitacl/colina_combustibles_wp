<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;


// VIDEO BUTTON STYLE
$this->start_controls_section(
    '_section_style_video_button',
    [
        'label' => __( 'VIDEO BUTTON STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// VIDEO ICON COLOR
$this->add_control(
    'video_icon_color',
    [
        'label'     => __( 'Video Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .chy-solutions-2-wrap .chy-plybtn-2' => 'color: {{VALUE}};',
        ],
    ]
);

// END
$this->end_controls_section();