<?php
/**
 * Theme widgets
 *
 * @package Magazine_Power
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'magazine_power_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_load_widgets() {
		// Social widget.
		register_widget( 'Magazine_Power_Social_Widget' );

		// Featured Page widget.
		register_widget( 'Magazine_Power_Featured_Page_Widget' );

		// Latest News widget.
		register_widget( 'Magazine_Power_Latest_News_Widget' );

		// Recent Posts widget.
		register_widget( 'Magazine_Power_Recent_Posts_Widget' );

		// News Block widget.
		register_widget( 'Magazine_Power_News_Block_Widget' );

		// News Slider widget.
		register_widget( 'Magazine_Power_News_Slider_Widget' );

		// Tabbed widget.
		register_widget( 'Magazine_Power_Tabbed_Widget' );

		// Categorized News widget.
		register_widget( 'Magazine_Power_Categorized_News_Widget' );
	}

endif;

add_action( 'widgets_init', 'magazine_power_load_widgets' );

if ( ! class_exists( 'Magazine_Power_Social_Widget' ) ) :

	/**
	 * Social Widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Power_Social_Widget extends Magazine_Power_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$opts = array(
				'classname'                   => 'magazine_power_widget_social',
				'description'                 => esc_html__( 'Displays social icons.', 'magazine-power' ),
				'customize_selective_refresh' => true,
			);

			$fields = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'magazine-power' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
			);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => esc_html__( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'magazine-power' ),
					'type'  => 'message',
					'class' => 'widefat',
				);
			}

			parent::__construct( 'magazine-power-social', esc_html__( 'MP: Social', 'magazine-power' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'container'      => false,
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					)
				);
			}

			echo $args['after_widget'];
		}
	}

endif;

if ( ! class_exists( 'Magazine_Power_Featured_Page_Widget' ) ) :

	/**
	 * Featured Page Widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Power_Featured_Page_Widget extends Magazine_Power_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$opts = array(
				'classname'                   => 'magazine_power_widget_featured_page',
				'description'                 => esc_html__( 'Displays single featured Page or Post.', 'magazine-power' ),
				'customize_selective_refresh' => true,
			);

			$fields = array(
				'title'                    => array(
					'label' => esc_html__( 'Title:', 'magazine-power' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'featured_page'            => array(
					'label'            => esc_html__( 'Select Page:', 'magazine-power' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'magazine-power' ),
				),
				'content_type'             => array(
					'label'   => esc_html__( 'Show Content:', 'magazine-power' ),
					'type'    => 'select',
					'default' => 'full',
					'options' => array(
						'excerpt' => esc_html__( 'Excerpt', 'magazine-power' ),
						'full'    => esc_html__( 'Full', 'magazine-power' ),
					),
				),
				'excerpt_length'           => array(
					'label'       => esc_html__( 'Excerpt Length:', 'magazine-power' ),
					'description' => esc_html__( 'Applies when Excerpt is selected in Content option.', 'magazine-power' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 40,
					'min'         => 1,
					'max'         => 400,
				),
				'featured_image'           => array(
					'label'   => esc_html__( 'Featured Image:', 'magazine-power' ),
					'type'    => 'select',
					'options' => magazine_power_get_image_sizes_options(),
				),
				'featured_image_alignment' => array(
					'label'   => esc_html__( 'Image Alignment:', 'magazine-power' ),
					'type'    => 'select',
					'default' => 'center',
					'options' => magazine_power_get_image_alignment_options(),
				),
			);

			parent::__construct( 'magazine-power-featured-page', esc_html__( 'MP: Featured Page', 'magazine-power' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			?>

			<?php if ( absint( $params['featured_page'] ) > 0 ) : ?>

				<?php
				$qargs = array(
					'p'              => absint( $params['featured_page'] ),
					'posts_per_page' => 1,
					'no_found_rows'  => true,
					'post_type'      => 'page',
				);

				$the_query = new WP_Query( $qargs );
				?>

				<?php if ( $the_query->have_posts() ) : ?>

					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>

						<div class="featured-page-widget entry-content">
							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( esc_attr( $params['featured_image'] ), array( 'class' => 'align' . esc_attr( $params['featured_image_alignment'] ) ) ); ?></a>
							<?php endif; ?>
							<?php if ( 'excerpt' === $params['content_type'] ) : ?>
								<?php
								$excerpt = magazine_power_the_excerpt( absint( $params['excerpt_length'] ) );
								echo wp_kses_post( wpautop( $excerpt ) );
								?>
							<?php else : ?>
								<?php the_content(); ?>
							<?php endif; ?>

						</div><!-- .featured-page-widget -->

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				<?php endif; // End if have_posts(). ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];
		}
	}

endif;

if ( ! class_exists( 'Magazine_Power_Latest_News_Widget' ) ) :

	/**
	 * Latest News Widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Power_Latest_News_Widget extends Magazine_Power_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$opts = array(
				'classname'                   => 'magazine_power_widget_latest_news',
				'description'                 => esc_html__( 'Displays latest posts in grid.', 'magazine-power' ),
				'customize_selective_refresh' => true,
			);

			$fields = array(
				'title'          => array(
					'label' => esc_html__( 'Title:', 'magazine-power' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'post_category'  => array(
					'label'           => esc_html__( 'Select Category:', 'magazine-power' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'magazine-power' ),
				),
				'post_layout'    => array(
					'label'    => esc_html__( 'Post Layout:', 'magazine-power' ),
					'type'     => 'select',
					'default'  => 1,
					'adjacent' => true,
					'options'  => magazine_power_get_numbers_dropdown_options( 1, 2, esc_html__( 'Layout', 'magazine-power' ) . ' ' ),
				),
				'post_number'    => array(
					'label'   => esc_html__( 'Number of Posts:', 'magazine-power' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 10,
				),
				'post_column'    => array(
					'label'   => esc_html__( 'Number of Columns:', 'magazine-power' ),
					'type'    => 'select',
					'default' => 2,
					'options' => magazine_power_get_numbers_dropdown_options( 1, 4 ),
				),
				'featured_image' => array(
					'label'   => esc_html__( 'Featured Image:', 'magazine-power' ),
					'type'    => 'select',
					'default' => 'magazine-power-thumb',
					'options' => magazine_power_get_image_sizes_options(),
				),
				'excerpt_length' => array(
					'label'       => esc_html__( 'Excerpt Length:', 'magazine-power' ),
					'description' => esc_html__( 'in words', 'magazine-power' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 20,
					'min'         => 0,
					'max'         => 200,
				),
			);

			parent::__construct( 'magazine-power-latest-news', esc_html__( 'MP: Latest News', 'magazine-power' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page'      => absint( $params['post_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);

			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}

			$the_query = new WP_Query( $qargs );
			?>

			<?php if ( $the_query->have_posts() ) : ?>

				<div class="latest-news-widget latest-news-layout-<?php echo esc_attr( $params['post_layout'] ); ?> latest-news-col-<?php echo esc_attr( $params['post_column'] ); ?>">

					<div class="inner-wrapper">

						<?php
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							?>

							<div class="latest-news-item">
							<div class="latest-news-inner">
								<?php if ( 'disable' !== $params['featured_image'] ) : ?>
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="latest-news-thumb">
											<a class="images-zoom" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( esc_attr( $params['featured_image'] ) ); ?>
											</a>
										</div><!-- .latest-news-thumb -->
									<?php else : ?>
										<div class="latest-news-thumb">
											<a class="images-zoom" href="<?php the_permalink(); ?>">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image-large.png' ); ?>" alt="<?php esc_attr_e( 'No Image', 'magazine-power' ); ?>" />
											</a>
										</div><!-- .latest-news-thumb -->
									<?php endif; ?>
								<?php endif; ?>
								<div class="latest-news-text-wrap">

									<div class="latest-news-text-content">
										<h3 class="latest-news-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3><!-- .latest-news-title -->
									</div><!-- .latest-news-text-content -->

									<div class="latest-news-meta entry-meta">
											<span class="posted-on"><?php the_time( 'j M Y' ); ?></span>
											<?php
											if ( comments_open( get_the_ID() ) ) {
												echo '<span class="comments-link">';
												comments_popup_link( '0', '1', '%' );
												echo '</span>';
											}
											?>
									</div><!-- .latest-news-meta -->

									<?php if ( absint( $params['excerpt_length'] ) > 0 ) : ?>
										<div class="latest-news-excerpt">
											<?php
											$excerpt = magazine_power_the_excerpt( absint( $params['excerpt_length'] ) );
											echo wp_kses_post( wpautop( $excerpt ) );
											?>
											<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Read More', 'magazine-power' ); ?></a>
										</div><!-- .latest-news-excerpt -->
									<?php endif; ?>

								</div><!-- .latest-news-text-wrap -->
								</div><!-- .latest-news-inner -->
							</div><!-- .latest-news-item -->

						<?php endwhile; ?>

					</div><!-- .inner-wrapper -->

				</div><!-- .latest-news-widget -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];
		}
	}

endif;

if ( ! class_exists( 'Magazine_Power_Recent_Posts_Widget' ) ) :

	/**
	 * Recent Posts Widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Power_Recent_Posts_Widget extends Magazine_Power_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$opts = array(
				'classname'                   => 'magazine_power_widget_recent_posts',
				'description'                 => esc_html__( 'Displays recent posts.', 'magazine-power' ),
				'customize_selective_refresh' => true,
			);

			$fields = array(
				'title'          => array(
					'label' => esc_html__( 'Title:', 'magazine-power' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'post_category'  => array(
					'label'           => esc_html__( 'Select Category:', 'magazine-power' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'magazine-power' ),
				),
				'post_number'    => array(
					'label'   => esc_html__( 'Number of Posts:', 'magazine-power' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
				),
				'featured_image' => array(
					'label'   => esc_html__( 'Featured Image:', 'magazine-power' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'options' => magazine_power_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
				),
				'image_width'    => array(
					'label'       => esc_html__( 'Image Width:', 'magazine-power' ),
					'type'        => 'number',
					'description' => esc_html__( 'px', 'magazine-power' ),
					'css'         => 'max-width:60px;',
					'adjacent'    => true,
					'default'     => 80,
					'min'         => 1,
					'max'         => 150,
				),
				'disable_date'   => array(
					'label'   => esc_html__( 'Disable Date', 'magazine-power' ),
					'type'    => 'checkbox',
					'default' => false,
				),
			);

			parent::__construct( 'magazine-power-recent-posts', esc_html__( 'MP: Recent Posts', 'magazine-power' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page'      => absint( $params['post_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);

			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}

			$the_query = new WP_Query( $qargs );
			?>
			<?php if ( $the_query->have_posts() ) : ?>

				<div class="recent-posts-wrapper">

					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>

						<div class="recent-posts-item">

							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
								<div class="recent-posts-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . esc_attr( $params['image_width'] ) . 'px;',
										);
										the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
										?>
									</a>
								</div><!-- .recent-posts-thumb -->
							<?php endif ?>
							<div class="recent-posts-text-wrap">
								<h3 class="recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

								<?php if ( false === $params['disable_date'] ) : ?>
									<div class="recent-posts-meta entry-meta">

										<?php if ( false === $params['disable_date'] ) : ?>
											<span class="posted-on"><?php the_time( 'j M Y' ); ?></span><!-- .recent-posts-date -->
										<?php endif; ?>

									</div><!-- .recent-posts-meta -->
								<?php endif; ?>

							</div><!-- .recent-posts-text-wrap -->

						</div><!-- .recent-posts-item -->

					<?php endwhile; ?>

				</div><!-- .recent-posts-wrapper -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];
		}
	}

endif;

if ( ! class_exists( 'Magazine_Power_News_Block_Widget' ) ) :

	/**
	 * News Block Widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Power_News_Block_Widget extends Magazine_Power_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$opts = array(
				'classname'                   => 'magazine_power_widget_news_block',
				'description'                 => esc_html__( 'Displays news block.', 'magazine-power' ),
				'customize_selective_refresh' => true,
			);

			$fields = array(
				'title'         => array(
					'label' => esc_html__( 'Title:', 'magazine-power' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'post_category' => array(
					'label'           => esc_html__( 'Select Category:', 'magazine-power' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'magazine-power' ),
				),
			);

			parent::__construct( 'magazine-power-news-block', esc_html__( 'MP: News Block', 'magazine-power' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page'      => 5,
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);

			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}

			$the_query = new WP_Query( $qargs );

			?>
			<?php if ( $the_query->have_posts() ) : ?>

				<div class="news-block-widget">
					<div class="inner-wrapper">

						<?php
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							?>

							<?php
							$current_count = $the_query->current_post;
							$is_special    = ( $current_count < 2 ) ? true : false;

							$extra_class = ( true === $is_special ) ? 'item-half' : '';
							?>
							<div class="block-item <?php echo esc_attr( $extra_class ); ?>">
								<div class="block-item-inner">
									<div class="block-item-thumb">
										<a class="images-zoom" href="<?php the_permalink(); ?>">
											<?php if ( has_post_thumbnail() ) : ?>
												<?php the_post_thumbnail( 'magazine-power-large' ); ?>
											<?php else : ?>
												<img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image-large.png' ); ?>" alt="<?php esc_attr_e( 'No Image', 'magazine-power' ); ?>" />
											<?php endif; ?>
										</a>
									</div><!-- .block-item-thumb -->
								<div class="block-content">
									<?php
									$category = magazine_power_get_single_post_category( get_the_ID() );
									?>
									<?php if ( ! empty( $category ) ) : ?>
										<span class="cat-links"><a href="<?php echo esc_url( $category['url'] ); ?>"><?php echo esc_html( $category['name'] ); ?></a></span>
									<?php endif; ?>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="entry-meta">
										<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
										<?php
										if ( comments_open( get_the_ID() ) ) {
											echo '<span class="comments-link">';
											comments_popup_link( '0', '1', '%' );
											echo '</span>';
										}
										?>
									</div><!-- .entry-meta -->
								</div><!-- .block-content -->
								</div><!-- .block-item-inner -->
							</div><!-- .block-item -->
						<?php endwhile; ?>

					</div><!-- .inner-wrapper -->
				</div><!-- .news-block-widget -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];
		}
	}

endif;

if ( ! class_exists( 'Magazine_Power_News_Slider_Widget' ) ) :

	/**
	 * News Slider Widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Power_News_Slider_Widget extends Magazine_Power_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$opts = array(
				'classname'   => 'magazine_power_widget_news_slider',
				'description' => esc_html__( 'Displays news slider', 'magazine-power' ),
			);

			$fields = array(
				'title'          => array(
					'label' => esc_html__( 'Title:', 'magazine-power' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'post_category'  => array(
					'label'           => esc_html__( 'Select Category:', 'magazine-power' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'magazine-power' ),
				),
				'post_number'    => array(
					'label'   => esc_html__( 'Number of Posts:', 'magazine-power' ),
					'type'    => 'number',
					'default' => 3,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 10,
				),
				'featured_image' => array(
					'label'   => esc_html__( 'Featured Image:', 'magazine-power' ),
					'type'    => 'select',
					'default' => 'magazine-power-large',
					'options' => magazine_power_get_image_sizes_options( false ),
				),
				'excerpt_length' => array(
					'label'       => esc_html__( 'Excerpt Length:', 'magazine-power' ),
					'description' => esc_html__( 'in words', 'magazine-power' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 15,
					'min'         => 0,
					'max'         => 200,
				),
			);

			parent::__construct( 'magazine-power-news-slider', esc_html__( 'MP: News Slider', 'magazine-power' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			$this->render_slider( $params );

			echo $args['after_widget'];
		}

		/**
		 * Render slider.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return void
		 */
		protected function render_slider( $params ) {
			$carousel_args = array(
				'slidesToShow'   => 1,
				'slidesToScroll' => 1,
				'dots'           => false,
				'prevArrow'      => '<span class="left-arrow carousel-arrow"><i class="fas fa-angle-left" aria-hidden="true"></i></span>',
				'nextArrow'      => '<span class="right-arrow carousel-arrow"><i class="fas fa-angle-right" aria-hidden="true"></i></span>',
				'responsive'     => array(
					array(
						'breakpoint' => 1024,
						'settings'   => array(
							'slidesToShow' => 1,
						),
					),
					array(
						'breakpoint' => 768,
						'settings'   => array(
							'slidesToShow' => 1,
						),
					),
					array(
						'breakpoint' => 480,
						'settings'   => array(
							'slidesToShow' => 1,
						),
					),
				),
			);

			$carousel_args_encoded = wp_json_encode( $carousel_args );

			$qargs = array(
				'posts_per_page'      => absint( $params['post_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);

			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}

			$the_query = new WP_Query( $qargs );
			?>

			<?php if ( $the_query->have_posts() ) : ?>

				<div class="magazine-power-carousel" data-slick='<?php echo $carousel_args_encoded; ?>'>

					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>

						<article class="carousel-item">
							<div class="carousel-item-inner">
								<div class="carousel-item-thumb">
									<?php if ( has_post_thumbnail() ) : ?>
										<a class="images-zoom" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( esc_attr( $params['featured_image'] ) ); ?></a>
									<?php else : ?>
										<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image-large.png' ); ?>" alt="<?php esc_attr_e( 'No Image', 'magazine-power' ); ?>" />
									<?php endif; ?>
								</div><!-- .carousel-item-thumb -->
								<div class="carousel-item-content">
									<?php
									$category = magazine_power_get_single_post_category( get_the_ID() );
									?>
									<?php if ( ! empty( $category ) ) : ?>
										<span class="cat-links"><a href="<?php echo esc_url( $category['url'] ); ?>"><?php echo esc_html( $category['name'] ); ?></a></span>
									<?php endif; ?>

									<h3 class="carousel-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="carousel-item-meta entry-meta">
										<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
										<?php
										if ( comments_open( get_the_ID() ) ) {
											echo '<span class="comments-link">';
											comments_popup_link( '0', '1', '%' );
											echo '</span>';
										}
										?>
									</div><!-- .carousel-item-meta -->
									<?php if ( absint( $params['excerpt_length'] ) > 0 ) : ?>
										<div class="carousel-item-excerpt">
											<?php
											$excerpt = magazine_power_the_excerpt( absint( $params['excerpt_length'] ) );
											echo wp_kses_post( wpautop( $excerpt ) );
											?>
										</div><!-- .carousel-item-excerpt -->
									<?php endif; ?>
								</div><!-- .carousel-item-content -->
							</div><!-- .carousel-item-inner -->
						</article><!-- .carousel-item -->

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				</div><!-- .magazine-power-carousel -->

			<?php endif; ?>
			<?php
		}
	}

endif;

if ( ! class_exists( 'Magazine_Power_Tabbed_Widget' ) ) :

	/**
	 * Tabbed Widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Power_Tabbed_Widget extends Magazine_Power_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$opts = array(
				'classname'   => 'magazine_power_widget_tabbed',
				'description' => esc_html__( 'Tabbed widget.', 'magazine-power' ),
			);

			$fields = array(
				'popular_heading'  => array(
					'label' => esc_html__( 'Popular', 'magazine-power' ),
					'type'  => 'heading',
				),
				'popular_number'   => array(
					'label'   => esc_html__( 'No. of Posts:', 'magazine-power' ),
					'type'    => 'number',
					'css'     => 'max-width:60px;',
					'default' => 5,
					'min'     => 1,
					'max'     => 10,
				),
				'recent_heading'   => array(
					'label' => esc_html__( 'Recent', 'magazine-power' ),
					'type'  => 'heading',
				),
				'recent_number'    => array(
					'label'   => esc_html__( 'No. of Posts:', 'magazine-power' ),
					'type'    => 'number',
					'css'     => 'max-width:60px;',
					'default' => 5,
					'min'     => 1,
					'max'     => 10,
				),
				'comments_heading' => array(
					'label' => esc_html__( 'Comments', 'magazine-power' ),
					'type'  => 'heading',
				),
				'comments_number'  => array(
					'label'   => esc_html__( 'No. of Comments:', 'magazine-power' ),
					'type'    => 'number',
					'css'     => 'max-width:60px;',
					'default' => 5,
					'min'     => 1,
					'max'     => 10,
				),
			);

			parent::__construct( 'magazine-power-tabbed', esc_html__( 'MP: Tabbed', 'magazine-power' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );
			$tab_id = 'tabbed-' . $this->number;

			echo $args['before_widget'];
			?>
			<div class="tabbed-container">
				<ul class="etabs">
					<li class="tab tab-popular"><a href="#<?php echo esc_attr( $tab_id ); ?>-popular"><?php esc_html_e( 'Popular', 'magazine-power' ); ?></a></li>
					<li class="tab tab-recent"><a href="#<?php echo esc_attr( $tab_id ); ?>-recent"><?php esc_html_e( 'Recent', 'magazine-power' ); ?></a></li>
					<li class="tab tab-comments"><a href="#<?php echo esc_attr( $tab_id ); ?>-comments"><?php esc_html_e( 'Comments', 'magazine-power' ); ?></a></li>
				</ul>
				<div id="<?php echo esc_attr( $tab_id ); ?>-popular" class="tab-content">
					<?php $this->render_news( 'popular', $params ); ?>
				</div>
				<div id="<?php echo esc_attr( $tab_id ); ?>-recent" class="tab-content">
					<?php $this->render_news( 'recent', $params ); ?>
				</div>
				<div id="<?php echo esc_attr( $tab_id ); ?>-comments" class="tab-content">
					<?php $this->render_comments( $params ); ?>
				</div>
			</div><!-- .tabbed-container -->
			<?php
			echo $args['after_widget'];
		}

		/**
		 * Render news.
		 *
		 * @since 1.0.0
		 *
		 * @param array $type Type.
		 * @param array $params Parameters.
		 * @return void
		 */
		protected function render_news( $type, $params ) {
			if ( ! in_array( $type, array( 'popular', 'recent' ), true ) ) {
				return;
			}

			switch ( $type ) {
				case 'popular':
					$qargs = array(
						'posts_per_page'      => absint( $params['popular_number'] ),
						'no_found_rows'       => true,
						'ignore_sticky_posts' => true,
						'orderby'             => 'comment_count',
					);
					break;

				case 'recent':
					$qargs = array(
						'posts_per_page'      => absint( $params['recent_number'] ),
						'no_found_rows'       => true,
						'ignore_sticky_posts' => true,
					);
					break;

				default:
					break;
			}

			$the_query = new WP_Query( $qargs );
			?>

			<?php if ( $the_query->have_posts() ) : ?>

				<ul class="news-list">
					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>
						<li class="news-item">
							<div class="news-thumb">
								<a class="news-item-thumb" href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id() ); ?>
									<?php if ( ! empty( $image ) ) : ?>
										<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>" />
									<?php endif; ?>
								<?php else : ?>
									<img src="<?php echo get_template_directory_uri() . '/images/no-image-65.png'; ?>" alt="<?php esc_attr_e( 'No Image', 'magazine-power' ); ?>" />
								<?php endif; ?>
								</a><!-- .news-item-thumb -->
							</div><!-- .news-thumb -->
							<div class="news-content">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
							</div><!-- .news-content -->
						</li><!-- .news-item -->
					<?php endwhile; ?>
				</ul><!-- .news-list -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>
			<?php
		}

		/**
		 * Render comments.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return void
		 */
		protected function render_comments( $params ) {
			$comment_args = array(
				'number'      => absint( $params['comments_number'] ),
				'status'      => 'approve',
				'post_status' => 'publish',
			);

			$comments = get_comments( $comment_args );
			?>

			<?php if ( ! empty( $comments ) ) : ?>
				<ul class="comments-list">
					<?php foreach ( $comments as $key => $comment ) : ?>
						<li>
							<div class="comments-thumb">
								<?php $comment_author_url = get_comment_author_url( $comment ); ?>
								<?php if ( ! empty( $comment_author_url ) ) : ?>
									<a href="<?php echo esc_url( $comment_author_url ); ?>"><?php echo get_avatar( $comment, 65 ); ?></a>
								<?php else : ?>
									<?php echo get_avatar( $comment, 65 ); ?>
								<?php endif; ?>
							</div><!-- .comments-thumb -->
							<div class="comments-content">
								<?php echo get_comment_author_link( $comment ); ?>&nbsp;<?php echo esc_html_x( 'on', 'Tabbed Widget', 'magazine-power' ); ?>&nbsp;<a href="<?php echo esc_url( get_comment_link( $comment ) ); ?>"><?php echo get_the_title( $comment->comment_post_ID ); ?></a>
							</div><!-- .comments-content -->
						</li>
					<?php endforeach; ?>
				</ul><!-- .comments-list -->
			<?php endif; ?>
			<?php
		}
	}

