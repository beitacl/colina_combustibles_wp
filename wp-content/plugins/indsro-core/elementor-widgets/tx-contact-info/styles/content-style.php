<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;

// CONTENT STYLE
$this->start_controls_section(
    '_section_style_content',
    [
        'label' => __( 'Content Style', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// CONTENT TITLE COLOR
$this->add_control(
    'content_title_color',
    [
        'label'     => __( 'Title Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-contactInfo .title' => 'color: {{VALUE}};',
            '{{WRAPPER}} .action-title' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'content_title_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '
        {{WRAPPER}} .tx-contactInfo .title,
        {{WRAPPER}} .action-title
        ',
    ]
);

// CONTENT DESCRIPTION COLOR
$this->add_control(
    'content_description_color',
    [
        'label'     => __( 'Description Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tx-contactInfo a' => 'color: {{VALUE}};',
            '{{WRAPPER}} .action-item a' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'content_description_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '
            {{WRAPPER}} .tx-contactInfo a,
            {{WRAPPER}} .action-item a
        ',
    ]
);

// END
$this->end_controls_section();