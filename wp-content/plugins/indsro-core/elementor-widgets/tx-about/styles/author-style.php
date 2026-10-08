<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_author',
    [
        'label' => __( 'AUTHOR STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// author count color
$this->add_control(
    'author_count_color',
    [
        'label'     => __( 'Author: Firstname Lastname Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-right .bottom-content .customer .number' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'author_count_typography',
        'label'     => esc_html__( 'Author: Firstname Lastname Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-about-1-right .bottom-content .customer .number',
    ]
);

// author count title
$this->add_control(
    'author_count_title_color',
    [
        'label'     => __( 'Author: Firstname Lastname Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-about-1-right .fti-para-1' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'author_count_title_typography',
        'label'     => esc_html__( 'Author: Firstname Lastname Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-about-1-right .fti-para-1',
    ]
);

// end
$this->end_controls_section();