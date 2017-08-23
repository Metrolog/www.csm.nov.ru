<?php
/*
 * Template Name: Portfolio
 *
 * @package accesspress_pro
 */

get_header();

global $post, $accesspress_pro_options;
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
$accesspress_pro_show_breadcrumb = $accesspress_pro_settings['show_breadcrumb'];
$accesspress_pro_portfolio_sidebar = $accesspress_pro_settings['portfolio_sidebar'];
$accesspress_pro_portfolio_grid_columns = $accesspress_pro_settings['portfolio_grid_columns'];
$accesspress_pro_portfolio_grid_char = $accesspress_pro_settings['portfolio_grid_char'];
$accesspress_pro_portfolio_layout = $accesspress_pro_settings['portfolio_layout'];
$accesspress_pro_read_more_text = $accesspress_pro_settings['read_more_text'];
$accesspress_pro_portfolio_fullwidth = ($accesspress_pro_settings['portfolio_fullwidth'] == 1) ? " fullwidth" : "";
$accesspress_pro_header_image = get_post_meta( $post -> ID, 'accesspress_pro_page_header_image', true );


if(!empty($accesspress_pro_header_image)){ ?>
<div id="header-banner-image">
<img src="<?php echo esc_url($accesspress_pro_header_image); ?>" alt="Header Image"/> 
</div>
<?php }
		while(have_posts()): the_post() ?>
		<header class="entry-header">
			<?php 
			if ((function_exists('accesspress_pro_breadcrumbs') && $accesspress_pro_show_breadcrumb == 0) || empty($accesspress_pro_show_breadcrumb)) {
					accesspress_pro_breadcrumbs();
			} ?>
			<h1 class="entry-title ak-container"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="ak-container">
		<div id="primary" class="content-area<?php echo $accesspress_pro_portfolio_fullwidth; ?>">
		<?php if( '' !== get_the_content() ) :?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
				
			</article><!-- #post-## -->
		<?php endif; ?>
		<?php endwhile; // end of the loop. ?>


		<div class="portfolio-listing <?php echo $accesspress_pro_portfolio_layout; ?>">
		<?php
		$args = array(
	    'orderby'    => 'count',
		); 

		$portfolio_categories = get_terms( 'portfolio-category', $args );
		if(!empty($portfolio_categories) && !is_wp_error($portfolio_categories)):
			echo "<ul class='button-group clearfix'>";
			echo '<li class="no-link">'. __('Category','accesspress_pro').'</li>';
			echo '<li data-filter="*" class="is-checked">'. __('All','accesspress_pro').'</li>';
			foreach ($portfolio_categories as $portfolio_category) :
				echo "<li data-filter='.port-cat".$portfolio_category->term_id."'>" . $portfolio_category->name . "</li>";
			endforeach;
			echo "</ul>";
		endif;
		wp_reset_query();
		?>

		<div id="portfolio-grid" class="column-<?php echo $accesspress_pro_portfolio_grid_columns; ?> clearfix">
		<?php
			$args = array (
	         'post_type' => 'portfolio',
	         'post_status' => 'publish',
	         'posts_per_page' => -1,
			 );
	        $wp_query = new WP_Query($args);
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				$term_lists = wp_get_post_terms($post->ID, 'portfolio-category', array("fields" => "all"));
				$term_slugs = array();
				foreach ($term_lists as $term_list) {
					$term_slugs[] = 'port-cat'.$term_list->term_id;
				}
				$term_slugs = join( ' ', $term_slugs );
                ?>
				<div class="portfolios clearfix <?php echo $term_slugs; ?>">
				<div class="portfolios-inner">
					<div class="portfolios-bg"></div>
                    <a href="<?php the_permalink(); ?>">
                    <?php 
                    if(has_post_thumbnail()){
                        $thumbnail_id = get_post_thumbnail_id($post->ID);
        				$image = wp_get_attachment_image_src($thumbnail_id,'portfolio-thumbnail','true'); 
        				$image_large = wp_get_attachment_image_src($thumbnail_id,'large','true'); 
                    ?>
					   <img src="<?php echo $image[0]; ?>"/>
                    <?php }else{  ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/portfolio-fallback.jpg"/>
                    <?php } ?>
                    </a> 
					<div class="portfolio-short-desc">
						<h4 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="portfolio-excerpt"><?php echo accesspress_pro_excerpt(get_the_content(),$accesspress_pro_portfolio_grid_char,"..."); ?></div>
						<a class="portfolio-link" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
						<a class="portfolio-image" href="<?php echo $image_large[0];?>"><i class="fa fa-arrows-alt"></i></a>
						<?php if(!empty($accesspress_pro_read_more_text)):?>
							<a href="<?php the_permalink(); ?>" class="bttn"><?php echo $accesspress_pro_read_more_text; ?></a>
						<?php endif; ?>
					</div>
				</div>
				</div>
			<?php	
			endwhile;
			?>
		</div>
		<?php 
		wp_reset_postdata();
		?>
		</div>
		</div><!-- #primary -->

		<?php if(is_active_sidebar($accesspress_pro_portfolio_sidebar) && $accesspress_pro_settings['portfolio_fullwidth'] == 0):?>
			<div id="secondary-right" class="widget-area right-sidebar sidebar"> 
				<?php dynamic_sidebar( $accesspress_pro_portfolio_sidebar ); ?>
			</div>
		<?php endif; ?>
		</div>
<?php get_footer(); ?>