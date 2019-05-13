<?php
/**
 * Custom theme functions
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Magazine_Power
 */

if ( ! function_exists( 'magazine_power_skip_to_content' ) ) :

	/**
	 * Add Skip to content.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_skip_to_content() {
		?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'magazine-power' ); ?></a>
		<?php
	}

endif;

add_action( 'magazine_power_action_before', 'magazine_power_skip_to_content', 15 );

if ( ! function_exists( 'magazine_power_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_site_branding() {
		?>
		<div class="site-branding">

			<?php magazine_power_the_custom_logo(); ?>

			<?php
			$show_title   = magazine_power_get_option( 'show_title' );
			$show_tagline = magazine_power_get_option( 'show_tagline' );
			?>

			<?php if ( true === $show_title || true === $show_tagline ) : ?>
				<div id="site-identity">
					<?php if ( true === $show_title ) : ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( true === $show_tagline ) : ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				</div><!-- #site-identity -->
			<?php endif; ?>
		</div><!-- .site-branding -->
		<div id="header-widget">
			<?php if ( is_active_sidebar( 'header-right' ) ) : ?>
				<div id="header-right-widget-area">
					<?php dynamic_sidebar( 'header-right' ); ?>
				</div><!-- #header-right-widget-area -->
			<?php endif; ?>
		</div><!-- #header-ads -->
		<?php
	}

endif;

add_action( 'magazine_power_action_header', 'magazine_power_site_branding' );

if ( ! function_exists( 'magazine_power_customize_theme_global_layout' ) ) :

	/**
	 * Customize theme global layout.
	 *
	 * @since 1.0.0
	 *
	 * @param string $layout Layout.
	 */
	function magazine_power_customize_theme_global_layout( $layout ) {
		global $post;

		// Check if single.
		if ( $post && is_singular( array( 'post', 'page' ) ) ) {
			$post_options = get_post_meta( $post->ID, 'magazine_power_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$layout = $post_options['post_layout'];
			}
		}

		if ( is_page_template( 'tpl-frontpage.php' ) ) {
			$layout = 'right-sidebar';
		}

		if ( is_page_template( 'tpl-builders.php' ) || is_page_template( 'tpl-full-width.php' ) ) {
			$layout = 'no-sidebar';
		}

		return $layout;
	}

endif;

add_filter( 'magazine_power_filter_theme_global_layout', 'magazine_power_customize_theme_global_layout', 11, 1 );