endif;

if ( ! class_exists( 'Magazine_Power_Categorized_News_Widget' ) ) :

	/**
	 * Categorized News Widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Power_Categorized_News_Widget extends Magazine_Power_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$opts = array(
				'classname'                   => 'magazine_power_widget_categorized_news',
				'description'                 => esc_html__( 'Displays categorized news.', 'magazine-power' ),
				'customize_selective_refresh' => true,
			);

			$fields = array(
				'title'          => array(
					'label' => esc_html__( 'Title:', 'magazine-power' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'post_category'  => array(
					'label'           => esc_html__( 'Select Category:', 'magazine-power' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'magazine-power' ),
				),
				'post_layout'    => array(
					'label'    => esc_html__( 'Post Layout:', 'magazine-power' ),
					'type'     => 'select',
					'default'  => 1,
					'adjacent' => true,
					'options'  => magazine_power_get_numbers_dropdown_options( 1, 2, esc_html__( 'Layout', 'magazine-power' ) . ' ' ),
				),
				'post_number'    => array(
					'label'   => esc_html__( 'Number of Posts:', 'magazine-power' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 10,
				),
				'major_heading'  => array(
					'label' => esc_html__( 'Main Block', 'magazine-power' ),
					'type'  => 'heading',
				),
				'featured_image' => array(
					'label'   => esc_html__( 'Featured Image:', 'magazine-power' ),
					'type'    => 'select',
					'default' => 'magazine-power-thumb',
					'options' => magazine_power_get_image_sizes_options(),
				),
				'excerpt_length' => array(
					'label'       => esc_html__( 'Excerpt Length:', 'magazine-power' ),
					'description' => esc_html__( 'in words', 'magazine-power' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 20,
					'min'         => 0,
					'max'         => 200,
				),
			);

			parent::__construct( 'magazine-power-categorized-news', esc_html__( 'MP: Categorized News', 'magazine-power' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}

			$major_post_id = null;
			?>
			<div class="categorized-news-widget categorized-news-layout-<?php echo esc_attr( $params['post_layout'] ); ?>">

				<div class="inner-wrapper">
					<div class="categorized-major">
						<?php
						$qargs = array(
							'posts_per_page'      => 1,
							'no_found_rows'       => true,
							'ignore_sticky_posts' => true,
						);

						if ( absint( $params['post_category'] ) > 0 ) {
							$qargs['cat'] = absint( $params['post_category'] );
						}

						$the_query = new WP_Query( $qargs );
						?>

						<?php if ( $the_query->have_posts() ) : ?>

							<?php
							while ( $the_query->have_posts() ) :
								$the_query->the_post();
								?>
								<?php $major_post_id = get_the_ID(); ?>

								<div class="categorized-news-item">
									<div class="categorize-news-item">
									<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
										<div class="categorized-news-thumb">
											<a class="images-zoom" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( esc_attr( $params['featured_image'] ) ); ?>
											</a>
										</div><!-- .categorized-news-thumb -->
									<?php endif; ?>
									<div class="categorized-news-text-wrap">
										<div class="categorized-news-text-content">
											<h3 class="categorized-news-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3><!-- .categorized-news-title -->
										</div><!-- .categorized-news-text-content -->
												<div class="categorized-news-meta entry-meta">
												<span class="posted-on"><?php the_time( 'j M Y' ); ?></span>

											</div><!-- .categorized-news-meta -->
										<?php if ( absint( $params['excerpt_length'] ) > 0 ) : ?>
											<div class="categorized-news-excerpt">
												<?php
												$excerpt = magazine_power_the_excerpt( absint( $params['excerpt_length'] ) );
												echo wp_kses_post( wpautop( $excerpt ) );
												?>
											</div><!-- .categorized-news-excerpt -->
										<?php endif; ?>
									</div><!-- .categorized-news-text-wrap -->
									</div><!-- .categorize-news-item" -->
								</div><!-- .categorized-news-item -->
							<?php endwhile; ?>

							<?php wp_reset_postdata(); ?>
						<?php endif; ?>
					</div><!-- .categorized-major -->

					<div class="categorized-minor">
						<div class="categorized-minor-news-wrapper">
							<?php
							$qargs = array(
								'posts_per_page'      => absint( $params['post_number'] ),
								'no_found_rows'       => true,
								'ignore_sticky_posts' => true,
							);

							if ( $major_post_id ) {
								$qargs['post__not_in']   = array( $major_post_id );
								$qargs['posts_per_page'] = absint( $params['post_number'] - 1 );
							}

							if ( absint( $params['post_category'] ) > 0 ) {
								$qargs['cat'] = absint( $params['post_category'] );
							}

							$the_query = new WP_Query( $qargs );
							?>

							<?php if ( $the_query->have_posts() ) : ?>

								<?php
								while ( $the_query->have_posts() ) :
									$the_query->the_post();
									?>
									<div class="categorized-news-item">
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="categorized-news-thumb">
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
											</div><!-- .categorized-news-thumb -->
										<?php endif; ?>
										<div class="categorized-news-text-wrap">
											<div class="categorized-news-text-content">
												<h3 class="categorized-news-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3><!-- .categorized-news-title -->
											</div><!-- .categorized-news-text-content -->
											<div class="categorized-news-meta entry-meta">
												<span class="posted-on"><?php the_time( 'j M Y' ); ?></span>

											</div><!-- .categorized-news-meta -->
										</div><!-- .categorized-news-text-wrap -->
									</div><!-- .categorized-news-item -->
								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>
							<?php endif; ?>

						</div><!-- .categorized-minor-news-wrapper -->
					</div><!-- .categorized-minor -->

				</div><!-- .inner-wrapper -->

			</div><!-- .categorized-news-widget -->
			<?php
			echo $args['after_widget'];
		}
	}

endif;
