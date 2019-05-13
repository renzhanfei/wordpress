<?php
/**
 * The Front Primary Sidebar
 *
 * @package Magazine_Power
 */

?>

<div id="sidebar-primary" class="widget-area sidebar" role="complementary">
<div class="sidebar-inner">
	<?php if ( is_active_sidebar( 'sidebar-front-page-middle-right-widget-area' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-front-page-middle-right-widget-area' ); ?>
	<?php endif; ?>
	</div><!-- .sidebar-inner -->
</div><!-- #sidebar-primary -->
