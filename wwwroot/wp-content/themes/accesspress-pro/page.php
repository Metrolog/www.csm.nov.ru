<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Accesspress Pro
 */

get_header(); 
global $post, $accesspress_pro_options;
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
$accesspress_pro_show_breadcrumb = $accesspress_pro_settings['show_breadcrumb'];
$accesspress_pro_show_comments = $accesspress_pro_settings['show_comments'];
$accesspress_pro_header_image = get_post_meta( $post->ID, 'accesspress_pro_page_header_image', true );
if(is_front_page()){
	$post_id = get_option('page_on_front');
}else{
	$post_id = $post->ID;
}
$post_class = get_post_meta( $post_id , 'accesspress_pro_sidebar_layout', true );
?>

<?php if(!empty($accesspress_pro_header_image)){ ?>
	<div id="header-banner-image">
	<img src="<?php echo esc_url($accesspress_pro_header_image); ?>" alt="Header Image"/> 
	</div>
<?php } ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="entry-header">
			<?php 
			if ((function_exists('accesspress_pro_breadcrumbs') && $accesspress_pro_show_breadcrumb == 0) || empty($accesspress_pro_show_breadcrumb)) {
				accesspress_pro_breadcrumbs();
			} ?>
			<h1 class="entry-title ak-container"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->
		<div class="ak-container">
		
		<?php 
		if ($post_class=='both-sidebar') { ?>
			<div id="primary-wrap" class="clearfix"> 
		<?php } ?>

		<div id="primary" class="content-area">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'accesspress-pro' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
				<?php edit_post_link( __( 'Edit', 'accesspress-pro' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
			</article><!-- #post-## -->

			<?php if($accesspress_pro_show_comments == 1):
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			endif;
			?>

		<?php endwhile; // end of the loop. ?>
		</div><!-- #primary -->

		<?php 
		get_sidebar('left'); 

		if ($post_class=='both-sidebar') { ?>
			</div> 
		<?php }

		get_sidebar('right'); ?>
		</div>
<?php get_footer(); ?>