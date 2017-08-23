<?php 
global $accesspress_pro_options;
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
$accesspress_pro_tc_activate = $accesspress_pro_settings['tc_activate'];

if($accesspress_pro_tc_activate == 1 && !is_user_logged_in()){
	get_template_part('countdown');
}else if ( 'page' == get_option( 'show_on_front' ) ) {
    include( get_page_template() );
}else{

get_header(); 
$accesspress_pro_home_page_layout = $accesspress_pro_settings['home_page_layout'];
$accesspress_pro_calltoaction_text_align = $accesspress_pro_settings['calltoaction_text_align'];
$accesspress_pro_welcome_post_id = $accesspress_pro_settings['welcome_post'];
$accesspress_pro_welcome_post_readmore = $accesspress_pro_settings['welcome_post_readmore'];
$accesspress_pro_disable_event = $accesspress_pro_settings['disable_event'];
$accesspress_pro_sort_event = $accesspress_pro_settings['sort_event'];
$accesspress_pro_hide_event_date = $accesspress_pro_settings['hide_event_date'];
$accesspress_pro_featured_post1 = $accesspress_pro_settings['featured_post1'];
$accesspress_pro_featured_post2 = $accesspress_pro_settings['featured_post2'];
$accesspress_pro_featured_post3 = $accesspress_pro_settings['featured_post3'];
$accesspress_pro_featured_post4 = $accesspress_pro_settings['featured_post4'];
$accesspress_pro_featured_post5 = $accesspress_pro_settings['featured_post5'];
$accesspress_pro_featured_post6 = $accesspress_pro_settings['featured_post6'];
$accesspress_pro_featured_post7 = $accesspress_pro_settings['featured_post7'];
$accesspress_pro_featured_post8 = $accesspress_pro_settings['featured_post8'];
$accesspress_pro_featured_post9 = $accesspress_pro_settings['featured_post9'];
$accesspress_pro_featured_post_readmore = $accesspress_pro_settings['featured_post_readmore'];
$accesspress_pro_event_page_title = $accesspress_pro_settings['event_page_title'];
$accesspress_pro_show_fontawesome = $accesspress_pro_settings['show_fontawesome'];
$accesspress_pro_welcome_post_char = $accesspress_pro_settings['welcome_post_char']; 
$accesspress_pro_featured_post_char = $accesspress_pro_settings['featured_post_char']; 
$accesspress_pro_no_of_event = $accesspress_pro_settings['no_of_event'] ? $accesspress_pro_settings['no_of_event'] : '3';
$accesspress_pro_big_icons = $accesspress_pro_settings['big_icons'];
$accesspress_pro_featured_post_count = $accesspress_pro_settings['featured_post_count'];
$accesspress_pro_featured_post_column = empty($accesspress_pro_settings['featured_post_column']) ? 3 : $accesspress_pro_settings['featured_post_column'];
$accesspress_pro_calltoaction_text = $accesspress_pro_settings['calltoaction_text'];
$accesspress_pro_calltoaction_read_more_text = $accesspress_pro_settings['calltoaction_read_more_text'];
$accesspress_pro_calltoaction_read_more_link = $accesspress_pro_settings['calltoaction_read_more_link'];
$accesspress_pro_client_slider_heading = $accesspress_pro_settings['client_slider_heading'];
$accesspress_pro_disable_client_slider = $accesspress_pro_settings['disable_client_slider'];
$accesspress_pro_disable_client_slider = $accesspress_pro_settings['show_clients_logo'];
$accesspresslite_welcome_post_content = $accesspress_pro_settings['welcome_post_content'];

if( $accesspress_pro_home_page_layout != 'Layout2') { 

if(!empty($accesspress_pro_calltoaction_text)):?>
<section id="action-bar" class="<?php echo $accesspress_pro_calltoaction_text_align; ?>">
	<div class="ak-container">
		<div class="action-bar-text"><?php echo wpautop($accesspress_pro_calltoaction_text); ?></div>
		<?php if(!empty($accesspress_pro_calltoaction_read_more_text)):?>
		<a href="<?php echo esc_url($accesspress_pro_calltoaction_read_more_link); ?>" class="action-bar-button"><?php echo $accesspress_pro_calltoaction_read_more_text; ?></a>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>

<section id="top-section" class="ak-container">
<div id="welcome-text" class="clearfix<?php if($accesspress_pro_disable_event == 1){ echo ' full-width';} ?>">
	<?php
	if(!empty($accesspress_pro_welcome_post_id)){
	$posttype = get_post_type($accesspress_pro_welcome_post_id);
	$postparam = ($posttype == 'page') ? 'page_id': 'p';
	$args = array(
		'post_type' => $posttype,
		$postparam => $accesspress_pro_welcome_post_id
		);
	$query1 = new WP_Query( $args );
		while ($query1->have_posts()) : $query1->the_post(); ?>
			 
			<h1><?php the_title(); ?></h1>
			
			<?php 
			if( has_post_thumbnail() ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); 
			?>

			<figure class="welcome-text-image">
				<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
			</figure>	
			<?php } ?>
			
			
            <div  class="welcome-detail<?php if( !has_post_thumbnail() ){ echo " welcome-detail-full-width"; } ?>">
			<?php if($accesspresslite_welcome_post_content == 0 || empty($accesspresslite_welcome_post_content)){ ?>
				<p><?php echo accesspress_pro_excerpt( get_the_content() , $accesspress_pro_welcome_post_char ) ?></p>
				
				<?php if(!empty($accesspress_pro_welcome_post_readmore)){?>
					<a href="<?php the_permalink(); ?>" class="read-more bttn"><?php echo $accesspress_pro_welcome_post_readmore; ?></a>
				<?php } 
			}else{ 
				the_content();
			} ?>
			</div>
       <?php endwhile;	
		wp_reset_postdata(); 
		
		}else{ ?>
		
		<h1><a href="#">Welcome Message</a></h1>
		<figure class="welcome-text-image">
			<img src="<?php echo get_template_directory_uri(); ?>/images/demo/welcome-image.jpg" alt="welcome">
		</figure>

		<div  class="welcome-detail">
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
		<a href="#" class="read-more bttn">Read More</a>
		</div>

	<?php } ?>
</div>

<?php
if(empty($accesspress_pro_settings) || !isset($accesspress_pro_settings)){ ?>
    
    <div id="latest-events">
    <h1>Latest Events/News</h1>
    <?php for ( $event_count=1 ; $event_count < 4 ; $event_count++ ) { ?>
        <div class="event-list clearfix">
			<figure class="event-thumbnail">
				<a href="#"><img src="<?php echo get_template_directory_uri().'/images/demo/event-'.$event_count.'.jpg'; ?>" alt="<?php echo 'event'.$event_count; ?>">
				<div class="event-date">
					<span class="event-date-day"><?php echo $event_count; ?></span>
					<span class="event-date-month"><?php echo "Mar"; ?></span>
				</div>
				</a>
			</figure>	

			<div class="event-detail">
	        	<h4 class="event-title"><a href="#">Title of the event-<?php echo $event_count; ?></a></h4>

	        	<div class="event-excerpt">
	        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...
	        	</div>
        	</div>
        </div>
    <?php 
	}
	?>
	</div>
	
<?php
}else{
 
	if($accesspress_pro_disable_event != 1 || empty($accesspress_pro_disable_event)):
	?>
	<div id="latest-events">
		<?php
		if(is_active_sidebar('event-sidebar')) :
			dynamic_sidebar('event-sidebar');
		else:
			if($accesspress_pro_sort_event == 1){
				$args = array(
			        'post_type' => 'events',
			        'posts_per_page' => $accesspress_pro_no_of_event,
			        'meta_key'   => 'accesspress_pro_event_date',
			        'orderby' => 'meta_value_num',
			        'order' => 'ASC', 
			        'meta_query' => array(
		                array(
		                    'key' => 'accesspress_pro_event_date',
		                    'value' => (time(get_the_date()) - 86400),
		                    'compare' => '>=',
		                ),
			        ),
			    );
			}else{
				$args = array(
			        'post_type' => 'events',
			        'posts_per_page' => $accesspress_pro_no_of_event,
		    	);
			}

			$query2 = new WP_Query($args); 

		    if($query2->have_posts()): ?>
		    <h1><?php echo $accesspress_pro_event_page_title; ?></h1>
		    <?php
		    	while ($query2->have_posts()) : $query2->the_post();
		    	$accesspress_pro_event_day = get_post_meta( $post->ID, 'accesspress_pro_event_day', true );
				$accesspress_pro_event_month = get_post_meta( $post->ID, 'accesspress_pro_event_month', true );
				$accesspress_pro_event_year = get_post_meta( $post->ID, 'accesspress_pro_event_year', true );
				$accesspress_pro_event_date = get_post_meta( $post->ID, 'accesspress_pro_event_date', true );
		    ?>
		    <div class="event-list clearfix">
		        <figure class="event-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php 
						if( has_post_thumbnail() ){
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'event-thumbnail', false ); 
						?>
						<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
						<?php } else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/images/demo/event-fallback.jpg" alt="<?php the_title(); ?>">
						<?php } ?>
						
						<?php if( $accesspress_pro_hide_event_date != 1 ){	?>	
						<div class="event-date">
							<span class="event-date-day"><?php echo $accesspress_pro_event_day; ?></span>
							<span class="event-date-month"><?php echo $accesspress_pro_event_month; ?></span>
						</div>
						<?php } ?>
					</a>
				</figure>	

				<div class="event-detail">
			        <h4 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

			        <div class="event-excerpt">
			        	<?php echo accesspress_pro_excerpt( get_the_content() , 100 ) ?>
			        </div>
		        </div>
		    </div>
	        <?php 
	        	endwhile; 
	        ?>
		    <?php wp_reset_postdata(); 
			else: 
		   		echo "<p>No Events Found!</p>"; 
		   	endif;  
		endif; ?>	    			
	</div>
	<?php 
	endif; 
} ?>
</section>

