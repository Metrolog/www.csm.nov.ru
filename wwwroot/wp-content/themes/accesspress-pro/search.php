<?php
/**
 * The template for displaying search results pages.
 *
 * @package Accesspress Pro
 */

get_header(); 
global $accesspress_pro_options;
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
$accesspress_pro_show_breadcrumb = $accesspress_pro_settings['show_breadcrumb'];
?>
	<header class="entry-header">
	<?php 
	if ((function_exists('accesspress_pro_breadcrumbs') && $accesspress_pro_show_breadcrumb == 0) || empty($accesspress_pro_show_breadcrumb)) {
			accesspress_pro_breadcrumbs();
	} ?>
	<h1 class="entry-title ak-container"><?php printf( __( 'Search Results for: %s', 'accesspress-pro' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

			<div class="ak-container">
			<div id="primary" class="content-area">
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'summary' );
				?>

			<?php endwhile; ?>

			<?php accesspress_pro_paging_nav(); ?>

			<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
			</div>

		<?php get_sidebar('right'); ?>

		</div>


<?php get_footer(); ?>
