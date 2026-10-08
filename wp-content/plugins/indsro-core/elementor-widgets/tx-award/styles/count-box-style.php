<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

// count box style
$this->start_controls_section(
    '_section_style_count_box',
    [
        'label' => __( 'COUNT BOX STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// count number color
$this->add_control(
    'count_number_color',
    [
        'label'     => __( 'Count Number Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .chy-solutions-2-counter .number' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'count_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '
        {{WRAPPER}} .chy-solutions-2-counter .number
        ',
    ]
);

// count text color
$this->add_control(
    'count_text_color',
    [
        'label'     => __( 'Count Text Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .chy-solutions-2-counter .disc' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'count_text_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '
        {{WRAPPER}} .chy-solutions-2-counter .disc
        ',
    ]
);

// count border color
$this->add_control(
    'count_border_color',
    [
        'label'     => __( 'Border Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .chy-solutions-2-counter' => 'border-color: {{VALUE}};',
        ],
    ]
);

// END
$this->end_controls_section();