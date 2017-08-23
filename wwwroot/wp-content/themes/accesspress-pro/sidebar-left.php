<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package accesspress_pro
 */
?>

<?php 
global $post, $accesspress_pro_options;
$accesspress_pro_post_type = get_post_type();
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
$event_singlepage_left_sidebar = $accesspress_pro_settings['event_singlepage_left_sidebar'];
$portfolio_singlepage_left_sidebar = $accesspress_pro_settings['portfolio_singlepage_left_sidebar'];

if(is_singular()){
	$post_class = get_post_meta( $post -> ID, 'accesspress_pro_sidebar_layout', true );
}else{
	$post_class = "right-sidebar";
}

if($post_class=='left-sidebar' || $post_class=='both-sidebar' ){ 

if($accesspress_pro_post_type == 'events'): ?>
    <div id="secondary-left" class="widget-area left-sidebar sidebar">
		<?php if ( is_active_sidebar( $event_singlepage_left_sidebar ) ) : ?>
			<?php dynamic_sidebar( $event_singlepage_left_sidebar ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
<?php endif; 

if($accesspress_pro_post_type == 'portfolio'): ?>
    <div id="secondary-left" class="widget-area left-sidebar sidebar">
		<?php if ( is_active_sidebar( $portfolio_singlepage_left_sidebar ) ) : ?>
			<?php dynamic_sidebar( $portfolio_singlepage_left_sidebar ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
<?php endif; 

if($accesspress_pro_post_type != 'events' && $accesspress_pro_post_type != 'portfolio'): ?>
	<div id="secondary-left" class="widget-area left-sidebar sidebar">
		<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'left-sidebar' ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
<?php endif; ?>

<?php } ?>