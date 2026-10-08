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

// BOX WRAPPER PADDING
$this->add_responsive_control(
    'box_padding',
    [
        'label'      => __( 'Padding', 'indsro-core' ),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', 'em', '%' ],
        'selectors'  => [
            '{{WRAPPER}} .fti-footer-3-action .action-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

// enable border
$this->add_control(
    'enable_border',
    [
        'label'        => __( 'Enable Border', 'indsro-core' ),
        'type'         => Controls_Manager::SWITCHER,
        'label_on'     => __( 'Yes', 'indsro-core' ),
        'label_off'    => __( 'No', 'indsro-core' ),
        'return_value' => 'yes',
        'default'      => 'yes',
    ]
);

// BOX BORDER
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name'     => 'box_border',
        'label'    => __( 'Border', 'indsro-core' ),
        'types'    => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .border-left::after',
        'condition' => [
            'enable_border' => 'yes',
        ],
    ]
);


// END
$this->end_controls_section();