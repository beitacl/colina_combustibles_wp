<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_testimonial',
    [
        'label' => __( 'TESTIMONIAL STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// qutoe icon oclor
$this->add_control(
    'quote_icon_color',
    [
        'label'     => __( 'Quote Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-testimonial-1-item .comment-wrap .icon-1' => 'color: {{VALUE}};',
        ],
    ]
);

// comment color
$this->add_control(
    'comment_color',
    [
        'label'     => __( 'Comment Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-testimonial-1-item .comment-text' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'comment_typography',
        'label'     => esc_html__( 'Comment Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-testimonial-1-item .comment-text',
    ]
);

// rating color
$this->add_control(
    'rating_color',
    [
        'label'     => __( 'Rating Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-testimonial-1-item .rating i' => 'color: {{VALUE}};',
        ],
    ]
);

// name color
$this->add_control(
    'name_color',
    [
        'label'     => __( 'Name Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-testimonial-1-item .name' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'name_typography',
        'label'     => esc_html__( 'Name Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-testimonial-1-item .name',
    ]
);

// designation color
$this->add_control(
    'designation_color',
    [
        'label'     => __( 'Designation Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-testimonial-1-item .bio' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'designation_typography',
        'label'     => esc_html__( 'Designation Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-testimonial-1-item .bio',
    ]
);

// end
$this->end_controls_section();