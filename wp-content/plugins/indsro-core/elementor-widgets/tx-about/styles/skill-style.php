<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_skill',
    [
        'label' => __( 'SKILL STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// skill title color
$this->add_control(
    'skill_title_color',
    [
        'label'     => __( 'Skill Title Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-choose-1-right .choose-progress .choose-set-percent .title' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'skill_title_typography',
        'label'     => esc_html__( 'Skill Title Typography', 'indsro-core' ),
        'selector'  => '
            {{WRAPPER}} .fti-choose-1-right .choose-progress .choose-set-percent .title
        ',
    ]
);

// skill number color
$this->add_control(
    'skill_number_color',
    [
        'label'     => __( 'Skill Number Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-choose-1-right .choose-progress .choose-set-percent .progress span' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'skill_number_typography',
        'label'     => esc_html__( 'Skill Number Typography', 'indsro-core' ),
        'selector'  => '
            {{WRAPPER}} .fti-choose-1-right .choose-progress .choose-set-percent .progress span
        ',
    ]
);

// skill progress bg color
$this->add_control(
    'skill_progress_bg_color',
    [
        'label'     => __( 'Skill Progress BG Color', 'indsro-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-choose-1-right .choose-progress .choose-set-percent .progress-bar' => 'background-color: {{VALUE}};',
        ],
    ]
);

// end
$this->end_controls_section();