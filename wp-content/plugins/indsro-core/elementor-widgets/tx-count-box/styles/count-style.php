<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// count style
$this->start_controls_section(
    '_section_count_style',
    [
        'label' => __( 'Count Style', 'indsro-core' ),
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
            '{{WRAPPER}} .tx-count .tx-counter' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}}; -webkit-text-stroke:2px {{VALUE}};',
            '{{WRAPPER}} .tx-count .number' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}}; -webkit-text-stroke:2px {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'count_number_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '
                    {{WRAPPER}} .tx-count .tx-counter
                ',
    ]
);

// count prefix color
$this->add_control(
    'count_prefix_color',
    [
        'label'     => __( 'Count Prefix Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-count .plus' => 'color: {{VALUE}};',
        ],
    ]
);

// count prefix typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'count_prefix_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .tx-count .plus',
    ]
);

// count title color
$this->add_control(
    'count_title_color',
    [
        'label'     => __( 'Count Title Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-count .tx-title' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'count_title_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .tx-count .tx-title',
    ]
);

// devider color
$this->add_control(
    'devider_color',
    [
        'label'     => __( 'Devider Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-capacity-3-item .capacity-divideer' => 'background-color: {{VALUE}};',
        ],
    ]
);


// end
$this->end_controls_section();