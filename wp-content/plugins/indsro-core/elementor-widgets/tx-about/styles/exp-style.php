<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_exp',
    [
        'label' => __( 'EXPERIENCE STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// YEAR COLOR
$this->add_control(
    'year_color',
    [
        'label'     => esc_html__( 'Year Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-left .exper .number' => 'color: {{VALUE}}',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'year_typography',
        'label'     => esc_html__( 'Year Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-about-1-left .exper .number',
    ]
);

// EXP TITEL COLOR
$this->add_control(
    'exp_title_color',
    [
        'label'     => esc_html__( 'Experience Title Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-left .exper .title' => 'color: {{VALUE}}',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'exp_title_typography',
        'label'     => esc_html__( 'Experience Title Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-about-1-left .exper .title',
    ]
);

// END
$this->end_controls_section();