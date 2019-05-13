<?php
/**
 * Customizer partials
 *
 * @package Magazine_Power
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function magazine_power_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site description for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function magazine_power_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
