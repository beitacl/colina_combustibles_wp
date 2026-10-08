<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_section_style_blog',
    [
        'label' => __( 'BLOG STYLE', 'indsro-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]
);

// TITLE COLOR
$this->add_control(
    'title_color',
    [
        'label'     => __( 'Title Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-blog-1-card .content-wrap .blog-title' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'title_typography',
        'label'     => esc_html__( 'Title Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-blog-1-card .content-wrap .blog-title',
    ]
);

// META BOX COLOR
$this->add_control(
    'meta_box_color',
    [
        'label'     => __( 'Meta Box Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-blog-1-card .content-wrap .meta' => 'color: {{VALUE}};',
        ],
    ]
);

// MONTH BG COLOR
$this->add_control(
    'month_bg_color',
    [
        'label'     => __( 'Month BG Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-blog-1-card .content-wrap .meta .month' => 'background-color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'meta_typography',
        'label'     => esc_html__( 'Meta Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-blog-1-card .content-wrap .meta',
    ]
);

// DATE COLOR
$this->add_control(
    'date_color',
    [
        'label'     => __( 'Date Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-blog-1-card .content-wrap .meta .date' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'date_typography',
        'label'     => esc_html__( 'Date Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-blog-1-card .content-wrap .meta .date',
    ]
);

// YEAR COLOR
$this->add_control(
    'year_color',
    [
        'label'     => __( 'Year Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-blog-1-card .content-wrap .meta .year' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'year_typography',
        'label'     => esc_html__( 'Year Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-blog-1-card .content-wrap .meta .year',
    ]
);

// READ MORE TEXT COLOR
$this->add_control(
    'read_more_text_color',
    [
        'label'     => __( 'Read More Text Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-blog-1-card .content-wrap .blog-btn' => 'color: {{VALUE}};',
        ],
    ]
);

// TYPOGRAPHY
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'read_more_typography',
        'label'     => esc_html__( 'Read More Typography', 'indsro-core' ),
        'selector'  => '{{WRAPPER}} .fti-blog-1-card .content-wrap .blog-btn',
    ]
);

// BUTTON ICON COLOR
$this->add_control(
    'button_icon_color',
    [
        'label'     => __( 'Button Icon Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-blog-1-card .content-wrap .blog-btn .icon-1' => 'color: {{VALUE}};',
        ],
    ]
);

// BUTON BG COLOR
$this->add_control(
    'button_bg_color',
    [
        'label'     => __( 'Button BG Color', 'indsro-core' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .fti-blog-1-card .content-wrap .blog-btn:hover::before' => 'background-color: {{VALUE}};',
        ],
    ]
);

// end
$this->end_controls_section();