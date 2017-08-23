<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package accesspress_pro
 */

global $post, $accesspress_pro_options;
$accesspress_pro_post_type = get_post_type();
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
$event_singlepage_right_sidebar = $accesspress_pro_settings['event_singlepage_right_sidebar'];
$portfolio_singlepage_right_sidebar = $accesspress_pro_settings['portfolio_singlepage_right_sidebar'];
$faq_right_sidebar = $accesspress_pro_settings['faq_right_sidebar'];
if(is_singular()){
	$post_class = get_post_meta( $post -> ID, 'accesspress_pro_sidebar_layout', true );
}else{
	$post_class = "right-sidebar";
}

if($accesspress_pro_post_type == 'faqs'): ?>
    <div id="secondary-right" class="widget-area right-sidebar sidebar">
		<?php if ( is_active_sidebar( $faq_right_sidebar ) ) : ?>
			<?php dynamic_sidebar( $faq_right_sidebar ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
<?php endif;


if($post_class=='right-sidebar' || $post_class=='both-sidebar' || empty($post_class)){

if($accesspress_pro_post_type == 'events'): ?>
    <div id="secondary-right" class="widget-area right-sidebar sidebar">
		<?php if ( is_active_sidebar( $event_singlepage_right_sidebar ) ) : ?>
			<?php dynamic_sidebar( $event_singlepage_right_sidebar ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
<?php endif; 

if($accesspress_pro_post_type == 'portfolio'): ?>
    <div id="secondary-right" class="widget-area right-sidebar sidebar">
		<?php if ( is_active_sidebar( $portfolio_singlepage_right_sidebar ) ) : ?>
			<?php dynamic_sidebar( $portfolio_singlepage_right_sidebar ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
<?php endif;

if($accesspress_pro_post_type != 'events' && $accesspress_pro_post_type != 'portfolio' && $accesspress_pro_post_type != 'faqs'): ?>
	<div id="secondary-right" class="widget-area right-sidebar sidebar">
		<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
<?php endif; ?>

<?php } ?>