<section id="mid-section" class="ak-container">
<div class="clearfix featured-wrap<?php echo ' column-'.$accesspress_pro_featured_post_column; ?>">
<?php 
if(!empty($accesspress_pro_featured_post1) ){
	for($count=1; $count <= $accesspress_pro_featured_post_count; $count++){
	$accesspress_pro_featured_post = 'accesspress_pro_featured_post'.$count;
    if(!empty($$accesspress_pro_featured_post)) { ?>
		<div class="featured-post featured-post-<?php echo $count; if($accesspress_pro_big_icons == 1){ echo ' big-icon'; } ?>">
			
			<?php
				$posttype = get_post_type($$accesspress_pro_featured_post);
				$postparam = ($posttype == 'page') ? 'page_id': 'p';
				$args = array(
					'post_type' => $posttype,
					$postparam => $$accesspress_pro_featured_post
				);
				$query4 = new WP_Query( $args );
				// the Loop
				while ($query4->have_posts()) : $query4->the_post(); 
					
					if( $accesspress_pro_show_fontawesome == 0 ){
					?>
					<figure class="featured-image">
						<a href="<?php the_permalink(); ?>">
                        <div class="featured-overlay">
                			<span class="overlay-plus font-icon-plus"></span>
                		</div>
							<?php 							
							if( has_post_thumbnail()){
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
							?>
							<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
							<?php }else { ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/demo/featured-fallback.jpg" alt="<?php the_title(); ?>">
							<?php } 
							?>
						</a>
					</figure>
					<?php } ?>	

					<h2 class="<?php if($accesspress_pro_show_fontawesome == 1){ echo 'has-icon'; }?>">
					<a href="<?php the_permalink(); ?>">
					<?php 
					if($accesspress_pro_show_fontawesome == 1){ ?>

					<i class="fa <?php echo $accesspress_pro_settings['featured_post'.$count.'_icon'] ?>"></i>
							
					<?php } ?>
					<span><?php the_title(); ?></span>
					</a>
					</h2>

					<div class="featured-content">
						<p><?php echo accesspress_pro_excerpt( get_the_content() , $accesspress_pro_featured_post_char ) ?></p>
						<?php if(!empty($accesspress_pro_featured_post_readmore)): ?>
						<a href="<?php the_permalink(); ?>" class="read-more bttn"><?php echo $accesspress_pro_featured_post_readmore; ?></a>
						<?php endif; ?>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
		
		</div>
	<?php 
    if($count % $accesspress_pro_featured_post_column == 0){echo '<div class="clearfix"></div>';}
	}
	}
	}else{ ?>
	<?php for($featured_post=1 ; $featured_post < 4; $featured_post++){ ?>
	<div id="featured-post-<?php echo $featured_post; ?>" class="featured-post">

		<figure class="featured-image">
		<a href="#">
		<div class="featured-overlay">
			<span class="overlay-plus font-icon-plus"></span>
		</div>

		<img src="<?php echo get_template_directory_uri().'/images/demo/featuredimage-'.$featured_post.'.jpg' ?>" alt="<?php echo 'featuredpost'.$featured_post; ?>">
		</a>
		</figure>

		<h2><a href="#">Featured Post <?php echo $featured_post; ?></a></h2>

		<div class="featured-content">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate...</p>
			<a href="#" class="read-more bttn">Read More</a>
		</div>
	</div>

	<?php 
	} ?>
	<?php } ?>
