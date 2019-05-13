<?php
/**
 * Default theme options
 *
 * @package Magazine_Power
 */

/**
 * Get default theme options.
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function magazine_power_get_default_theme_options() {

	$defaults = array();

	// Header.
	$defaults['show_title']                 = true;
	$defaults['show_tagline']               = true;
	$defaults['show_date']                  = true;
	$defaults['show_ticker']                = true;
	$defaults['ticker_title']               = esc_html__( 'Latest News:', 'magazine-power' );
	$defaults['ticker_category']            = 0;
	$defaults['ticker_number']              = 3;
	$defaults['show_social_in_header']      = false;
	$defaults['enable_sticky_primary_menu'] = false;

	// Layout.

	$defaults['global_layout']           = 'right-sidebar';
	$defaults['archive_layout']          = 'excerpt';
	$defaults['archive_image']           = 'medium';
	$defaults['archive_image_alignment'] = 'left';
	$defaults['single_image']            = 'large';
	$defaults['single_image_alignment']  = 'center';

	// Blog.
	$defaults['excerpt_length'] = 40;
	$defaults['read_more_text'] = esc_html__( 'Read more', 'magazine-power' );

	// Author Bio.
	$defaults['author_bio_in_single']           = true;
	$defaults['author_bio_show_recent_posts']   = false;
	$defaults['author_bio_recent_posts_number'] = 3;

	// Breadcrumb.
	$defaults['breadcrumb_type']       = 'simple';
	$defaults['breadcrumb_home_text']  = esc_html__( 'Home', 'magazine-power' );
	$defaults['breadcrumb_show_title'] = true;

	// Pagination.
	$defaults['pagination_type'] = 'numeric';

	// Footer.
	$defaults['copyright_text'] = esc_html__( 'Copyright &copy; All rights reserved.', 'magazine-power' );
	$defaults['go_to_top']      = true;

	// Pass through filter.
	$defaults = apply_filters( 'magazine_power_filter_default_theme_options', $defaults );
	return $defaults;
}
