<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Tx_Trusted extends Element_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Indsro Core widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tx_trusted';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Tx Trusted', 'indsro-core' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.themexriver.com/widgets/icon-box/';
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'elh-widget-icon eicon-preview-medium';
    }

    public function get_keywords() {
        return [ 'shape', 'indsro'];
    }

    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __( 'Design Style', 'indsro-core' ),
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
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // title image 1
        $this->add_control(
            'title_image_1',
            [
                'label'   => __( 'Title Image 1', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // title image 2
        $this->add_control(
            'title_image_2',
            [
                'label'   => __( 'Title Image 2', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // TITLE 2
        $this->add_control(
            'title_2',
            [
                'label'       => __( 'Title 2', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // title image 3
        $this->add_control(
            'title_image_3',
            [
                'label'   => __( 'Title Image 3', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // title image 4
        $this->add_control(
            'title_image_4',
            [
                'label'   => __( 'Title Image 4', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();


        // VIDEO BOX
        $this->start_controls_section(
            '_section_video_box',
            [
                'label' => __( 'Video Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // VIDEO IMAGE
        $this->add_control(
            'video_image',
            [
                'label'   => __( 'Video Image', 'indsro-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // VIDEO LINK
        $this->add_control(
            'video_link',
            [
                'label'       => __( 'Video Link', 'indsro-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'indsro-core' ),
                'default'     => [
                    'url' => 'https://www.youtube.com/watch?v=e1edxTqJnKk&list=RDQM4DsffdYoWlY&start_radio=1',
                ],
            ]
        );

        // VIDEO BUTTON ICON
        $this->add_control(
            'video_button_icon',
            [
                'label'       => __( 'Video Button Icon', 'indsro-core' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'default'     => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // END
        $this->end_controls_section();

        // RATING BOX
        $this->start_controls_section(
            '_section_rating_box',
            [
                'label' => __( 'Rating Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // SELECT RATING
        $this->add_control(
            'select_rating',
            [
                'label'   => __( 'Select Rating', 'indsro-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1 Star', 'indsro-core' ),
                    '2' => __( '2 Star', 'indsro-core' ),
                    '3' => __( '3 Star', 'indsro-core' ),
                    '4' => __( '4 Star', 'indsro-core' ),
                    '5' => __( '5 Star', 'indsro-core' ),
                ],
                'default' => '5',
            ]
        );

        // RATING TEXT
        $this->add_control(
            'rating_text',
            [
                'label'       => __( 'Rating Text', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Rated 4.9/5 from over 600 Reviews',
                'placeholder' => __( 'Rating Text', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // END
        $this->end_controls_section();

        // TRAFFIC BOX
        $this->start_controls_section(
            '_section_traffic_box',
            [
                'label' => __( 'Traffic Box', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // TRAFFIC TITLE
        $this->add_control(
            'traffic_title',
            [
                'label'       => __( 'Traffic Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'rows'        => 4,
                'default'     => 'monthly traffic',
                'placeholder' => __( 'Traffic Title', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // TRAFFIC NUMBER
        $this->add_control(
            'traffic_number',
            [
                'label'       => __( 'Traffic Number', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'rows'        => 4,
                'default'     => '33.4',
                'placeholder' => __( 'Traffic Number', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // prefix
        $this->add_control(
            'traffic_number_prefix',
            [
                'label'       => __( 'Traffic Number Prefix', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => 'K',
                'placeholder' => __( 'Traffic Number Prefix', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // TRAFFIC PROGRESS TITLE
        $this->add_control(
            'traffic_progress_title',
            [
                'label'       => __( 'Traffic Progress Title', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'rows'        => 4,
                'default'     => 'monthly trafic',
                'placeholder' => __( 'Traffic Progress Title', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // TRAFFIC PROGRESS PERCENT
        $this->add_control(
            'traffic_progress_percent',
            [
                'label'       => __( 'Traffic Progress Percent', 'indsro-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'rows'        => 4,
                'default'     => '80%',
                'placeholder' => __( 'Traffic Progress Percent', 'indsro-core' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        // END
        $this->end_controls_section();

        // SETTINGS
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'indsro-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // ENABLE TITLE
        $this->add_control(
            'enable_title',
            [
                'label'        => __( 'Enable Title', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // ENABLE RATING BOX
        $this->add_control(
            'enable_rating_box',
            [
                'label'        => __( 'Enable Rating Box', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // ENABLE TRAFFIC BOX
        $this->add_control(
            'enable_traffic_box',
            [
                'label'        => __( 'Enable Traffic Box', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // enable video button
        $this->add_control(
            'enable_video_button',
            [
                'label'        => __( 'Enable Video Button', 'indsro-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'indsro-core' ),
                'label_off'    => __( 'Hide', 'indsro-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();



    }

    protected function register_style_controls() {

    }

    /**
     * Render widget output on the frontend.
     *
     * Used to generate the final HTML displayed on the frontend.
     *
     * Note that if skin is selected, it will be rendered by the skin itself,
     * not the widget.
     *
     * @since 1.0.0
     * @access public
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $dir = dirname( __FILE__ );

        $style = !empty($settings['design_style']) ? $settings['design_style'] : 'style_1';

        switch ($style) {
            case 'style_2':
                include $dir . '/views/view-2.php';
                break;
            default:
                include $dir . '/views/view-1.php';
        }
    }

}