</div>
</section>

<?php
if ( is_active_sidebar( 'textblock-1' ) || is_active_sidebar( 'textblock-2' ) || is_active_sidebar( 'textblock-3' )) : ?>
	<section id="bottom-section">
		<div class="ak-container">
	    <div class="clearfix bottom-section-wrap <?php echo accesspress_pro_featuredcolumn(); ?>">    
			<?php if ( is_active_sidebar( 'textblock-1' ) ) : ?>
				<div class="featured-column clearfix">
					<div class="featured-column-wrap">
					<?php dynamic_sidebar( 'textblock-1' );  ?>
					</div>
				</div>
			<?php endif; ?>	
			
	        <?php if ( is_active_sidebar( 'textblock-2' ) ) : ?> 
		        <div class="featured-column clearfix">
			        <div class="featured-column-wrap">
					<?php dynamic_sidebar( 'textblock-2' ); ?>
					</div>
				</div> 
			<?php endif; ?>
			       
	 		<?php if ( is_active_sidebar( 'textblock-3' ) ) : ?> 
		 		<div class="featured-column clearfix">
			 		<div class="featured-column-wrap">
					<?php dynamic_sidebar( 'textblock-3' ); ?>
					</div>
				</div>
			<?php endif; ?>
			
		</div>
	</section>
	<?php 
	endif;  

