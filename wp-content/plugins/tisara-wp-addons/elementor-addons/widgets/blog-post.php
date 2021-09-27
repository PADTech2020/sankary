<?php
namespace ElementorTisara\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class KN_Blog_Post extends Widget_Base {

	public function get_name() {
		return 'kn_blog_post';
	}

	public function get_title() {
		return __( 'TS - Blog Post', 'tisara-wp-addons' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'tisara' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	public static function get_post_categories() {
		$categories = array( '' => __( '- All Categories -', 'tisara-wp-addons' ) );
		$terms = get_terms( array( 'taxonomy' => 'category' ) );
		
		if ( !empty($terms) ) {
			foreach ( $terms as $term ) {
				$categories[$term->slug] = $term->name;
			}
		}
		return $categories;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_posts',
			[
				'label' => __( 'Blog Post', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'category',
				[
					'label'		=> __( 'Category', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'options'	=> self::get_post_categories(),
				]
			);

			$options = array();
			for ($i=1; $i <=6; $i++) { 
				$options[$i] = $i;
			}

			$this->add_responsive_control(
				'columns',
				[
					'label'				=> __( 'Columns Per Row', 'tisara-wp-addons' ),
					'type'				=> Controls_Manager::SELECT,
					'desktop_default'	=> '3',
					'tablet_default' 	=> '2',
					'mobile_default' 	=> '1',
					'options' 			=> $options,
				]
			);
		
			for ($i=7; $i <=24; $i++) { 
				$options[$i] = $i;
			}

			$this->add_control(
				'per_page',
				[
					'label' 	=> __( 'Number of Posts', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> '6',
					'options' 	=> $options,
				]
			);

			$this->add_control(
				'sticky',
				[
					'label'			=> __( 'Hide Sticky Posts', 'tisara-wp-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'label_on'		=> __( 'show', 'tisara-wp-addons' ),
					'label_off'		=> __( 'hide', 'tisara-wp-addons' ),
					'return_value'	=> 1
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' 	=> __( 'Order By', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'date',
					'options'	=> [
						'date' 	=> __( 'Published Date', 'tisara-wp-addons' ),
						'title' => __( 'Title', 'tisara-wp-addons' ),
						'rand' 	=> __( 'Random', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'		=> __( 'Order', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'DESC',
					'options'	=> [
						'DESC'	=> __( 'DESC (high to low)', 'tisara-wp-addons' ),
						'ASC'	=> __( 'ASC (low to high)', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'readmore',
				[
					'label'			=> __( 'Read More Text', 'tisara-wp-addons' ),
					'type'			=> Controls_Manager::TEXT,
					'default'		=> __( 'Read More', 'tisara-wp-addons' ),
					'placeholder'	=> __( 'Read More', 'tisara-wp-addons' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_thumbnail',
			[
				'label'	=> __( 'Thumbnail', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'post_thumbnail',
				[
					'label'			=> __( 'Post Thumbnail', 'tisara-wp-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'default'		=> 'yes',
					'label_on'		=> __( 'yes', 'tisara-wp-addons' ),
					'label_off'		=> __( 'no', 'tisara-wp-addons' ),
					'return_value'	=> 'yes'
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'		=> 'image', // Actually its `image_size`
					'label'		=> __( 'Thumbnail Size', 'tisara-wp-addons' ),
					'default'	=> 'post-thumbnail',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination_options',
			[
				'label'     => __( 'Pagination', 'tisara-wp-addons' ),
				'condition' => [
					'carousel'	=> [ '' ]
				]
			]
		);

			$this->add_control(
				'pagination',
				[
					'label'	        => __( 'Show Pagination', 'tisara-wp-addons' ),
					'type'	        => Controls_Manager::SWITCHER,
					'label_on'	    => __( 'Yes', 'tisara-wp-addons' ),
					'label_off'	    => __( 'No', 'tisara-wp-addons' ),
					'return_value'	=> 'yes',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => __( 'Slider Options', 'tisara-wp-addons' ),
				'condition' => [
					'pagination' => [ '' ]
				]
			]
		);

			$this->add_control(
				'carousel',
				[
					'label'			=> __( 'Carousel', 'tisara-wp-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'label_on'		=> __( 'Yes', 'tisara-wp-addons' ),
					'label_off'		=> __( 'No', 'tisara-wp-addons' ),
					'return_value'	=> 'yes',
					'default'		=> 'no',
				]
			);

			$this->add_responsive_control(
				'slides_to_scroll',
				[
					'label'				=> __( 'Slides To Scroll', 'tisara-wp-addons' ),
					'type'				=> Controls_Manager::SELECT,
					'desktop_default'	=> '1',
					'tablet_default'	=> '1',
					'mobile_default'	=> '1',
					'options'			=> [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					],
				]
			);

			$this->add_control(
				'adaptive_height',
				[
					'label'		=> __( 'Adaptive Height', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'yes',
					'options'	=> [
						'yes'	=> __( 'Yes', 'tisara-wp-addons' ),
						'no'	=> __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'navigation',
				[
					'label'		=> __( 'Navigation', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'both',
					'options'	=> [
						'both'		=> __( 'Arrows and Dots', 'tisara-wp-addons' ),
						'arrows'	=> __( 'Arrows', 'tisara-wp-addons' ),
						'dots'		=> __( 'Dots', 'tisara-wp-addons' ),
						'none'		=> __( 'None', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'		=> __( 'Pause on Hover', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'yes',
					'options'	=> [
						'yes'	=> __( 'Yes', 'tisara-wp-addons' ),
						'no'	=> __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'		=> __( 'Autoplay', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'yes',
					'options'	=> [
						'yes'	=> __( 'Yes', 'tisara-wp-addons' ),
						'no'	=> __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'		=> __( 'Autoplay Speed', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::NUMBER,
					'default'	=> 5000,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'		=> __( 'Infinite Loop', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'yes',
					'options'	=> [
						'yes'	=> __( 'Yes', 'tisara-wp-addons' ),
						'no'	=> __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'effect',
				[
					'label'		=> __( 'Effect', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'slide',
					'options'	=> [
						'slide'	=> __( 'Slide', 'tisara-wp-addons' ),
						'fade'	=> __( 'Fade', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'speed',
				[
					'label'		=> __( 'Animation Speed', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::NUMBER,
					'default'	=> 500,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_posts',
			[
				'label'     => __( 'Posts Grid', 'tisara-wp-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'carousel'	=> [ '' ]
				]
			]
		);

			$this->add_control(
				'item_gap',
				[
					'label'		=> __( 'Item Gap', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SLIDER,
					'default'	=> [
						'size'	=> 10,
					],
					'range'		=> [
						'px'	=> [
							'min'	=> 0,
							'max'	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .kn-posts-grid' => 'margin: 0 -{{SIZE}}px',
						'(desktop){{WRAPPER}} .kn-posts-grid li' => 'width: calc( 100% / {{columns.SIZE}} ); padding: {{SIZE}}px',
						'(tablet){{WRAPPER}} .kn-posts-grid li' => 'width: calc( 100% / {{columns_tablet.SIZE}} ); padding: {{SIZE}}px',
						'(mobile){{WRAPPER}} .kn-posts-grid li' => 'width: calc( 100% / {{columns_mobile.SIZE}} ); padding: {{SIZE}}px',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label'	=> __( 'Post Title', 'tisara-wp-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'title_color',
				[
					'label'		=> __( 'Text Color', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .kn-posts-grid-wrapper li h4 a' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'title_typography',
					'label'		=> __( 'Typography', 'tisara-wp-addons' ),
					'scheme'	=> Scheme_Typography::TYPOGRAPHY_1,
					'selector'	=> '{{WRAPPER}} .kn-posts-grid-wrapper li h4 a',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_excerpt',
			[
				'label'	=> __( 'Post Excerpt', 'tisara-wp-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'excerpt_color',
				[
					'label'		=> __( 'Text Color', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .kn-posts-grid-wrapper li p' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'excerpt_typography',
					'label'		=> __( 'Typography', 'tisara-wp-addons' ),
					'scheme'	=> Scheme_Typography::TYPOGRAPHY_2,
					'selector'	=> '{{WRAPPER}} .kn-posts-grid-wrapper li p',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_readmore',
			[
				'label'	=> __( 'Read More Link', 'tisara-wp-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'readmore_color',
				[
					'label'		=> __( 'Text Color', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .kn-posts-grid-wrapper li .readmore' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'readmore_typography',
					'label'		=> __( 'Typography', 'tisara-wp-addons' ),
					'selector'	=> '{{WRAPPER}} .kn-posts-grid-wrapper li .readmore',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Slider / Navigation', 'tisara-wp-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'carousel'   => [ 'yes' ],
					'pagination' => [ '' ]
				]
			]
		);

			$this->add_control(
				'heading_style_arrows',
				[
					'label'     => __( 'Arrows', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'arrows_color',
				[
					'label'     => __( 'Arrows Color', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-posts-grid-wrapper .kn-blog-post-carousel .slick-prev:before, {{WRAPPER}} .kn-posts-grid-wrapper .kn-blog-post-carousel .slick-next:before' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'arrows_position',
				[
					'label'     => __( 'Arrows Position', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'outside',
					'options'   => [
						'inside'  => __( 'Inside', 'tisara-wp-addons' ),
						'outside' => __( 'Outside', 'tisara-wp-addons' ),
					],
					'condition' => [
						'navigation' => [ 'arrows', 'both' ],
					],
				]
			);

			$this->add_responsive_control(
				'arrows_size',
				[
					'label'     => __( 'Arrows Size', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 35,
					],
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .kn-posts-grid-wrapper .kn-blog-post-carousel .slick-prev:before, {{WRAPPER}} .kn-posts-grid-wrapper .kn-blog-post-carousel .slick-next:before' => 'font-size: {{SIZE}}px',
					],
				]
			);

			$this->add_control(
				'heading_style_dots',
				[
					'label'     => __( 'Dots', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'dots_color',
				[
					'label'     => __( 'Dots Color', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-posts-grid-wrapper .kn-blog-post-carousel ul.slick-dots li button:before' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'dots_active_color',
				[
					'label'     => __( 'Dots Color (active)', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-posts-grid-wrapper .kn-blog-post-carousel ul.slick-dots li.slick-active button:before' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'dots_position',
				[
					'label'		=> __( 'Dots Position', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::SELECT,
					'default'	=> 'outside',
					'options'	=> [
						'outside'	=> __( 'Outside', 'tisara-wp-addons' ),
						'inside'	=> __( 'Inside', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'navigation'	=> [ 'dots', 'both' ],
					],
				]
			);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings();

		$columns 	= absint( $settings['columns'] ) > 0 ? absint( $settings['columns'] ) : 3;
		$per_page 	= absint( $settings['per_page'] ) > 0 ? absint( $settings['per_page'] ) : 6;
		$orderby 	= $settings['orderby'] ? $settings['orderby'] : 'date';
		$order 		= $settings['order'] ? $settings['order'] : 'DESC';
		$sticky 	= $settings['sticky'] ? 0 : 1;

		$args = array( 
			'post_type'				=> 'post',
			'posts_per_page' 		=> $per_page,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts'	=> $sticky,
			'post_status'			=> 'publish'
		);
		if ( $settings['category'] ) {
			$args['category_name'] = $settings['category'];
		}

		if ( $settings['pagination'] == 'yes' ) {
			$page = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
			$offset = ( $page - 1 ) * $per_page;

			$args['paged'] = $page;
			$args['offset'] = $offset;
		}

		$thumbnail = [];

		if ( isset($settings['image_size']) && $settings['image_size'] ) {
			$thumbnail['image_size'] = $settings['image_size'];
		}
		else {
			$thumbnail['image_size'] = 'post-thumbnail';
		}

		if ( isset($settings['image_custom_dimension']) ) {
			$thumbnail['image_custom_dimension'] = $settings['image_custom_dimension'];
		}

		$this->add_render_attribute( 'wrapper', 'class', 'kn-posts-grid-wrapper' );
		$this->add_render_attribute( 'wrapper', 'class', 'grid-columns-' . $columns );

		if ( $settings['pagination'] !== 'yes' ) {
			$carousel_options = [
				'slides_to_show_desktop' 	=> $settings['columns'],
				'slides_to_show_tablet'		=> $settings['columns_tablet'],
				'slides_to_show_mobile'		=> $settings['columns_mobile'],
				'slides_to_scroll_desktop'	=> $settings['slides_to_scroll'],
				'slides_to_scroll_tablet'	=> $settings['slides_to_scroll_tablet'],
				'slides_to_scroll_mobile'	=> $settings['slides_to_scroll_mobile'],
				'adaptiveHeight' 			=> ( 'no' !== $settings['adaptive_height'] ? true : false ),
				'adaptiveHeight' 			=> ( 'no' !== $settings['adaptive_height'] ? true : false ),
				'autoplaySpeed' 			=> absint( $settings['autoplay_speed'] ),
				'autoplay' 					=> ( 'no' !== $settings['autoplay'] ? true : false ),
				'infinite' 					=> ( 'no' !== $settings['infinite'] ? true : false ),
				'pauseOnHover' 				=> ( 'no' !== $settings['pause_on_hover'] ? true : false ),
				'speed' 					=> absint( $settings['speed'] ),
				'arrows' 					=> ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ? true : false ),
				'dots' 						=> ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ? true : false ),
				'fade' 						=> ( 'fade' == $settings['effect'] ? true : false ),
				'rtl' 						=> ( is_rtl() ? true : false ),
			];

			$carousel_classes = [];

			if ( $settings['carousel'] == 'yes' ) {

				$carousel_classes[] = 'kn-blog-post-carousel';

				if ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ) {
					$carousel_classes[] = 'slick-arrows-' . $settings['arrows_position'];
				}

				if ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ) {
					$carousel_classes[] = 'slick-dots-' . $settings['dots_position'];
				}

			}

			if ( $settings['carousel'] == "yes" ) {
				$this->add_render_attribute( 'wrapper', 'class', 'elementor-slick-slider' );
			}

			$this->add_render_attribute( 'carousel', ['class' => $carousel_classes] );

			if ( $settings['carousel'] == "yes" ) {
				$this->add_render_attribute( 'carousel', ['data-slider_options' => wp_json_encode( $carousel_options )] );
			}
		}
		if ( $settings['carousel'] !== "yes" ) {
			$this->add_render_attribute( 'carousel', 'class', 'clearfix' );
			$this->add_render_attribute( 'carousel', 'class', 'kn-posts-grid' );
		}

		$the_query = new \WP_Query( $args );
		if ( $the_query->have_posts() ) : ?>

			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<ul <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
				
					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>
						
						<li>
							<?php if ( has_post_thumbnail() && "yes" == $settings['post_thumbnail'] ) : ?>
								<a href="<?php echo get_permalink(); ?>" title="">
								<?php $thumbnail['image'] = [ 'id' => get_post_thumbnail_id() ]; ?>
								<?php echo Group_Control_Image_Size::get_attachment_image_html( $thumbnail ); ?>
								</a>
							<?php endif; ?>
							
							<?php the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
							
							<?php
							$excerpt = wp_trim_words( get_the_excerpt(), 25, '&hellip;' );
							$excerpt = strip_tags( $excerpt );
							if ( $excerpt ) : ?>
								<p><?php echo $excerpt; ?></p>
							<?php endif; ?>

							<?php if ( $settings['readmore'] ) : ?>
								<a class="readmore" href="<?php echo get_permalink(); ?>"><?php echo $settings['readmore']; ?></a>
							<?php endif; ?>
						</li>
					
					<?php endwhile; ?>
			
				</ul>
			</div>
			<?php
			if ( $settings['pagination'] == 'yes' ) {

				echo '<nav class="pagination">';
					echo paginate_links( array(
						'base'					=> str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
						'format'				=> '?paged=%#%',
						'current'				=> max( 1, get_query_var('paged') ),
						'total'					=> $the_query->max_num_pages,
						'prev_text'				=> esc_html__( 'Prev' , 'tisara-wp-addons' ),
						'next_text'				=> esc_html__( 'Next' , 'tisara-wp-addons' ),
						'before_page_number' 	=> '',
						'after_page_number'  	=> ''
					) );
				echo '</nav>';
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		endif;

	}

	protected function _content_template() {
	}
}
