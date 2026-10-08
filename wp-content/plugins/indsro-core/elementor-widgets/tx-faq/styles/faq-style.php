<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


$this->start_controls_section(
    'faq_style',
    [
        'label' => esc_html__('Faqs Style', 'indsro-core'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'faq_title_color',
    [
        'label' => esc_html__('Title Color', 'indsro-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .accordion-button' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'faq_title_typography',
        'label' => esc_html__('Typography', 'indsro-core'),
        'selector' => '{{WRAPPER}} .accordion-button',
    ]
);

// border color
$this->add_control(
    'faq_border_color',
    [
        'label' => esc_html__('Border Color', 'indsro-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .accordion-button' => 'border-color: {{VALUE}};',
        ],
    ]
);

// content text color
$this->add_control(
    'faq_content_color',
    [
        'label' => esc_html__('Content Color', 'indsro-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-para-1-small' => 'color: {{VALUE}};',
        ],
    ]
);

// typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'faq_typography',
        'label' => esc_html__('Typography', 'indsro-core'),
        'selector' => '{{WRAPPER}} .fti-para-1-small',
    ]
);

// active title color
$this->add_control(
    'faq_active_title_color',
    [
        'label' => esc_html__('Active Title Color', 'indsro-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-question-1-right .accordion .accordion-item .accordion-button:not(.collapsed)' => 'color: {{VALUE}};',
        ],
    ]
);

// active bg color
$this->add_control(
    'faq_active_bg_color',
    [
        'label' => esc_html__('Active BG Color', 'indsro-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-question-1-right .accordion .accordion-item .accordion-button:not(.collapsed)' => 'background-color: {{VALUE}};',
        ],
    ]
);

// right button bg color
$this->add_control(
    'faq_right_button_bg_color',
    [
        'label' => esc_html__('Right Button BG Color', 'indsro-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-question-1-right .accordion .accordion-item .accordion-button:not(.collapsed)' => 'background-color: {{VALUE}};',
        ],
    ]
);

// button icon colo
$this->add_control(
    'faq_button_icon_color',
    [
        'label' => esc_html__('Button Icon Color', 'indsro-core'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-question-1-right .accordion .accordion-item .accordion-button:not(.collapsed)' => 'color: {{VALUE}};',
        ],
    ]
);

// end
$this->end_controls_section();