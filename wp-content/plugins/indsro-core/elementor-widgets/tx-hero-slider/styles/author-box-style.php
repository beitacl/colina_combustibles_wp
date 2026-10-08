<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_author_box',
    [
        'label' => __( 'AUTHOR STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => [
            'design_style' => 'style_4'
        ]
    ]
);

// author box bg color
$this->add_control(
    'author_box_bg_color',
    [
        'label'     => __( 'Background Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-hero-1-area fix' => 'background: {{VALUE}};',
        ],
    ]
);

// author text color
$this->add_control(
    'author_text_color',
    [
        'label'     => __( 'Text Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-hero-1-content .blockquite-text' => 'color: {{VALUE}};',
        ],
    ]
);

// author typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'author_typography',
        'label'     => __( 'Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-hero-1-content .blockquite-text',
    ]
);

// END
$this->end_controls_section();