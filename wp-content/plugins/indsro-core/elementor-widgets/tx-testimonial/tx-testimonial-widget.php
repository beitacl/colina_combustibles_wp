<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Tx_Testimonial extends Element_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Indsro Core widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'tx_testimonial';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __( 'TX Testimonial', 'indsro-core' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.themexriver.com/widgets/gradient-heading/';
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'elh-widget-icon eicon-t-letter';
    }

    public function get_keywords() {
        return ['count', 'indsro', 'indsro testimonial', 'testimonial', 'indsro testimonial widget'];
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_choose_style',
            [
                'label' => __( 'CHOOSE DESIGN STYLE', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label'              => __( 'Design Style', 'indsro-core' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'style_1' => __( 'Style 1', 'indsro-core' ),
                    'style_2' => __( 'Style 2', 'indsro-core' ),
                    'style_3' => __( 'Style 3', 'indsro-core' ),
                    'style_4' => __( 'Style 4', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        // images
        $this->start_controls_section(
            '_section_images',
            [
                'label' => __( 'Images', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // IMAGE_1
        $this->add_control(
            'image_1',
            [
                'label'       => __( 'Image 1', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // END
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        // sub title
        $this->add_control(
            'sub_title',
            [
                'label'       => __( 'Sub Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Sub Title',
                'placeholder' => __( 'Sub Title Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_sub_title' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // AUTHOR BOX
        $this->start_controls_section(
            '_section_author_box',
            [
                'label' => __( 'Author Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        // enable author box
        $this->add_control(
            'enable_author_box',
            [
                'label'        => __( 'Enable Author Box', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // author image
        $this->add_control(
            'author_images',
            [
				'label' => esc_html__( 'Add Images', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
        );

        // author text
        $this->add_control(
            'author_text',
            [
                'label'       => __( 'Author Text', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your author text', 'indsro-core' ),
                'default'     => __( 'Author Text', 'indsro-core' ),
            ]
        );

        // END
        $this->end_controls_section();


        $this->start_controls_section(
            '_section_testimonial',
            [
                'label' => __( 'Testimonials', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3'],
                ],
            ]
        );

        // repeater
        $repeater = new Repeater();

        // design style
        $repeater->add_control(
            'design_style',
            [
                'label'              => __( 'Design Style', 'indsro-core' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'style_1' => __( 'Style 1', 'indsro-core' ),
                    'style_2' => __( 'Style 2', 'indsro-core' ),
                    'style_3' => __( 'Style 3', 'indsro-core' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $repeater->add_control(
            'author_image',
            [
                'label'     => __( 'Author Image', 'indsro-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_3'],
                ],
            ]
        );

        // content
        $repeater->add_control(
            'comment',
            [
                'label'       => __( 'Comment', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your content', 'indsro-core' ),
                'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'indsro-core' ),
            ]
        );

        // enable icon
        $repeater->add_control(
            'enable_icon',
            [
                'label'        => __( 'Enable Quote Icon', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // type
        $repeater->add_control(
            'type',
            [
                'label'          => __( 'Type', 'indsro-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'quote' => [
                        'title' => __( 'Quote', 'indsro-core' ),
                        'icon'  => 'fa fa-quote-left',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'indsro-core' ),
                        'icon'  => 'fa fa-image',
                    ],
                ],
                'default'        => 'quote',
                'toggle'         => false,
                'style_transfer' => true,
                'condition'      => [
                    'enable_icon' => 'yes',
                ],
            ]
        );

        // quote icon
        $repeater->add_control(
            'quote_icon',
            [
                'label'     => __( 'Quote Icon', 'indsro-core' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-quote-left',
                    'library' => 'solid',
                ],
                'condition' => [
                    'enable_icon' => 'yes',
                    'type'        => 'quote',
                ],
            ]
        );

        // quote image
        $repeater->add_control(
            'quote_image',
            [
                'label'       => __( 'Quote Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition'   => [
                    'type'        => 'image',
                    'enable_icon' => 'yes',
                ],
            ]
        );

        // name
        $repeater->add_control(
            'name',
            [
                'label'       => __( 'Name', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your name', 'indsro-core' ),
                'default'     => __( 'John Doe', 'indsro-core' ),
            ]
        );

        // designation
        $repeater->add_control(
            'designation',
            [
                'label'       => __( 'Designation', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your designation', 'indsro-core' ),
                'default'     => __( 'CEO', 'indsro-core' ),
            ]
        );

        // enable_rating
        $repeater->add_control(
            'enable_rating',
            [
                'label'        => __( 'Enable Rating', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'design_style' => ['style_3'],
                ],
            ]
        );

        // rating star
        $repeater->add_control(
            'rating_star',
            [
                'label'     => __( 'Rating Star', 'indsro-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1' => __( '1 Star', 'indsro-core' ),
                    '2' => __( '2 Star', 'indsro-core' ),
                    '3' => __( '3 Star', 'indsro-core' ),
                    '4' => __( '4 Star', 'indsro-core' ),
                    '5' => __( '5 Star', 'indsro-core' ),
                ],
                'default'   => '5',
                'condition' => [
                    'enable_rating' => 'yes',
                    'design_style' => ['style_3'],
                ],
            ]
        );


        $this->add_control(
            'testimonial_lists',
            [
                'label'       => __( 'Testimonial Lists', 'indsro-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // enable slide dots
        $this->add_control(
            'enable_slide_pagination',
            [
                'label'        => __( 'Enable Slide Pagination', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // ENABLE SUB TITLE
        $this->add_control(
            'enable_sub_title',
            [
                'label'        => __( 'Enable Sub Title', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        $this->end_controls_section();

        // TESTIMONIAL BOX
        $this->start_controls_section(
            '_section_testimonial_box',
            [
                'label' => __( 'Testimonial Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_4'],
                ],
            ]
        );

        // author image
        $this->add_control(
            'author_image',
            [
                'label'     => __( 'Author Image', 'indsro-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // content
        $this->add_control(
            'comment',
            [
                'label'       => __( 'Comment', 'indsro-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your content', 'indsro-core' ),
                'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'indsro-core' ),
            ]
        );

        // enable icon
        $this->add_control(
            'enable_quote_icon',
            [
                'label'        => __( 'Enable Quote Icon', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'indsro-core' ),
                'label_off'    => __( 'No', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // type
        $this->add_control(
            'type',
            [
                'label'          => __( 'Type', 'indsro-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'quote' => [
                        'title' => __( 'Quote', 'indsro-core' ),
                        'icon'  => 'fa fa-quote-left',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'indsro-core' ),
                        'icon'  => 'fa fa-image',
                    ],
                ],
                'default'        => 'quote',
                'toggle'         => false,
                'style_transfer' => true,
                'condition'      => [
                    'enable_quote_icon' => 'yes',
                ],
            ]
        );

        // quote icon
        $this->add_control(
            'quote_icon',
            [
                'label'     => __( 'Quote Icon', 'indsro-core' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-quote-left',
                    'library' => 'solid',
                ],
                'condition' => [
                    'enable_quote_icon' => 'yes',
                    'type'        => 'quote',
                ],
            ]
        );

        // quote image
        $this->add_control(
            'quote_image',
            [
                'label'       => __( 'Quote Image', 'indsro-core' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition'   => [
                    'type'        => 'image',
                    'enable_quote_icon' => 'yes',
                ],
            ]
        );

        // name
        $this->add_control(
            'name',
            [
                'label'       => __( 'Name', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your name', 'indsro-core' ),
                'default'     => __( 'John Doe', 'indsro-core' ),
            ]
        );

        // designation
        $this->add_control(
            'designation',
            [
                'label'       => __( 'Designation', 'indsro-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your designation', 'indsro-core' ),
                'default'     => __( 'CEO', 'indsro-core' ),
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls() {
        $dir = dirname( __FILE__ );

        $style_files = glob( $dir . '/styles/*.php' );

        if ( $style_files ) {
            foreach ( $style_files as $style_file ) {
                include $style_file;
            }
        }
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

        $style = !empty( $settings['design_style'] ) ? $settings['design_style'] : 'style_1';

        switch ( $style ) {
        case 'style_5':
            include $dir . '/views/view-5.php';
            break;
        case 'style_4':
            include $dir . '/views/view-4.php';
            break;
        case 'style_3':
            include $dir . '/views/view-3.php';
            break;
        case 'style_2':
            include $dir . '/views/view-2.php';
            break;
        default:
            include $dir . '/views/view-1.php';
        }
    }
}
