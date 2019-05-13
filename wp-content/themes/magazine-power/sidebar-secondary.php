<?php
/**
 * The Secondary Sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazine_Power
 */

$default_sidebar = apply_filters( 'magazine_power_filter_default_sidebar_id', 'sidebar-2', 'secondary' );
?>

<div id="sidebar-secondary" class="widget-area sidebar" role="complementary">
	<div class="sidebar-inner">
	<?php if ( is_active_sidebar( $default_sidebar ) ) : ?>
		<?php dynamic_sidebar( $default_sidebar ); ?>
	<?php else : ?>
		<?php
			/**
			 * Hook - magazine_power_action_default_sidebar.
			 */
			do_action( 'magazine_power_action_default_sidebar', $default_sidebar, 'secondary' );
		?>
	<?php endif; ?>
	</div><!-- .sidebar-inner -->
</div><!-- #sidebar-secondary -->
