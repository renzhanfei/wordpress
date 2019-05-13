<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazine_Power
 */

	/**
	 * Hook - magazine_power_action_after_content.
	 *
	 * @hooked magazine_power_content_end - 10
	 */
	do_action( 'magazine_power_action_after_content' );
?>

	<?php
	/**
	 * Hook - magazine_power_action_before_footer.
	 *
	 * @hooked magazine_power_footer_start - 10
	 */
	do_action( 'magazine_power_action_before_footer' );
	?>
	<?php
	/**
	 * Hook - magazine_power_action_footer.
	 *
	 * @hooked magazine_power_footer_copyright - 10
	 */
	do_action( 'magazine_power_action_footer' );
	?>
	<?php
	/**
	 * Hook - magazine_power_action_after_footer.
	 *
	 * @hooked magazine_power_footer_end - 10
	 */
	do_action( 'magazine_power_action_after_footer' );
	?>

<?php
	/**
	 * Hook - magazine_power_action_after.
	 *
	 * @hooked magazine_power_page_end - 10
	 * @hooked magazine_power_footer_goto_top - 20
	 */
	do_action( 'magazine_power_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
