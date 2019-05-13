<?php
/**
 * Theme Options
 *
 * @package Magazine_Power
 */

$default = magazine_power_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel(
	'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'magazine-power' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
	)
);

// Header Section.
$wp_customize->add_section(
	'section_header',
	array(
		'title'      => esc_html__( 'Header Options', 'magazine-power' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting show_title.
$wp_customize->add_setting(
	'theme_options[show_title]',
	array(
		'default'           => $default['show_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_title]',
	array(
		'label'    => esc_html__( 'Show Site Title', 'magazine-power' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting show_tagline.
$wp_customize->add_setting(
	'theme_options[show_tagline]',
	array(
		'default'           => $default['show_tagline'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_tagline]',
	array(
		'label'    => esc_html__( 'Show Tagline', 'magazine-power' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting show_date.
$wp_customize->add_setting(
	'theme_options[show_date]',
	array(
		'default'           => $default['show_date'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_date]',
	array(
		'label'    => esc_html__( 'Show Date', 'magazine-power' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting show_ticker.
$wp_customize->add_setting(
	'theme_options[show_ticker]',
	array(
		'default'           => $default['show_ticker'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_ticker]',
	array(
		'label'    => esc_html__( 'Show News Ticker', 'magazine-power' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting ticker_title.
$wp_customize->add_setting(
	'theme_options[ticker_title]',
	array(
		'default'           => $default['ticker_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[ticker_title]',
	array(
		'label'           => esc_html__( 'Ticker Title', 'magazine-power' ),
		'section'         => 'section_header',
		'type'            => 'text',
		'priority'        => 100,
		'active_callback' => 'magazine_power_is_news_ticker_active',
	)
);

// Setting ticker_category.
$wp_customize->add_setting(
	'theme_options[ticker_category]',
	array(
		'default'           => $default['ticker_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Magazine_Power_Dropdown_Taxonomies_Control(
		$wp_customize,
		'theme_options[ticker_category]',
		array(
			'label'           => esc_html__( 'Ticker Category', 'magazine-power' ),
			'section'         => 'section_header',
			'settings'        => 'theme_options[ticker_category]',
			'priority'        => 100,
			'active_callback' => 'magazine_power_is_news_ticker_active',
		)
	)
);

// Setting ticker_number.
$wp_customize->add_setting(
	'theme_options[ticker_number]',
	array(
		'default'           => $default['ticker_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_positive_integer',
	)
);
$wp_customize->add_control(
	'theme_options[ticker_number]',
	array(
		'label'           => esc_html__( 'Number of Posts', 'magazine-power' ),
		'section'         => 'section_header',
		'type'            => 'number',
		'priority'        => 100,
		'active_callback' => 'magazine_power_is_news_ticker_active',
		'input_attrs'     => array(
			'min'   => 1,
			'max'   => 20,
			'style' => 'width: 55px;',
		),
	)
);

// Setting show_social_in_header.
$wp_customize->add_setting(
	'theme_options[show_social_in_header]',
	array(
		'default'           => $default['show_social_in_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_social_in_header]',
	array(
		'label'    => esc_html__( 'Show Social Icons', 'magazine-power' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting enable_sticky_primary_menu.
$wp_customize->add_setting(
	'theme_options[enable_sticky_primary_menu]',
	array(
		'default'           => $default['enable_sticky_primary_menu'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[enable_sticky_primary_menu]',
	array(
		'label'    => esc_html__( 'Make Primary Menu Sticky', 'magazine-power' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Layout Section.
$wp_customize->add_section(
	'section_layout',
	array(
		'title'      => esc_html__( 'Layout Options', 'magazine-power' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting(
	'theme_options[global_layout]',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[global_layout]',
	array(
		'label'    => esc_html__( 'Global Layout', 'magazine-power' ),
		'section'  => 'section_layout',
		'type'     => 'select',
		'choices'  => magazine_power_get_global_layout_options(),
		'priority' => 100,
	)
);

// Setting archive_layout.
$wp_customize->add_setting(
	'theme_options[archive_layout]',
	array(
		'default'           => $default['archive_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[archive_layout]',
	array(
		'label'    => esc_html__( 'Archive Layout', 'magazine-power' ),
		'section'  => 'section_layout',
		'type'     => 'select',
		'choices'  => magazine_power_get_archive_layout_options(),
		'priority' => 100,
	)
);
// Setting archive_image.
$wp_customize->add_setting(
	'theme_options[archive_image]',
	array(
		'default'           => $default['archive_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[archive_image]',
	array(
		'label'    => esc_html__( 'Image in Archive', 'magazine-power' ),
		'section'  => 'section_layout',
		'type'     => 'select',
		'choices'  => magazine_power_get_image_sizes_options(),
		'priority' => 100,
	)
);
// Setting archive_image_alignment.
$wp_customize->add_setting(
	'theme_options[archive_image_alignment]',
	array(
		'default'           => $default['archive_image_alignment'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[archive_image_alignment]',
	array(
		'label'           => esc_html__( 'Image Alignment in Archive', 'magazine-power' ),
		'section'         => 'section_layout',
		'type'            => 'select',
		'choices'         => magazine_power_get_image_alignment_options(),
		'priority'        => 100,
		'active_callback' => 'magazine_power_is_image_in_archive_active',
	)
);
// Setting single_image.
$wp_customize->add_setting(
	'theme_options[single_image]',
	array(
		'default'           => $default['single_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[single_image]',
	array(
		'label'    => esc_html__( 'Image in Single Post/Page', 'magazine-power' ),
		'section'  => 'section_layout',
		'type'     => 'select',
		'choices'  => magazine_power_get_image_sizes_options(),
		'priority' => 100,
	)
);
// Setting single_image_alignment.
$wp_customize->add_setting(
	'theme_options[single_image_alignment]',
	array(
		'default'           => $default['single_image_alignment'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[single_image_alignment]',
	array(
		'label'           => esc_html__( 'Image Alignment in Single Post/Page', 'magazine-power' ),
		'section'         => 'section_layout',
		'type'            => 'select',
		'choices'         => magazine_power_get_image_alignment_options(),
		'priority'        => 100,
		'active_callback' => 'magazine_power_is_image_in_single_active',
	)
);

// Blog Section.
$wp_customize->add_section(
	'section_blog',
	array(
		'title'      => esc_html__( 'Blog Options', 'magazine-power' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting excerpt_length.
$wp_customize->add_setting(
	'theme_options[excerpt_length]',
	array(
		'default'           => $default['excerpt_length'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_positive_integer',
	)
);
$wp_customize->add_control(
	'theme_options[excerpt_length]',
	array(
		'label'       => esc_html__( 'Excerpt Length', 'magazine-power' ),
		'description' => esc_html__( 'in words', 'magazine-power' ),
		'section'     => 'section_blog',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 200,
			'style' => 'width: 55px;',
		),
	)
);

// Setting read_more_text.
$wp_customize->add_setting(
	'theme_options[read_more_text]',
	array(
		'default'           => $default['read_more_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[read_more_text]',
	array(
		'label'    => esc_html__( 'Read More Text', 'magazine-power' ),
		'section'  => 'section_blog',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Author Bio Section.
$wp_customize->add_section(
	'section_author_bio',
	array(
		'title'       => esc_html__( 'Author Bio Options', 'magazine-power' ),
		'description' => esc_html__( 'Author Box will be displayed in the single post article.', 'magazine-power' ),
		'priority'    => 100,
		'capability'  => 'edit_theme_options',
		'panel'       => 'theme_option_panel',
	)
);

// Setting author_bio_in_single.
$wp_customize->add_setting(
	'theme_options[author_bio_in_single]',
	array(
		'default'           => $default['author_bio_in_single'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[author_bio_in_single]',
	array(
		'label'    => esc_html__( 'Show Author Bio', 'magazine-power' ),
		'section'  => 'section_author_bio',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting author_bio_show_recent_posts.
$wp_customize->add_setting(
	'theme_options[author_bio_show_recent_posts]',
	array(
		'default'           => $default['author_bio_show_recent_posts'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[author_bio_show_recent_posts]',
	array(
		'label'           => esc_html__( 'Show Recent Posts by Author', 'magazine-power' ),
		'section'         => 'section_author_bio',
		'type'            => 'checkbox',
		'priority'        => 100,
		'active_callback' => 'magazine_power_is_author_bio_active',
	)
);

// Setting author_bio_recent_posts_number.
$wp_customize->add_setting(
	'theme_options[author_bio_recent_posts_number]',
	array(
		'default'           => $default['author_bio_recent_posts_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_positive_integer',
	)
);
$wp_customize->add_control(
	'theme_options[author_bio_recent_posts_number]',
	array(
		'label'           => esc_html__( 'No of Recent Posts', 'magazine-power' ),
		'section'         => 'section_author_bio',
		'type'            => 'number',
		'priority'        => 100,
		'active_callback' => 'magazine_power_is_author_bio_recent_posts_active',
		'input_attrs'     => array(
			'min'   => 1,
			'max'   => 20,
			'style' => 'width: 55px;',
		),
	)
);

// Breadcrumb Section.
$wp_customize->add_section(
	'section_breadcrumb',
	array(
		'title'      => esc_html__( 'Breadcrumb Options', 'magazine-power' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting(
	'theme_options[breadcrumb_type]',
	array(
		'default'           => $default['breadcrumb_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[breadcrumb_type]',
	array(
		'label'    => esc_html__( 'Breadcrumb Type', 'magazine-power' ),
		'section'  => 'section_breadcrumb',
		'type'     => 'select',
		'choices'  => magazine_power_get_breadcrumb_type_options(),
		'priority' => 100,
	)
);

// Setting breadcrumb_home_text.
$wp_customize->add_setting(
	'theme_options[breadcrumb_home_text]',
	array(
		'default'           => $default['breadcrumb_home_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[breadcrumb_home_text]',
	array(
		'label'    => esc_html__( 'Home Text', 'magazine-power' ),
		'section'  => 'section_breadcrumb',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting breadcrumb_show_title.
$wp_customize->add_setting(
	'theme_options[breadcrumb_show_title]',
	array(
		'default'           => $default['breadcrumb_show_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[breadcrumb_show_title]',
	array(
		'label'    => esc_html__( 'Show Current Title', 'magazine-power' ),
		'section'  => 'section_breadcrumb',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Pagination Section.
$wp_customize->add_section(
	'section_pagination',
	array(
		'title'      => esc_html__( 'Pagination Options', 'magazine-power' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting(
	'theme_options[pagination_type]',
	array(
		'default'           => $default['pagination_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[pagination_type]',
	array(
		'label'    => esc_html__( 'Pagination Type', 'magazine-power' ),
		'section'  => 'section_pagination',
		'type'     => 'select',
		'choices'  => magazine_power_get_pagination_type_options(),
		'priority' => 100,
	)
);

// Footer Section.
$wp_customize->add_section(
	'section_footer',
	array(
		'title'      => esc_html__( 'Footer Options', 'magazine-power' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting(
	'theme_options[copyright_text]',
	array(
		'default'           => $default['copyright_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[copyright_text]',
	array(
		'label'    => esc_html__( 'Copyright Text', 'magazine-power' ),
		'section'  => 'section_footer',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting go_to_top.
$wp_customize->add_setting(
	'theme_options[go_to_top]',
	array(
		'default'           => $default['go_to_top'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_power_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[go_to_top]',
	array(
		'label'    => esc_html__( 'Show Go To Top', 'magazine-power' ),
		'section'  => 'section_footer',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);
