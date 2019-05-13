<?php
//about theme info
add_action( 'admin_menu', 'skt_contractor_abouttheme' );
function skt_contractor_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-contractor'), esc_html__('About Theme', 'skt-contractor'), 'edit_theme_options', 'skt_contractor_guide', 'skt_contractor_mostrar_guide');   
} 
//guidline for about theme
function skt_contractor_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'skt-contractor'); ?>
		   </div>
          <p><?php esc_attr_e('SKT Contractor is a construction company, real estate agency, interior design, architecture, builder, house broker, concrete, cement, furtniture, furnishings, handyman, maintenance solutions, repair, renovation, industrial, roofing, flooring services type of template.  Call to action, responsive, speed optimized, SEO friendly and multilingual plugins friendly.','skt-contractor'); ?></p>
		  <a href="<?php echo esc_url(SKT_CONTRACTOR_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_CONTRACTOR_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_attr_e('Live Demo', 'skt-contractor'); ?></a> | 
				<a href="<?php echo esc_url(SKT_CONTRACTOR_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_attr_e('Buy Pro', 'skt-contractor'); ?></a> | 
				<a href="<?php echo esc_url(SKT_CONTRACTOR_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_attr_e('Documentation', 'skt-contractor'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_CONTRACTOR_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>