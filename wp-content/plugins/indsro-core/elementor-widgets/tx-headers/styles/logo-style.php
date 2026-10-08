<?php

use Elementor\Controls_Manager;

// logo style
$this->start_controls_section(
    '_section_style_logo',
    [
        'label' => __( 'Logo Style', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// logo padding
$this->add_responsive_control(
    'logo_padding',
    [
        'label'      => __( 'Padding', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors'  => [
            '{{WRAPPER}} .tx-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

// logo margin
$this->add_responsive_control(
    'logo_margin',
    [
        'label'      => __( 'Margin', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors'  => [
            '{{WRAPPER}} .tx-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

// end
$this->end_controls_section();