if ( ! function_exists( 'magazine_power_add_primary_navigation' ) ) :

	/**
	 * Primary navigation.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_add_primary_navigation() {
		?>
		<div id="main-nav" class="clear-fix">
			<div class="main-nav-wrapper">
				<div class="container">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<div class="wrap-menu-content">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
									'fallback_cb'    => 'magazine_power_primary_navigation_fallback',
								)
							);
							?>
						</div><!-- .wrap-menu-content -->
					</nav><!-- #site-navigation -->

					<div class="header-search-box">
						<a href="#" class="search-icon"><i class="fas fa-search"></i></a>
						<div class="search-box-wrap">
							<?php get_search_form(); ?>
						</div><!-- .search-box-wrap -->
					</div><!-- .header-search-box -->
				</div> <!-- .container -->
			</div> <!-- main-nav-wrapper -->
		</div> <!-- #main-nav -->
		<?php
	}

endif;

add_action( 'magazine_power_action_after_header', 'magazine_power_add_primary_navigation', 20 );

if ( ! function_exists( 'magazine_power_mobile_navigation' ) ) :

	/**
	 * Mobile navigation.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_mobile_navigation() {
		?>
		<div class="mobile-nav-wrap">
			<a id="mobile-trigger" href="#mob-menu"><i class="fas fa-bars"></i></a>
			<div id="mob-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => '',
						'fallback_cb'    => 'magazine_power_primary_navigation_fallback',
					)
				);
				?>
			</div><!-- #mob-menu -->

			<?php if ( has_nav_menu( 'top' ) ) : ?>
				<a id="mobile-trigger2" href="#mob-menu2"><i class="fas fa-bars"></i></a>
				<div id="mob-menu2">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'top',
							'container'      => '',
						)
					);
					?>
				</div><!-- #mob-menu2 -->
			<?php endif; ?>
		</div><!-- .mobile-nav-wrap -->
		<?php
	}

endif;

add_action( 'magazine_power_action_before', 'magazine_power_mobile_navigation', 20 );

if ( ! function_exists( 'magazine_power_footer_copyright' ) ) :

	/**
	 * Footer copyright.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_footer_copyright() {
		// Check if footer is disabled.
		$footer_status = apply_filters( 'magazine_power_filter_footer_status', true );
		if ( true !== $footer_status ) {
			return;
		}

		// Footer menu.
		$footer_menu_content = wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'container'      => 'div',
				'container_id'   => 'footer-navigation',
				'depth'          => 1,
				'fallback_cb'    => false,
				'echo'           => false,
			)
		);

		// Copyright content.
		$copyright_text = magazine_power_get_option( 'copyright_text' );
		$copyright_text = apply_filters( 'magazine_power_filter_copyright_text', $copyright_text );
		if ( ! empty( $copyright_text ) ) {
			$copyright_text = wp_kses_data( $copyright_text );
		}

		// Powered by content.
		$powered_by_text = sprintf( esc_html__( 'Magazine Power by %s', 'magazine-power' ), '<a target="_blank" rel="designer" href="https://wenthemes.com/">' . esc_html__( 'WEN Themes', 'magazine-power' ) . '</a>' );

		$column_count = 0;

		if ( $footer_menu_content ) {
			$column_count++;
		}
		if ( $copyright_text ) {
			$column_count++;
		}
		if ( $powered_by_text ) {
			$column_count++;
		}
		?>
		<div class="colophon-inner colophon-grid-<?php echo esc_attr( $column_count ); ?>">
			<?php if ( ! empty( $copyright_text ) ) : ?>
				<div class="colophon-column">
					<div class="copyright">
						<?php echo $copyright_text; // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div><!-- .copyright -->
				</div><!-- .colophon-column -->
			<?php endif; ?>

			<?php if ( ! empty( $footer_menu_content ) ) : ?>
				<div class="colophon-column">
					<?php echo $footer_menu_content; // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div><!-- .colophon-column -->
			<?php endif; ?>

			<?php if ( ! empty( $powered_by_text ) ) : ?>
				<div class="colophon-column">
					<div class="site-info">
						<?php echo $powered_by_text; // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div><!-- .site-info -->
				</div><!-- .colophon-column -->
			<?php endif; ?>
		</div><!-- .colophon-inner -->
		<?php
	}

endif;

add_action( 'magazine_power_action_footer', 'magazine_power_footer_copyright', 10 );

if ( ! function_exists( 'magazine_power_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_add_sidebar() {
		$global_layout = magazine_power_get_option( 'global_layout' );
		$global_layout = apply_filters( 'magazine_power_filter_theme_global_layout', $global_layout );

		// Include primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			if ( is_page_template( 'tpl-frontpage.php' ) ) {
				get_sidebar( 'front' );
			} else {
				get_sidebar();
			}
		}

		// Include secondary sidebar.
		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
				break;

			default:
				break;
		}
	}

endif;

add_action( 'magazine_power_action_sidebar', 'magazine_power_add_sidebar' );

if ( ! function_exists( 'magazine_power_custom_posts_navigation' ) ) :

	/**
	 * Posts pagination.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_custom_posts_navigation() {
		$pagination_type = magazine_power_get_option( 'pagination_type' );

		switch ( $pagination_type ) {

			case 'default':
				the_posts_navigation();
				break;

			case 'numeric':
				the_posts_pagination();
				break;

			default:
				break;
		}
	}

endif;

add_action( 'magazine_power_action_posts_navigation', 'magazine_power_custom_posts_navigation' );

if ( ! function_exists( 'magazine_power_add_image_in_single_display' ) ) :

	/**
	 * Add image in single.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_add_image_in_single_display() {
		global $post;

		if ( has_post_thumbnail() ) {
			$values = get_post_meta( $post->ID, 'magazine_power_theme_settings', true );

			$magazine_power_theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';

			if ( ! $magazine_power_theme_settings_single_image ) {
				$magazine_power_theme_settings_single_image = magazine_power_get_option( 'single_image' );
			}

			if ( 'disable' !== $magazine_power_theme_settings_single_image ) {
				$args = array(
					'class' => 'aligncenter',
				);
				the_post_thumbnail( esc_attr( $magazine_power_theme_settings_single_image ), $args );
			}
		}
	}

endif;

add_action( 'magazine_power_single_image', 'magazine_power_add_image_in_single_display' );

if ( ! function_exists( 'magazine_power_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_add_breadcrumb() {
		// Bail if Breadcrumb disabled.
		$breadcrumb_type = magazine_power_get_option( 'breadcrumb_type' );

		if ( 'disabled' === $breadcrumb_type ) {
			return;
		}

		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb"><div class="container">';

		switch ( $breadcrumb_type ) {
			case 'simple':
				magazine_power_simple_breadcrumb();
				break;

			default:
				break;
		}

		echo '</div><!-- .container --></div><!-- #breadcrumb -->';
	}

endif;

add_action( 'magazine_power_action_before_content', 'magazine_power_add_breadcrumb', 7 );

if ( ! function_exists( 'magazine_power_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_footer_goto_top() {
		$go_to_top = magazine_power_get_option( 'go_to_top' );

		if ( true !== $go_to_top ) {
			return;
		}

		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fas fa-angle-up"></i></a>';
	}

endif;

add_action( 'magazine_power_action_after', 'magazine_power_footer_goto_top', 20 );

if ( ! function_exists( 'magazine_power_header_top_content' ) ) :

	/**
	 * Render top head.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_header_top_content() {
		$show_ticker = magazine_power_get_option( 'show_ticker' );
		$show_date   = magazine_power_get_option( 'show_date' );

		if (
			false === $show_date &&
			false === $show_ticker &&
			false === has_nav_menu( 'top' ) &&
			! ( true === magazine_power_get_option( 'show_social_in_header' ) && has_nav_menu( 'social' ) )
			) {
			return;
		}
		?>
		<div id="tophead">
			<div class="container">

				<?php if ( true === $show_date ) : ?>
					<div class="head-date">
						<?php echo esc_html( date_i18n( _x( 'd M, Y', 'Date Format', 'magazine-power' ) ) ); ?>
					</div><!-- .head-date -->
				<?php endif; ?>
				<?php if ( has_nav_menu( 'top' ) ) : ?>
					<div id="top-nav">
						<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'top',
									'container'       => 'nav',
									'container_class' => 'top-navigation',
									'depth'           => 2,
									'fallback_cb'     => false,
								)
							);
						?>
					</div><!-- #top-nav -->
				<?php endif; ?>
				<?php if ( true === $show_ticker ) : ?>
					<div class="top-news">
						<span class="top-news-title">
						<?php $ticker_title = magazine_power_get_option( 'ticker_title' ); ?>
						<?php echo ( ! empty( $ticker_title ) ) ? esc_html( $ticker_title ) : '&nbsp;'; ?>
						</span>
						<?php echo magazine_power_get_news_ticker_content(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div><!-- .top-news -->
				<?php endif; ?>


				<?php if ( true === magazine_power_get_option( 'show_social_in_header' ) && has_nav_menu( 'social' ) ) : ?>
					<div class="header-social">
						<?php the_widget( 'Magazine_Power_Social_Widget' ); ?>
					</div><!-- .header-social -->
				<?php endif; ?>



			</div><!-- .container -->
		</div><!-- #tophead -->
		<?php
	}

endif;

add_action( 'magazine_power_action_before_header', 'magazine_power_header_top_content', 5 );

if ( ! function_exists( 'magazine_power_add_default_message_front_widgets' ) ) :

	/**
	 * Add default message in front widget area.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_add_default_message_front_widgets() {

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		// Default message.
		$args = array(
			'title' => esc_html__( 'Welcome to Magazine Power', 'magazine-power' ),
			'text'  => esc_html__( 'You are seeing this because there is no any widget in Front Page Middle Widget Area. To add widgets, go to Appearance->Widgets in admin panel. This message will disappear when you add widgets.', 'magazine-power' ),
		);

		$widget_args = array(
			'before_title' => '<h2 class="widget-title"><span>',
			'after_title'  => '</span></h2>',
		);

		the_widget( 'WP_Widget_Text', $args, $widget_args );
	}

endif;

add_action( 'magazine_power_action_default_front_page_widget_area', 'magazine_power_add_default_message_front_widgets' );

if ( ! function_exists( 'magazine_power_add_author_bio_in_single' ) ) :

	/**
	 * Display Author bio.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_add_author_bio_in_single() {
		// Bail if not singular post.
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		$author_bio_in_single = magazine_power_get_option( 'author_bio_in_single' );

		if ( true !== $author_bio_in_single ) {
			return;
		}

		get_template_part( 'template-parts/author-bio', 'single' );
	}

endif;

add_action( 'magazine_power_author_bio', 'magazine_power_add_author_bio_in_single' );
