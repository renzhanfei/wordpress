<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazine_Power
 */

?>
<?php
	/**
	 * Hook - magazine_power_action_doctype.
	 *
	 * @hooked magazine_power_doctype -  10
	 */
	do_action( 'magazine_power_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - magazine_power_action_head.
	 *
	 * @hooked magazine_power_head -  10
	 */
	do_action( 'magazine_power_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'wp_body_open' ); ?>

	<?php
	/**
	 * Hook - magazine_power_action_before.
	 *
	 * @hooked magazine_power_page_start - 10
	 * @hooked magazine_power_skip_to_content - 15
	 */
	do_action( 'magazine_power_action_before' );
	?>

	<?php
	/**
	 * Hook - magazine_power_action_before_header.
	 *
	 * @hooked magazine_power_header_start - 10
	 */
	do_action( 'magazine_power_action_before_header' );
	?>
		<?php
		/**
		 * Hook - magazine_power_action_header.
		 *
		 * @hooked magazine_power_site_branding - 10
		 */
		do_action( 'magazine_power_action_header' );
		?>
	<?php
	/**
	 * Hook - magazine_power_action_after_header.
	 *
	 * @hooked magazine_power_header_end - 10
	 */
	do_action( 'magazine_power_action_after_header' );
	?>

	<?php
	/**
	 * Hook - magazine_power_action_before_content.
	 *
	 * @hooked magazine_power_add_breadcrumb - 7
	 * @hooked magazine_power_content_start - 10
	 */
	do_action( 'magazine_power_action_before_content' );
	?>
	<?php
	/**
	 * Hook - magazine_power_action_content.
	 */
	do_action( 'magazine_power_action_content' );
	?>
