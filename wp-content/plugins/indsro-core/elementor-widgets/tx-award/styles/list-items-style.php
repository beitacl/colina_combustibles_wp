<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// LIST ITEMS STYLE
$this->start_controls_section(
    '_section_style_list_items',
    [
        'label' => __( 'LIST ITEMS STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// list color
$this->add_control(
    'list_color',
    [
        'label'     => __( 'List Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-listsItems li' => 'color: {{VALUE}};',
            '{{WRAPPER}} .tx-listsItems a' => 'color: {{VALUE}};',
        ],
    ]
);

// list icon color
$this->add_control(
    'list_icon_color',
    [
        'label'     => __( 'List Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-listsItems i' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'list_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '
        {{WRAPPER}} .tx-listsItems li,
        {{WRAPPER}} .tx-listsItems a
        ',
    ]
);

// end
$this->end_controls_section();