if ( is_active_sidebar( 'text-bar' ) ) : ?>
	<section class="home-text-bar ak-container clearfix">
        <?php dynamic_sidebar( 'text-bar' );  ?>
	</section>
<?php 
endif;

} ?>

<?php if($accesspress_pro_home_page_layout == 'Layout1' || $accesspress_pro_home_page_layout == 'Layout2'){ ?>
<section id="blog-post">
	<div class="ak-container home-blog">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>

			<?php 
			while ( have_posts() ) : the_post(); 
				get_template_part( 'content', 'summary' );
			endwhile; 
			?>

			<?php accesspress_pro_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		<?php wp_reset_query(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	
	<div id="secondary-right" class="widget-area right-sidebar sidebar">
		<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
	</div>
</section>

<?php } ?>

<?php
if ( is_active_sidebar( 'left-block' ) || is_active_sidebar( 'middle-block' ) || is_active_sidebar( 'right-block' )) : ?>
	<section id="bottom-bar-section">
		<div class="ak-container">
	    <div class="bottom-bar-wrap clearfix">    
			<?php if ( is_active_sidebar( 'left-block' ) ) : ?>
				<div class="bottom-bar-column clearfix">
					<?php dynamic_sidebar( 'left-block' );  ?>
				</div>
			<?php endif; ?>	
			
	        <?php if ( is_active_sidebar( 'middle-block' ) ) : ?> 
		        <div class="bottom-bar-column clearfix">
					<?php dynamic_sidebar( 'middle-block' ); ?>
				</div> 
			<?php endif; ?>
			       
	 		<?php if ( is_active_sidebar( 'right-block' ) ) : ?> 
		 		<div class="bottom-bar-column clearfix">
					<?php dynamic_sidebar( 'right-block' ); ?>
				</div>
			<?php endif; ?>
		</div>	
		</div>
	</section>
	<?php 
endif; 

if($accesspress_pro_disable_client_slider == 1):
$query3 = new WP_Query( array(
    'post_type' => 'logo',
    'posts_per_page' => -1,
    )); ?>
<?php if ($query3->have_posts()) : ?>
<section id="clients-logo">
    <div class="ak-container">
    <?php if(!empty($accesspress_pro_client_slider_heading)): ?>
		<h2><?php echo $accesspress_pro_client_slider_heading; ?></h2>
	<?php endif; ?>
        <div class="logo-slider">
        <?php while ($query3->have_posts()) : $query3->the_post(); ?>
        	<?php 
        	$imageid = get_post_thumbnail_id( $post->ID ) ;
        	$image = wp_get_attachment_image_src($imageid,'full',false) ;
        	?>
			<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
		<?php endwhile; ?>
    	</div>
    </div>
</section>
<?php endif; 
wp_reset_postdata(); 
endif;

get_footer(); 
}