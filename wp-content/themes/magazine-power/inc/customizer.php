<?php
/**
 * Theme Customizer
 *
 * @package Magazine_Power
 */

/**
 * Custom controls and settings.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function magazine_power_customize_register( $wp_customize ) {
	// Load custom controls.
	require get_template_directory() . '/inc/customizer/control.php';

	// Register custom controls and sections.
	$wp_customize->register_control_type( 'Magazine_Power_Heading_Control' );
	$wp_customize->register_control_type( 'Magazine_Power_Message_Control' );
	$wp_customize->register_control_type( 'Magazine_Power_Dropdown_Taxonomies_Control' );
	$wp_customize->register_control_type( 'Magazine_Power_Dropdown_Sidebars_Control' );
	$wp_customize->register_control_type( 'Magazine_Power_Radio_Image_Control' );
	$wp_customize->register_section_type( 'Magazine_Power_Customize_Section_Upsell' );

	// Load customize helpers.
	require get_template_directory() . '/inc/helper/options.php';

	// Load customize sanitize.
	require get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize callback.
	require get_template_directory() . '/inc/customizer/callback.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Load customize option.
	require get_template_directory() . '/inc/customizer/option.php';

	// Modify default customizer options.
	$wp_customize->get_control( 'background_color' )->description = esc_html__( 'Note: Background Color is applicable only if no image is set as Background Image.', 'magazine-power' );

	$wp_customize->add_section(
		new Magazine_Power_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Magazine Power Pro', 'magazine-power' ),
				'pro_text' => esc_html__( 'Buy Pro', 'magazine-power' ),
				'pro_url'  => 'https://themepalace.com/downloads/magazine-power-pro/',
				'priority' => 1,
			)
		)
	);
}

add_action( 'customize_register', 'magazine_power_customize_register' );

/**
 * Customizer partials.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function magazine_power_customizer_partials( WP_Customize_Manager $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
		return;
	}

	// Load customizer partials callback.
	require get_template_directory() . '/inc/customizer/partials.php';

	// Partial blogname.
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => 'magazine_power_customize_partial_blogname',
		)
	);

	// Partial blogdescription.
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => 'magazine_power_customize_partial_blogdescription',
		)
	);
}

add_action( 'customize_register', 'magazine_power_customizer_partials', 99 );

/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.0
 */
function magazine_power_customizer_control_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'magazine-power-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'customize-controls' ), '1.0.0', true );

	wp_enqueue_style( 'magazine-power-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css', '', '1.0.0' );
}

add_action( 'customize_controls_enqueue_scripts', 'magazine_power_customizer_control_scripts', 0 );
