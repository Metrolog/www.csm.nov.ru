<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Accesspress Pro
 */

global $accesspress_pro_options;
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
	<?php 
		if ( is_active_sidebar( 'footer-1' ) ||  is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' )  || is_active_sidebar( 'footer-4' ) ) : ?>
		<div id="top-footer">
		<div class="ak-container">
		<div class="clearfix top-footer-wrap <?php echo accesspress_pro_footercolumn(); ?>">	
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="footer1 footer">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>
			<?php endif; ?>	
			
			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<div class="footer2 footer">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div>
			<?php endif; ?>	
            
            <div class="clearfix hide"></div>
			
			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="footer3 footer">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div>
			<?php endif; ?>	
			
			<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
			<div class="footer4 footer">
				<?php dynamic_sidebar( 'footer-4' ); ?>
			</div>
			<?php endif; ?>	
		</div>
		</div>
		</div>
		<?php endif; ?>

		
		<div id="bottom-footer">
		<div class="ak-container">
			<div class="site-info">
				<?php if(!empty($accesspress_pro_settings['right_footer_text'])){
					echo $accesspress_pro_settings['right_footer_text']; 
					} ?>
			</div><!-- .site-info -->

			<div class="copyright">
				<?php _e('Copyright','accesspress-pro'); ?> &copy; <?php echo date('Y') ?> 
				<a href="<?php echo home_url(); ?>">
				<?php if(!empty($accesspress_pro_settings['footer_copyright'])){
					echo $accesspress_pro_settings['footer_copyright']; 
					} ?>
				</a>
			</div>
		</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div id="ak-top"><i class="fa fa-angle-up"></i><?php _e('Top','accesspress-pro'); ?></div>
<?php wp_footer(); ?>
</body>
</html>
