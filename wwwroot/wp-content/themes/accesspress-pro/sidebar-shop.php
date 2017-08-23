<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package accesspress_pro
 */
?>

<div id="secondary-right" class="widget-area right-sidebar sidebar">
	<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'shop-sidebar' ); ?>
	<?php endif; ?>
</div><!-- #secondary -->
