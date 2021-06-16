<?php
namespace Listingoelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Listingo elementor hero section widget.
 *
 * @since 1.0
 */
class Listingo_Hero extends Widget_Base {

	public function get_name() {
		return 'listingo-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'listingo-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'listingo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'listingo-companion' ),
			]
        );
        $this->add_control(
            'sec_img',
            [
                'label' => esc_html__( 'Bg Image', 'listingo-companion' ),
                'description' => esc_html__( 'Best size is 1920x900', 'listingo-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'listingo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Find Nearby Attraction', 'listingo-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'listingo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Find Nearby Attraction', 'listingo-companion' ),
            ]
        );
        $this->add_control(
            'search_page',
            [
                'label' => esc_html__( 'Select Action Page', 'listingo-companion' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options'   => listingo_get_pages(),
            ]
        );
        $this->end_controls_section(); // End Hero content


    /**
     * Style Tab
     * ------------------------------ Style Title ------------------------------
     *
     */
        $this->start_controls_section(
			'style_title', [
				'label' => __( 'Style Hero Section', 'listingo-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_col', [
				'label' => __( 'Title Color', 'listingo-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
    
	protected function render() {
    $settings  = $this->get_settings();
    $sec_img   = !empty( $settings['sec_img']['url'] ) ? $settings['sec_img']['url'] : '';
    $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $search_page = !empty( $settings['search_page'] ) ? $settings['search_page'] : '';
    ?>

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider d-flex align-items-center" <?php echo listingo_inline_bg_img( esc_url( $sec_img ) ); ?>>
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-10">
                        <div class="slider_text text-center justify-content-center">
                            <?php 
                                if ( $sub_title ) { 
                                    echo '<p>'.esc_html( $sub_title ).'</p>';
                                }
                                if ( $sec_title ) { 
                                    echo '<h3>'.esc_html( $sec_title ).'</h3>';
                                }
                            ?>
                            <div class="search_form">
                                <form action="<?php echo get_page_link( $search_page ? $search_page : '' )?>">
                                    <div class="row align-items-center">
                                        <div class="col-xl-5 col-md-4">
                                            <div class="input_field">
                                                <input type="text" placeholder="What are you finding?">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="input_field location">
                                                <input type="text" placeholder="Location">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-4">
                                            <div class="button_search">
                                                <button class="boxed-btn2" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="quality">
                                <?php
                                    $taxonomies = listingo_get_taxonomies();
                                    if ( count($taxonomies) > 0 ) {
                                        ?>
                                        <ul>
                                            <?php
                                            foreach( $taxonomies as $tax_id => $taxonomy ) {
                                                // print_r($tax_id);
                                                $tax_term = get_term_by('id', $tax_id, 'listing_category');
                                                echo '
                                                <li><button>'.$tax_term->name.'</button></li>
                                                ';
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->
    <?php
    } 
}