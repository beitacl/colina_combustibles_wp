<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_call_info',
    [
        'label' => __( 'CALL INFO STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// CALL ICON COLOR
$this->add_control(
    'call_icon_color',
    [
        'label'     => __( 'Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-cta-1-wrap .cta-action .contact-wrap .icon-1' => 'color: {{VALUE}};',
        ],
    ]
);

// ICON SIZE
$this->add_control(
    'call_icon_size',
    [
        'label'     => __( 'Icon Size', 'indsro-core' ),
        'type'      => Controls_Manager::NUMBER,
        'selectors' => [
            '{{WRAPPER}} .fti-cta-1-wrap .cta-action .contact-wrap .icon-1' => 'font-size: {{VALUE}}px;',
        ],
    ]
);

// LABLE COLOR
$this->add_control(
    'call_label_color',
    [
        'label'     => __( 'Label Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-cta-1-wrap .cta-action .contact-wrap .icon-1' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'call_label_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .fti-cta-1-wrap .cta-action .contact-wrap .icon-1',
    ]
);

// NUMBER COLOR
$this->add_control(
    'call_number_color',
    [
        'label'     => __( 'Number Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-cta-1-wrap .cta-action .contact-wrap .call-link' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'call_number_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .fti-cta-1-wrap .cta-action .contact-wrap .call-link',
    ]
);


// end
$this->end_controls_section();