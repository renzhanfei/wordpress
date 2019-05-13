<?php
/**
 * Info setup
 *
 * @package Magazine_Power
 */

if ( ! function_exists( 'magazine_power_info_setup' ) ) :

	/**
	 * Info setup.
	 *
	 * @since 1.0.0
	 */
	function magazine_power_info_setup() {

		$config = array(

			// Welcome content.
			/* translators: 1: theme name. */
			'welcome_content' => sprintf( esc_html__( '%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'magazine-power' ), 'Magazine Power' ),

			// Tabs.
			'tabs'            => array(
				'getting-started' => esc_html__( 'Getting Started', 'magazine-power' ),
				'support'         => esc_html__( 'Support', 'magazine-power' ),
				'useful-plugins'  => esc_html__( 'Useful Plugins', 'magazine-power' ),
				'demo-content'    => esc_html__( 'Demo Content', 'magazine-power' ),
				'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'magazine-power' ),
			),

			// Quick links.
			'quick_links'     => array(
				'theme_url'         => array(
					'text' => esc_html__( 'Theme Details', 'magazine-power' ),
					'url'  => 'https://wenthemes.com/item/wordpress-themes/magazine-power/',
				),
				'demo_url'          => array(
					'text' => esc_html__( 'View Theme Demo', 'magazine-power' ),
					'url'  => 'https://wenthemes.com/theme-demos/?demo=magazine-power',
				),
				'documentation_url' => array(
					'text' => esc_html__( 'View Documentation', 'magazine-power' ),
					'url'  => 'https://themepalace.com/instructions/themes/magazine-power/',
				),
				'rating_url'        => array(
					'text' => esc_html__( 'Rate Theme', 'magazine-power' ),
					'url'  => 'https://wordpress.org/support/theme/magazine-power/reviews/#new-post',
				),
			),

			// Getting started.
			'getting_started' => array(
				'one'   => array(
					'title'       => esc_html__( 'Theme Documentation', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'magazine-power' ),
					'button_text' => esc_html__( 'View Documentation', 'magazine-power' ),
					'button_url'  => 'https://themepalace.com/instructions/themes/magazine-power/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'two'   => array(
					'title'       => esc_html__( 'Static Front Page', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'magazine-power' ),
					'button_text' => esc_html__( 'Static Front Page', 'magazine-power' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
				),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'magazine-power' ),
					'button_text' => esc_html__( 'Customize', 'magazine-power' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
				),
				'four'  => array(
					'title'       => esc_html__( 'Demo Content', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-layout',
					/* translators: 1: plugin name. */
					'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'magazine-power' ), esc_html__( 'One Click Demo Import', 'magazine-power' ) ),
					'button_text' => esc_html__( 'Demo Content', 'magazine-power' ),
					'button_url'  => admin_url( 'themes.php?page=magazine-power-info&tab=demo-content' ),
					'button_type' => 'secondary',
				),
				'five'   => array(
					'title'       => esc_html__( 'Theme Preview', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'magazine-power' ),
					'button_text' => esc_html__( 'View Demo', 'magazine-power' ),
					'button_url'  => 'https://wenthemes.com/theme-demos/?demo=magazine-power',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'six'  => array(
					'title'       => esc_html__( 'Contact Support', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'magazine-power' ),
					'button_text' => esc_html__( 'Contact Support', 'magazine-power' ),
					'button_url'  => 'https://themepalace.com/forum/free-themes/magazine-power/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
			),

			// Support.
			'support'         => array(
				'one'   => array(
					'title'       => esc_html__( 'Contact Support', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'magazine-power' ),
					'button_text' => esc_html__( 'Contact Support', 'magazine-power' ),
					'button_url'  => 'https://themepalace.com/forum/free-themes/magazine-power/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'two'   => array(
					'title'       => esc_html__( 'Theme Documentation', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'magazine-power' ),
					'button_text' => esc_html__( 'View Documentation', 'magazine-power' ),
					'button_url'  => 'https://themepalace.com/instructions/themes/magazine-power/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'three' => array(
					'title'       => esc_html__( 'Child Theme', 'magazine-power' ),
					'icon'        => 'dashicons dashicons-admin-tools',
					'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself. Using this approach, you wont lose the customization after theme update.', 'magazine-power' ),
					'button_text' => esc_html__( 'Learn More', 'magazine-power' ),
					'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
			),

			// Useful plugins.
			'useful_plugins'  => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site.', 'magazine-power' ),
			),

			// Demo content.
			'demo_content'    => array(
				/* translators: 1: plugin link. */
				'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'magazine-power' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'magazine-power' ) . '</a>' ),
			),

			// Upgrade content.
			'upgrade_to_pro' => array(
				'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'magazine-power' ),
				'button_text' => esc_html__( 'Buy Pro Theme', 'magazine-power' ),
				'button_url'  => 'https://themepalace.com/downloads/magazine-power-pro/',
				'button_type' => 'primary',
				'is_new_tab'  => true,
				),

		);

		Magazine_Power_Info::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'magazine_power_info_setup' );
