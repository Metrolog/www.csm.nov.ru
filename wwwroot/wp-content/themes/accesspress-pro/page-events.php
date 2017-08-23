<?php
/*
 * Template Name: Events
 *
 * @package accesspress_pro
 */

get_header();

global $post, $accesspress_pro_options;
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
$accesspress_pro_show_breadcrumb = $accesspress_pro_settings['show_breadcrumb'];
$accesspress_pro_event_sidebar = $accesspress_pro_settings['event_sidebar'];
$accesspress_pro_event_layout = $accesspress_pro_settings['event_layout'];
$accesspress_pro_event_grid_columns = $accesspress_pro_settings['event_grid_columns'];
$accesspress_pro_event_char = $accesspress_pro_settings['event_char'];
$accesspress_pro_read_more_text = $accesspress_pro_settings['read_more_text'];
$accesspress_pro_event_fullwidth = ($accesspress_pro_settings['event_fullwidth'] == 1) ? " fullwidth" : "";

if(!empty($accesspress_pro_header_image)){ ?>
<div id="header-banner-image">
<img src="<?php echo esc_url($accesspress_pro_header_image); ?>" alt="Header Image"/> 
</div>
<?php }
		while(have_posts()): the_post() ?>
		<header class="entry-header">
			<?php if ((function_exists('accesspress_pro_breadcrumbs') && $accesspress_pro_show_breadcrumb == 0) || empty($accesspress_pro_show_breadcrumb)) {
			accesspress_pro_breadcrumbs();
			} ?>
			<h1 class="entry-title ak-container"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="ak-container">
		<div id="primary" class="content-area<?php echo $accesspress_pro_event_fullwidth; ?>">
			
			<?php if( '' !== get_the_content() ) :?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
				
			</article><!-- #post-## -->
			<?php endif; ?>
 
		<?php endwhile; // end of the loop. ?>


		<div class="event-listing <?php echo $accesspress_pro_event_layout; ?>">

		<ul class="event-button clearfix event-order" data-option-key="sortBy">
			<li class="no-link"><?php _e('Order','accesspress-pro');?></li>
			<li data-option-value="original-order" class="is-checked"><?php _e('Posted Date','accesspress-pro');?></li>
			<li data-option-value="name"><?php _e('Alphabetical Order','accesspress-pro');?></li>
			<li data-option-value="date"><?php _e('Event Date','accesspress-pro');?></li>
		</ul>

		<ul class="event-button clearfix event-sort" data-option-key="sortAscending">
			<li class="no-link"><?php _e('Sort','accesspress-pro');?></li>
			<li data-option-value="true" class="is-checked"><?php _e('Ascending','accesspress-pro');?></li>
			<li data-option-value="false"><?php _e('Descending','accesspress-pro');?></li>
		</ul>

		<div class="clearfix"></div>

		<div id="event-grid" class="column-<?php echo $accesspress_pro_event_grid_columns; ?> clearfix">
		<?php
			$args = array (
	        'post_type' => 'events',
	        'posts_per_page' => -1,	        
	        );
	        $wp_query = new WP_Query($args); 

			while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				$accesspress_pro_event_month = get_post_meta( $post -> ID, 'accesspress_pro_event_month', true );
				$accesspress_pro_event_day = get_post_meta( $post -> ID, 'accesspress_pro_event_day', true );
				$accesspress_pro_event_year = get_post_meta( $post -> ID, 'accesspress_pro_event_year', true );
				$thumbnail_id = get_post_thumbnail_id($post->ID);
				$image = wp_get_attachment_image_src($thumbnail_id,'thumbnail','true'); 
				$image_grid = wp_get_attachment_image_src($thumbnail_id,'portfolio','true');
				$dt = strtotime("$accesspress_pro_event_day-$accesspress_pro_event_month-$accesspress_pro_event_year");  ?>
				<div class="events clearfix" data-time="<?php echo date('Y-m-d',$dt);?>">
					
					<div class="event-img">
					<?php if(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>">
						<img src="<?php if($accesspress_pro_event_layout=='event_grid') echo $image_grid[0]; else echo $image[0]; ?>"/>
						</a>
					<?php else: ?>
						<a href="<?php the_permalink(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/event-fallback.png"/>
						</a>
					<?php endif; ?>
						<div class="event-date">
							<?php echo date('M j, Y',$dt);?>
						</div>
					</div>
					
					<a class="event-short-desc" href="<?php the_permalink(); ?>">
						<h4 class="event-title"><?php the_title(); ?></h4>
						<div class="event-excerpt"><?php echo accesspress_pro_excerpt(get_the_content(),$accesspress_pro_event_char,"..."); ?></div>
					</a>
				</div>
			<?php	
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		</div>
		<?php edit_post_link( __( 'Edit', 'accesspress-pro' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
		</div><!-- #primary -->

		<?php if(is_active_sidebar($accesspress_pro_event_sidebar) && $accesspress_pro_settings['event_fullwidth'] == 0):?>
			<div id="secondary-right" class="widget-area right-sidebar sidebar"> 
				<?php dynamic_sidebar( $accesspress_pro_event_sidebar ); ?>
			</div>
		<?php endif; ?>
		</div>
<?php get_footer(); ?>