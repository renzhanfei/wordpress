<?php
/**
 * Template for Front page
 *
 * Template name: Frontpage
 *
 * @package Magazine_Power
 */

get_header(); ?>

	<div id="sidebar-front-page-top-widget-area" class="widget-area">
		<div class="container">
			<?php dynamic_sidebar( 'sidebar-front-page-top-widget-area' ); ?>
		</div><!-- .container -->
	</div><!-- #sidebar-front-page-top-widget-area -->
	<div id="home-content-widget-area">
		<div class="container">
			<div class="inner-wrapper">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">

						<?php
						echo '<div id="sidebar-front-page-widget-area" class="widget-area">';
						if ( is_active_sidebar( 'sidebar-front-page-widget-area' ) ) {
							dynamic_sidebar( 'sidebar-front-page-widget-area' );
						}
						else {
							do_action( 'magazine_power_action_default_front_page_widget_area' );
						}
						echo '</div><!-- #sidebar-front-page-widget-area -->';
						?>

					</main><!-- #main -->
				</div><!-- #primary -->

				<?php
					/**
					 * Hook - magazine_power_action_sidebar.
					 *
					 * @hooked: magazine_power_add_sidebar - 10
					 */
					do_action( 'magazine_power_action_sidebar' );
				?>
			</div><!-- .inner-wrapper -->
		</div><!-- .container -->
	</div><!-- #home-content-widget-area -->
	<div id="sidebar-front-page-bottom-widget-area" class="widget-area">
		<div class="container">
			<?php dynamic_sidebar( 'sidebar-front-page-bottom-widget-area' ); ?>
		</div><!-- .container -->
	</div><!-- #sidebar-front-page-bottom-widget-area -->

<?php get_footer();
