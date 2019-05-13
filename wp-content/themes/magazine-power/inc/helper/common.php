<?php
/**
 * Common helper functions
 *
 * @package Magazine_Power
 */

if ( ! function_exists( 'magazine_power_the_excerpt' ) ) :

	/**
	 * Generate excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length Excerpt length in words.
	 * @param WP_Post $post_obj WP_Post instance (Optional).
	 * @return string Excerpt.
	 */
	function magazine_power_the_excerpt( $length = 0, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );

		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}
		$source_content  = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}

endif;

if ( ! function_exists( 'magazine_power_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_simple_breadcrumb() {
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/lib/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_home_text  = magazine_power_get_option( 'breadcrumb_home_text' );
		$breadcrumb_show_title = magazine_power_get_option( 'breadcrumb_show_title' );

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
			'show_title'  => ( true === $breadcrumb_show_title ) ? true : false,
			'labels'      => array(
				'home' => esc_html( $breadcrumb_home_text ),
			),
		);

		breadcrumb_trail( $breadcrumb_args );
	}

endif;

if ( ! function_exists( 'magazine_power_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 1.0.0
	 * @return string Font URL.
	 */
	function magazine_power_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'magazine-power' ) ) {
			$fonts[] = 'Roboto:400italic,700italic,300,400,500,600,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}

endif;

if ( ! function_exists( 'magazine_power_get_sidebar_options' ) ) :

	/**
	 * Get sidebar options.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_get_sidebar_options() {
		global $wp_registered_sidebars;

		$output = array();

		if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) {
			foreach ( $wp_registered_sidebars as $key => $sidebar ) {
				$output[ $key ] = $sidebar['name'];
			}
		}

		return $output;
	}

endif;

if ( ! function_exists( 'magazine_power_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_primary_navigation_fallback() {
		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'magazine-power' ) . '</a></li>';

		$qargs = array(
			'posts_per_page' => 4,
			'post_type'      => 'page',
			'orderby'        => 'name',
			'order'          => 'ASC',
		);

		$the_query = new WP_Query( $qargs );

		if ( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				the_title( '<li><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );
			}

			wp_reset_postdata();
		}

		echo '</ul>';
	}

endif;

if ( ! function_exists( 'magazine_power_the_custom_logo' ) ) :

	/**
	 * Render logo.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_the_custom_logo() {
		the_custom_logo();
	}

endif;

/**
 * Sanitize post ID.
 *
 * @since 1.0.0
 *
 * @param string $key Field key.
 * @param array  $field Field detail.
 * @param mixed  $value Raw value.
 * @return mixed Sanitized value.
 */
function magazine_power_widget_sanitize_post_id( $key, $field, $value ) {
	$output = '';

	$value = absint( $value );

	if ( $value ) {
		$not_allowed = array( 'revision', 'attachment', 'nav_menu_item' );
		$post_type   = get_post_type( $value );
		if ( ! in_array( $post_type, $not_allowed, true ) && 'publish' === get_post_status( $value ) ) {
			$output = $value;
		}
	}

	return $output;
}

if ( ! function_exists( 'magazine_power_get_index_page_id' ) ) :

	/**
	 * Get front index page ID.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 * @return int Corresponding Page ID.
	 */
	function magazine_power_get_index_page_id( $type = 'front' ) {
		$page = '';

		switch ( $type ) {
			case 'front':
				$page = get_option( 'page_on_front' );
				break;

			case 'blog':
				$page = get_option( 'page_for_posts' );
				break;

			default:
				break;
		}
		$page = absint( $page );

		return $page;
	}

endif;

if ( ! function_exists( 'magazine_power_render_select_dropdown' ) ) :

	/**
	 * Render select dropdown.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $main_args     Main arguments.
	 * @param string $callback      Callback method.
	 * @param array  $callback_args Callback arguments.
	 * @return string Rendered markup.
	 */
	function magazine_power_render_select_dropdown( $main_args, $callback, $callback_args = array() ) {
		$defaults = array(
			'id'          => '',
			'name'        => '',
			'selected'    => 0,
			'echo'        => true,
			'add_default' => false,
		);

		$r = wp_parse_args( $main_args, $defaults );

		$output = '';

		$choices = array();

		if ( is_callable( $callback ) ) {
			$choices = call_user_func_array( $callback, $callback_args );
		}

		if ( ! empty( $choices ) || true === $r['add_default'] ) {
			$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";

			if ( true === $r['add_default'] ) {
				$output .= '<option value="">' . __( 'Default', 'magazine-power' ) . '</option>\n';
			}

			if ( ! empty( $choices ) ) {
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
			}

			$output .= "</select>\n";
		}

		if ( $r['echo'] ) {
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $output;
	}

endif;

if ( ! function_exists( 'magazine_power_get_news_ticker_content' ) ) :

	/**
	 * Get news ticker content.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_get_news_ticker_content() {
		$tickers = magazine_power_news_ticker_details();

		if ( empty( $tickers ) ) {
			return;
		}

		ob_start();
		?>
		<div id="news-ticker">
			<div class="news-ticker-inner-wrap">
				<?php foreach ( $tickers as $key => $ticker ) : ?>
					<div class="list">
						<a href="<?php echo esc_url( $ticker['link'] ); ?>"><?php echo esc_html( $ticker['text'] ); ?></a>
					</div>
				<?php endforeach ?>
			</div><!-- .news-ticker-inner-wrap -->
		</div><!-- #news-ticker -->
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

endif;

if ( ! function_exists( 'magazine_power_news_ticker_details' ) ) :

	/**
	 * Get news ticker details.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_news_ticker_details() {
		$output = array();

		$ticker_category = magazine_power_get_option( 'ticker_category' );
		$ticker_number   = magazine_power_get_option( 'ticker_number' );

		$qargs = array(
			'posts_per_page'      => absint( $ticker_number ),
			'post_type'           => 'post',
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
		);

		if ( absint( $ticker_category ) > 0 ) {
			$qargs['cat'] = absint( $ticker_category );
		}

		$the_query = new WP_Query( $qargs );

		if ( $the_query->have_posts() ) {
			$i = 0;

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$output[ $i ]['text'] = get_the_title();
				$output[ $i ]['link'] = get_permalink();
				$i++;
			}

			wp_reset_postdata();
		}

		return $output;
	}

endif;

if ( ! function_exists( 'magazine_power_get_single_post_category' ) ) :

	/**
	 * Get post category detail.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id Post ID.
	 * @return array Post category detail.
	 */
	function magazine_power_get_single_post_category( $post_id ) {
		$output = array();

		$categories = get_the_terms( $post_id, 'category' );

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			$category_item  = array_shift( $categories );
			$output['name'] = $category_item->name;
			$output['slug'] = $category_item->name;
			$output['url']  = get_term_link( $category_item );
		}

		return $output;
	}

endif;
