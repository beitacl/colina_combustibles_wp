<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;


// HEADER STYLE
$this->start_controls_section(
    '_section_style_header',
    [
        'label' => __( 'Header', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// header height
$this->add_responsive_control(
    'header_height',
    [
        'label'      => __( 'Header Height', 'indsro-core' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range'      => [
            'px' => [
                'min' => 0,
                'max' => 200,
            ],
            '%'  => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'selectors'  => [
            '{{WRAPPER}} .fti-header-3-wrap' => 'height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

// ENABLE POSITION ABSOLUTE
$this->add_control(
    'enable_position_absolute',
    [
        'label'        => __( 'Enable Position Absolute', 'indsro-core' ),
        'type'         => Controls_Manager::SWITCHER,
        'label_on'     => __( 'Yes', 'indsro-core' ),
        'label_off'    => __( 'No', 'indsro-core' ),
        'return_value' => 'yes',
    ]
);

// HEADER TOP POSITION
$this->add_responsive_control(
    'header_top_position',
    [
        'label'      => __( 'Header Top Position', 'indsro-core' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range'      => [
            'px' => [
                'min' => 0,
                'max' => 200,
            ],
            '%'  => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'selectors'  => [
            '{{WRAPPER}} .tx-header' => 'top: {{SIZE}}{{UNIT}};',
        ],
        'condition'  => [
            'enable_position_absolute' => 'yes',
        ],
    ]
);

// caret count color
$this->add_control(
    'cart_count_color',
    [
        'label'     => __( 'Cart Count Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-cart-btn-1 .count' => 'color: {{VALUE}};',
        ],
    ]
);

// typ0graphy
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'     => 'header_typography',
        'label'    => __( 'Typography', 'indsro-core' ),
        'selector' => '{{WRAPPER}} .gly-cart-btn-1 .count',
    ]
);

// cart icon size
$this->add_control(
    'cart_icon_size',
    [
        'label'     => __( 'Cart Icon Size', 'indsro-core' ),
        'type'      => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range'     => [
            'px' => [
                'min' => 10,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .gly-cart-btn-1' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
    ]
);

// CART ICON COLOR
$this->add_control(
    'cart_icon_color',
    [
        'label'     => __( 'Cart Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-cart-btn-1' => 'color: {{VALUE}};',
        ],
    ]
);

// CART ICON HOVER COLOR
$this->add_control(
    'cart_icon_hover_color',
    [
        'label'     => __( 'Cart Icon Hover Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-cart-btn-1:hover' => 'color: {{VALUE}};',
        ],
    ]
);

// search icon size
$this->add_control(
    'search_icon_size',
    [
        'label'     => __( 'Search Icon Size', 'indsro-core' ),
        'type'      => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range'     => [
            'px' => [
                'min' => 10,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .gly-search-btn-1' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
    ]
);

// SEARCH ICON COLOR
$this->add_control(
    'search_icon_color',
    [
        'label'     => __( 'Search Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-search-btn-1' => 'color: {{VALUE}};',
        ],
    ]
);

// SEARCH ICON HOVER COLOR
$this->add_control(
    'search_icon_hover_color',
    [
        'label'     => __( 'Search Icon Hover Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-search-btn-1:hover' => 'color: {{VALUE}};',
        ],
    ]
);

// mobile hamburger icon size
$this->add_control(
    'mobile_hamburger_icon_size',
    [
        'label'     => __( 'Mobile Hamburger Icon Size', 'indsro-core' ),
        'type'      => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range'     => [
            'px' => [
                'min' => 10,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .gly-mobile-menu-btn-22' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

// MOBILE HAMBURGER ICON COLOR
$this->add_control(
    'mobile_hamburger_icon_color',
    [
        'label'     => __( 'Mobile Hamburger Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-mobile-menu-btn-2 span' => 'color: {{VALUE}};',
        ],
    ]
);

// MOBILE HAMBURGER ICON HOVER COLOR
$this->add_control(
    'mobile_hamburger_icon_hover_color',
    [
        'label'     => __( 'Mobile Hamburger Icon Hover Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-mobile-menu-btn-2:hover span' => 'color: {{VALUE}};',
        ],
    ]
);

// MOBILE HAMBURGER ICON bg color
$this->add_control(
    'mobile_hamburger_icon_bg_color',
    [
        'label'     => __( 'Mobile Hamburger Icon Background Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-mobile-menu-btn-2' => 'background-color: {{VALUE}};',
        ],
    ]
);

// MOBILE HAMBURGER ICON HOVER bg color
$this->add_control(
    'mobile_hamburger_icon_hover_bg_color',
    [
        'label'     => __( 'Mobile Hamburger Icon Hover Background Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gly-mobile-menu-btn-2:hover' => 'background-color: {{VALUE}};',
        ],
    ]
);

// END HEADER STYLE
$this->end_controls_section();
