<?php
/*
 * Template Name: FAQ
 *
 * @package accesspress_pro
 */

get_header();

global $post, $accesspress_pro_options;
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
$accesspress_pro_show_breadcrumb = $accesspress_pro_settings['show_breadcrumb'];
$accesspress_pro_faq_right_sidebar = $accesspress_pro_settings['faq_right_sidebar'];
$accesspress_pro_faq_fullwidth = ($accesspress_pro_settings['faq_fullwidth'] == 1) ? " fullwidth" : "" ;
$accesspress_pro_faq_answer_toggle = $accesspress_pro_settings['faq_answer_toggle'];

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
		<div id="primary" class="content-area<?php echo $accesspress_pro_faq_fullwidth; ?>">
			
			<?php if( '' !== get_the_content() ) :?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
				
			</article><!-- #post-## -->
			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>


		<div class="faq-listing <?php echo $accesspress_pro_faq_answer_toggle; ?>">
		<?php
			$args = array (
	         'post_type' => 'faqs',
	         'post_status' => 'publish',
	         'posts_per_page' => -1,
	         'paged' => $paged,
	        );
	        $wp_query = new WP_Query($args); 

			while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<div class="faqs clearfix">					
					<div class="faq-question"><?php the_title(); ?></div>
					<div class="faq-answer"><?php the_content() ?></div>
				</div>
			<?php	
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		</div><!-- #primary -->

		<?php if(is_active_sidebar($accesspress_pro_faq_right_sidebar) && $accesspress_pro_settings['faq_fullwidth'] == 0):?>
			<div id="secondary-right" class="widget-area right-sidebar sidebar"> 
				<?php dynamic_sidebar( $accesspress_pro_faq_right_sidebar ); ?>
			</div>
		<?php endif; ?>
		</div>
<?php get_footer(); ?>