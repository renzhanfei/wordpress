<?php
/**
 * Callback functions for active_callback
 *
 * @package Magazine_Power
 */

/**
 * Check if image in archive is active.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 *
 * @return bool Whether the control is active to the current preview.
 */
function magazine_power_is_image_in_archive_active( $control ) {
	if ( 'disable' !== $control->manager->get_setting( 'theme_options[archive_image]' )->value() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if image in single is active.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 *
 * @return bool Whether the control is active to the current preview.
 */
function magazine_power_is_image_in_single_active( $control ) {
	if ( 'disable' !== $control->manager->get_setting( 'theme_options[single_image]' )->value() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if news ticker is active.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 *
 * @return bool Whether the control is active to the current preview.
 */
function magazine_power_is_news_ticker_active( $control ) {
	if ( $control->manager->get_setting( 'theme_options[show_ticker]' )->value() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if author bio is active.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 *
 * @return bool Whether the control is active to the current preview.
 */
function magazine_power_is_author_bio_active( $control ) {
	if ( $control->manager->get_setting( 'theme_options[author_bio_in_single]' )->value() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if author bio recent posts is active.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 *
 * @return bool Whether the control is active to the current preview.
 */
function magazine_power_is_author_bio_recent_posts_active( $control ) {
	if ( $control->manager->get_setting( 'theme_options[author_bio_in_single]' )->value() && $control->manager->get_setting( 'theme_options[author_bio_show_recent_posts]' )->value() ) {
		return true;
	} else {
		return false;
	}
}
