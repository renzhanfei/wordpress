<?php
/**
 * Basic theme functions
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package Magazine_Power
 */

if ( ! function_exists( 'magazine_power_custom_body_class' ) ) :

	/**
	 * Custom body class.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function magazine_power_custom_body_class( $input ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		// Global layout.
		$global_layout = magazine_power_get_option( 'global_layout' );
		$global_layout = apply_filters( 'magazine_power_filter_theme_global_layout', $global_layout );

		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
			case 'three-columns':
				$input[] = 'three-columns-enabled';
				break;

			default:
				break;
		}

		// Sticky menu.
		$enable_sticky_primary_menu = magazine_power_get_option( 'enable_sticky_primary_menu' );

		if ( true === $enable_sticky_primary_menu ) {
			$input[] = 'enabled-sticky-primary-menu';
		}

		return $input;
	}

endif;

add_filter( 'body_class', 'magazine_power_custom_body_class' );

if ( ! function_exists( 'magazine_power_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_custom_content_width() {
		global $content_width;

		$global_layout = magazine_power_get_option( 'global_layout' );
		$global_layout = apply_filters( 'magazine_power_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
				$content_width = 570;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}
	}

endif;

add_filter( 'template_redirect', 'magazine_power_custom_content_width' );

if ( ! function_exists( 'magazine_power_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function magazine_power_implement_excerpt_length( $length ) {
		$excerpt_length = magazine_power_get_option( 'excerpt_length' );

		if ( empty( $excerpt_length ) ) {
			$excerpt_length = $length;
		}

		return apply_filters( 'magazine_power_filter_excerpt_length', absint( $excerpt_length ) );
	}

endif;

if ( ! function_exists( 'magazine_power_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function magazine_power_implement_read_more( $more ) {
		$flag_apply_excerpt_read_more = apply_filters( 'magazine_power_filter_excerpt_read_more', true );

		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more;
		}

		$output = $more;

		$read_more_text = magazine_power_get_option( 'read_more_text' );

		if ( ! empty( $read_more_text ) ) {
			$output = ' <a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html( $read_more_text ) . '</a>';
			$output = apply_filters( 'magazine_power_filter_read_more_link', $output );
		}

		return $output;
	}

endif;

if ( ! function_exists( 'magazine_power_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function magazine_power_content_more_link( $more_link, $more_link_text ) {
		$flag_apply_excerpt_read_more = apply_filters( 'magazine_power_filter_excerpt_read_more', true );

		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more_link;
		}

		$read_more_text = magazine_power_get_option( 'read_more_text' );

		if ( ! empty( $read_more_text ) ) {
			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
		}

		return $more_link;
	}

endif;

if ( ! function_exists( 'magazine_power_hook_read_more_filters' ) ) :

	/**
	 * Hook read more filters.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_hook_read_more_filters() {
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {
			add_filter( 'excerpt_length', 'magazine_power_implement_excerpt_length', 999 );
			add_filter( 'the_content_more_link', 'magazine_power_content_more_link', 10, 2 );
			add_filter( 'excerpt_more', 'magazine_power_implement_read_more' );
		}
	}

endif;

add_action( 'wp', 'magazine_power_hook_read_more_filters' );
