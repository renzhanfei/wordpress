<?php
/**
 * Recommended plugins
 *
 * @package Magazine_Power
 */

if ( ! function_exists( 'magazine_power_recommended_plugins' ) ) :

	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_recommended_plugins() {
		$plugins = array(
			array(
				'name' => esc_html__( 'One Click Demo Import', 'magazine-power' ),
				'slug' => 'one-click-demo-import',
			),

		);

		$config = array();

		tgmpa( $plugins, $config );
	}

endif;

add_action( 'tgmpa_register', 'magazine_power_recommended_plugins' );
