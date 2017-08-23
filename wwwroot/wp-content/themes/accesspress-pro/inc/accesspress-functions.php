<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Accesspress Pro
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function accesspress_pro_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'accesspress_pro_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function accesspress_pro_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'accesspress_pro_body_classes' );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function accesspress_pro_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'accesspress_pro_setup_author' );


/**
 * Register widgetized area and update sidebar with default widgets.
 */
function accesspress_pro_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'accesspress-pro' ),
		'id'            => 'left-sidebar',
		'description'   => 'Display items in the Left Sidebar of the inner pages',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '<span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'accesspress-pro' ),
		'id'            => 'right-sidebar',
		'description'   => 'Display items in the Right Sidebar of the inner pages',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '<span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Event Sidebar', 'accesspress-pro' ),
		'id'            => 'event-sidebar',
		'description'   => 'Display items in the home page inplace of Event Listing',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '<span></h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'accesspress-pro' ),
		'id'            => 'shop-sidebar',
		'description'   => 'Display items in the Right Sidebar of the woocommerce pages',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '<span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Featured Bar Column One', 'accesspress-pro' ),
		'id'            => 'textblock-1',
		'description'   => 'Display items in the left just above the footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Featured Bar Column Two', 'accesspress-pro' ),
		'id'            => 'textblock-2',
		'description'   => 'Display items in the middle just above the footer and replaces defaul gallery',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Featured Bar Column Three', 'accesspress-pro' ),
		'id'            => 'textblock-3',
		'description'   => 'Display items in the right just above the footer and replaces testimonial',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Home Page Featured Text', 'accesspress-pro' ),
		'id'            => 'text-bar',
		'description'   => 'Display items in the Home page Above Footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '<span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Left Block above footer', 'accesspress-pro' ),
		'id'            => 'left-block',
		'description'   => 'Display items in above Footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Middle Block above footer', 'accesspress-pro' ),
		'id'            => 'middle-block',
		'description'   => 'Display items in above Footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Right Block above footer', 'accesspress-pro' ),
		'id'            => 'right-block',
		'description'   => 'Display items in above Footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area Column One', 'accesspress-pro' ),
		'id'            => 'footer-1',
		'description'   => 'Display items in First Footer Area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area Column Two', 'accesspress-pro' ),
		'id'            => 'footer-2',
		'description'   => 'Display items in Second Footer Area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area Column Three', 'accesspress-pro' ),
		'id'            => 'footer-3',
		'description'   => 'Display items in Third Footer Area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area Column Four', 'accesspress-pro' ),
		'id'            => 'footer-4',
		'description'   => 'Display items in Fourth Footer Area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Widget Block one', 'accesspress-pro' ),
		'id'            => 'widgetblock-1',
		'description'   => 'Display items to assign the sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Widget Block Two', 'accesspress-pro' ),
		'id'            => 'widgetblock-2',
		'description'   => 'Display items to assign the sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Widget Block Three', 'accesspress-pro' ),
		'id'            => 'widgetblock-3',
		'description'   => 'Display items to assign the sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'accesspress_pro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function accesspress_pro_scripts() {
	global $accesspress_pro_options;
	$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
	
	wp_enqueue_style( 'googleFonts', '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,300,700|Open+Sans+Condensed:300,300italic,700' );
	wp_enqueue_style( 'font-css', get_template_directory_uri() . '/css/fonts.css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/css/nivo-lightbox.css' );
	wp_enqueue_style( 'bx-slider-style', get_template_directory_uri() . '/css/jquery.bxslider.css' );
	wp_enqueue_style( 'sequence-slider-style', get_template_directory_uri() . '/css/sequence-slider.css' );
	wp_enqueue_style( 'superfish-style', get_template_directory_uri() . '/css/superfish.css' );
	wp_enqueue_style( 'timecircle-style', get_template_directory_uri() . '/css/TimeCircles.css' );
	wp_enqueue_style( 'accesspress_pro-style', get_stylesheet_uri() );

	/* Loads up responsive css if it is not disabled */

	if ( $accesspress_pro_settings[ 'responsive_design' ] == 0 ) {	
		wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css' );
	}

	wp_enqueue_script( 'jquery'); 
	wp_enqueue_script( 'accesspress-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'Time-plugins', get_template_directory_uri() . '/js/TimeCircles.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true );
 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'accesspress_pro_scripts' );

function accesspress_dynamic_styles() {
	wp_enqueue_style( 'accesspress_parallax-dynamic-style', get_template_directory_uri() . '/css/style.php' );
}
add_action( 'wp_enqueue_scripts', 'accesspress_dynamic_styles', 15 );

/**
* Loads up favicon
*/
	function accesspress_pro_add_favicon(){
		global $accesspress_pro_options;
		$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
		
		if( !empty($accesspress_pro_settings[ 'media_upload' ])){
		echo '<link rel="shortcut icon" type="image/png" href="'. $accesspress_pro_settings[ 'media_upload' ].'"/>';
		}
	}
	add_action('wp_head', 'accesspress_pro_add_favicon');

	function accesspress_pro_social_cb(){ 
		global $accesspress_pro_options;
		$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
		?>
		<div class="socials">
		<?php if(!empty($accesspress_pro_settings['facebook'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['facebook']); ?>" class="facebook" data-title="Facebook" target="_blank"><span class="font-icon-social-facebook"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['twitter'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['twitter']); ?>" class="twitter" data-title="Twitter" target="_blank"><span class="font-icon-social-twitter"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['gplus'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['gplus']); ?>" class="gplus" data-title="Google Plus" target="_blank"><span class="font-icon-social-google-plus"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['youtube'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['youtube']); ?>" class="youtube" data-title="Youtube" target="_blank"><span class="font-icon-social-youtube"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['pinterest'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['pinterest']); ?>" class="pinterest" data-title="Pinterest" target="_blank"><span class="font-icon-social-pinterest"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['linkedin'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['linkedin']); ?>" class="linkedin" data-title="Linkedin" target="_blank"><span class="font-icon-social-linkedin"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['flickr'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['flickr']); ?>" class="flickr" data-title="Flickr" target="_blank"><span class="font-icon-social-flickr"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['vimeo'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['vimeo']); ?>" class="vimeo" data-title="Vimeo" target="_blank"><span class="font-icon-social-vimeo"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['stumbleupon'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['stumbleupon']); ?>" class="stumbleupon" data-title="Stumbleupon" target="_blank"><span class="font-icon-social-stumbleupon"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['dribble'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['dribble']); ?>" class="dribble" data-title="dribble" target="_blank"><span class="fa fa-dribbble"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['stumbleupon'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['tumblr']); ?>" class="tumblr" data-title="Tumblr" target="_blank"><span class="font-icon-social-tumblr"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['instagram'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['instagram']); ?>" class="instagram" data-title="instagram" target="_blank"><span class="fa fa-instagram"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['sound_cloud'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['sound_cloud']); ?>" class="sound-cloud" data-title="sound-cloud" target="_blank"><span class="font-icon-social-soundcloud"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['skype'])){ ?>
		<a href="<?php echo esc_attr($accesspress_pro_settings['skype']); ?>" class="skype" data-title="Skype" target="_blank"><span class="font-icon-social-skype"></span></a>
		<?php } ?>

		<?php if(!empty($accesspress_pro_settings['rss'])){ ?>
		<a href="<?php echo esc_url($accesspress_pro_settings['rss']); ?>" class="rss" data-title="RSS" target="_blank"><span class="font-icon-rss"></span></a>
		<?php } ?>
		</div>
	<?php } 

	add_action( 'accesspress_pro_social_links', 'accesspress_pro_social_cb');	

	function accesspress_pro_header_text_cb(){
		global $accesspress_pro_options;
		$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
		if(!empty($accesspress_pro_settings['header_text'])){
		echo '<div class="header-text">'.$accesspress_pro_settings['header_text'].'</div>';
		}
	}
	add_action('accesspress_pro_header_text','accesspress_pro_header_text_cb');

	function accesspress_pro_excerpt( $accesspress_pro_content , $accesspress_pro_letter_count){
		$accesspress_pro_letter_count = !empty($accesspress_pro_letter_count) ? $accesspress_pro_letter_count : 100 ;
		$accesspress_pro_striped_content = strip_tags(strip_shortcodes($accesspress_pro_content));
		$accesspress_pro_excerpt = mb_substr($accesspress_pro_striped_content, 0 , $accesspress_pro_letter_count);
		if(strlen($accesspress_pro_striped_content) > strlen($accesspress_pro_excerpt)){
			$accesspress_pro_excerpt.= "...";
		}
		return $accesspress_pro_excerpt;
	}

	function accesspress_pro_slidercb(){
		if(is_home() || is_front_page() ){
			global $accesspress_pro_options, $post; 
			$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
			if($accesspress_pro_settings['show_slider'] == 'yes'){
			$accesspress_pro_slider_type = $accesspress_pro_settings['slider_type'];
			?>
			<section id="slider-banner">
			<?php
				if($accesspress_pro_slider_type == 'rev_slider'){
					$rev_slider_shortcode = $accesspress_pro_settings['rev_slider_shortcode'];
					echo do_shortcode($rev_slider_shortcode);
				}elseif($accesspress_pro_slider_type == 'pro_slider'){
					do_action('accesspress_pro_sequence_slider');
				}else{
					do_action('accesspress_pro_bx_slider');
				}
			?>
			</section>
			<?php
			}	
		}
	}	

   add_action('accesspress_pro_slider','accesspress_pro_slidercb');

   function accesspress_pro_sequence_slider_cb(){
   	global $accesspress_pro_options; 
	$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
   	$slider_images = !empty($accesspress_pro_settings['slider']) ? $accesspress_pro_settings['slider'] : "";
	$slider_show_pager = $accesspress_pro_settings['slider_show_pager'] == 'yes1' ? 'true' : 'false';
	$slider_show_controls = $accesspress_pro_settings['slider_show_controls'] == 'yes2' ? 'true' : 'false';
	$slider_auto = $accesspress_pro_settings['slider_auto'] == 'yes3' ? 'true' : 'false';
	
	$count = count($slider_images);
	$total = 0;
    ?>
   		<script type="text/javascript"> 
			    jQuery(document).ready(function(){
				    var options = {
				        nextButton: <?php echo $slider_show_controls; ?>,
				        prevButton: <?php echo $slider_show_controls; ?>,
				        pagination: <?php echo $slider_show_pager; ?>,
				        animateStartingFrameIn: true,
				        autoPlay: <?php echo $slider_auto; ?>,
				        autoPlayDelay: <?php echo $accesspress_pro_settings['slider_speed']; ?>,
                        pauseOnHover: false,
                        hidePreloaderDelay: 500,
                        preloader: true,
                        preventDelayWhenReversingAnimations: true,
                        hidePreloaderUsingCSS: false,
				    };
				    
				    var mySequence = jQuery("#sequence").sequence(options).data("sequence");
				});
			</script>
			<div class="sequence-theme <?php echo $accesspress_pro_settings['slider_mode']; ?>">
			<div id="sequence">

				<?php if($accesspress_pro_settings['slider_show_controls']=='yes2'):?>
				<div class="sequence-prev"><span></span></div>
				<div class="sequence-next"><span></span></div>
                <?php endif; ?>

				<ul class="sequence-canvas">
					<?php
					if(!empty($slider_images )){
						
						foreach ($slider_images as $slider_image) { 
						$total++;				
							 ?>

						<li class="<?php if($total == 1) echo 'animate-in' ?>">
                            <div class="li-wrap">
							<div class="big-banner" style="background-image:url(<?php echo $slider_image['banner']; ?>);"></div>

							<div class="mid-content">
								<?php if($accesspress_pro_settings['slider_mode']=='slider_type1' && $slider_image['image'] ):?>
								<div class="model"> 
                                    <img alt="slider-image" src="<?php echo $slider_image['image']; ?>">
                                </div> 
								<?php endif; ?>
								
								<?php if($accesspress_pro_settings['slider_caption']=='yes4'):?>
                                    <?php if($slider_image['caption_header']): ?>
									   <div class="title"><span><?php echo $slider_image['caption_header']; ?></span></div>
                                    <?php endif; ?>
                                    
                                    <?php if($slider_image['caption_desc']): ?><strong></strong>
									<div class="subtitle"><span><?php echo $slider_image['caption_desc']; ?></span></div>
									<?php endif; ?>
                                    
                                    <?php if(!empty($slider_image['slider_read_more'])) :?>
									<a class="more-link" href="<?php echo $slider_image['slider_read_more_link']; ?>"><?php echo $slider_image['slider_read_more']; ?></a>
									<?php 
								endif;
								endif; ?>
							</div>
                            </div>
						</li>

						<?php } ?>
					
					<?php } ?>	
				</ul>

				<ul class="sequence-pagination">
					<?php 
					if(!empty($slider_images )){
						if($accesspress_pro_settings['slider_show_pager_image'] == 'yes'){
							foreach ($slider_images as $slider_image) { 
							$extension_pos = strrpos($slider_image['banner'], '.'); // find position of the last dot, so where the extension starts
							$thumb = substr($slider_image['banner'], 0, $extension_pos) . '-150x150' . substr($slider_image['banner'], $extension_pos);	
							?>
							<li><img alt="slider-image" src="<?php echo $thumb; ?>"></li>
							<?php } 
						}else{
							for ($i=1; $i <= $count ; $i++) { ?>
								<li class="dots"><a href="javascript:void(0)"><?php echo $i ?></a></li>
						<?php	
							}
						}
					}?>
				</ul>
			</div>
			</div>
	<?php
    }

    add_action('accesspress_pro_sequence_slider','accesspress_pro_sequence_slider_cb');

    function accesspress_pro_bx_slider_cb(){
    global $accesspress_pro_options; 
	$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
    $slider_images = !empty($accesspress_pro_settings['slider']) ? $accesspress_pro_settings['slider'] : "";
	$slider_show_pager = $accesspress_pro_settings['slider_show_pager'] == 'yes1' ? 'true' : 'false';
	$slider_show_controls = $accesspress_pro_settings['slider_show_controls'] == 'yes2' ? 'true' : 'false';
	$slider_auto = $accesspress_pro_settings['slider_auto'] == 'yes3' ? 'true' : 'false';
	
	$count = count($slider_images);
	$total = 0;
    ?>
    	<script type="text/javascript">
            jQuery(function(){
				jQuery('.bx-slider').bxSlider({
					adaptiveHeight : true,
					pager:<?php echo $slider_show_pager; ?>,
					controls:<?php echo $slider_show_controls; ?>,
					mode:'fade',
					auto :<?php echo $slider_auto; ?>,
					pause: <?php echo $accesspress_pro_settings['slider_speed']; ?>,
					speed: 1000,
				});
			});
       		</script>

				<div class="bx-slider">
				<?php 
					if(!empty($slider_images )){
						foreach ($slider_images as $slider_image) { 
						$total++;				
					?>
						<div class="slides">
							
							<img src="<?php echo $slider_image['banner']; ?>">
							
							<?php if($accesspress_pro_settings['slider_caption']=='yes4'): ?>
							<div class="slider-caption">
								<div class="ak-container">
                                    <?php if($slider_image['caption_header']): ?>
									   <h1 class="caption-title"><?php echo $slider_image['caption_header']; ?></h1>
									<?php endif; ?>
                                    
                                    <?php if($slider_image['caption_desc']): ?>
                                        <h2 class="caption-description"><?php echo $slider_image['caption_desc']; ?></h2>
									<?php endif; ?>
                                    
                                    <?php if(!empty($slider_image['slider_read_more'])) :?>
									<a class="more-link" href="<?php echo $slider_image['slider_read_more_link']; ?>"><?php echo $slider_image['slider_read_more']; ?></a>
									<?php endif; ?>
								</div>
							</div>
							<?php  endif; ?>
				
			            </div>
						<?php 
						}
					} ?>
				    </div>
	<?php
    }

    add_action('accesspress_pro_bx_slider','accesspress_pro_bx_slider_cb');

   function accesspress_pro_layout_class($classes){
   	global $post;
		if( is_404()){
		$classes[] = ' ';
		}elseif(is_singular()){
		$post_class = get_post_meta( $post -> ID, 'accesspress_pro_sidebar_layout', true );
		$classes[] = $post_class;
		}else{
		$classes[] = 'right-sidebar';	
		}
		return $classes;
	}

	add_filter( 'body_class', 'accesspress_pro_layout_class' );

	function accesspress_pro_web_layout($classes){
	    global $accesspress_pro_options, $post;
		$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
	    $accesspress_pro_weblayout = $accesspress_pro_settings['webpage_layout'];
	    if($accesspress_pro_weblayout == 'Boxed'){
	        $classes[]= 'boxed-layout';
	    }
	    return $classes;
   }
   
   add_filter( 'body_class', 'accesspress_pro_web_layout' );

   function accesspress_pro_logo_metabox(){
   	remove_meta_box( 'postimagediv', 'logo', 'side' );
   	add_meta_box('postimagediv', __('Upload Logo', 'accesspress-pro'), 'post_thumbnail_meta_box', 'logo', 'normal', 'high');
   }
   add_action('do_meta_boxes', 'accesspress_pro_logo_metabox' );

   function accesspress_pro_testimonial_metabox(){
   	remove_meta_box( 'postimagediv', 'testimonial', 'side' );
   	add_meta_box('postimagediv', __('Upload Clients Image' , 'accesspress-pro'), 'post_thumbnail_meta_box', 'testimonial', 'side', 'low');
   }
   add_action('do_meta_boxes', 'accesspress_pro_testimonial_metabox' );

   /*BreadCrumb*/
	function accesspress_pro_breadcrumbs() {
	  global $accesspress_pro_options, $post;
	  $accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );

	  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

	  if(isset($accesspress_pro_settings['breadcrumb_seperator'])){
	  	$delimiter = $accesspress_pro_settings['breadcrumb_seperator'];
	  }else{
	  $delimiter = '&raquo;'; // delimiter between crumbs
		}

	  if(isset($accesspress_pro_settings['breadcrumb_home_text'])){
	  $home = $accesspress_pro_settings['breadcrumb_home_text'];
		}else{
		$home = __('Home','accesspress-pro'); // text for the 'Home' link
		}

	  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	  $before = '<span class="current">'; // tag before the current crumb
	  $after = '</span>'; // tag after the current crumb
	  
	  $homeLink = get_bloginfo('url');
	  
	  if (is_home() || is_front_page()) {
	  
	    if ($showOnHome == 1) echo '<div id="accesspreslite-breadcrumbs"><div class="ak-container"><a href="' . $homeLink . '">' . $home . '</a></div></div>';
	  
	  } else {
	  
	    echo '<div id="accesspreslite-breadcrumbs"><div class="ak-container"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	  
	    if ( is_category() ) {
	      $thisCat = get_category(get_query_var('cat'), false);
	      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
	      echo $before . __('Archive by category','accesspress-pro').' "' . single_cat_title('', false) . '"' . $after;
	  
	    } elseif ( is_search() ) {
	      echo $before .  __('Search results for','accesspress-pro').' "' . get_search_query() . '"' . $after;
	  
	    } elseif ( is_day() ) {
	      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
	      echo $before . get_the_time('d') . $after;
	  
	    } elseif ( is_month() ) {
	      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	      echo $before . get_the_time('F') . $after;
	  
	    } elseif ( is_year() ) {
	      echo $before . get_the_time('Y') . $after;
	  
	    } elseif ( is_single() && !is_attachment() ) {
	      if ( get_post_type() != 'post' ) {
	        $post_type = get_post_type_object(get_post_type());
	        $slug = $post_type->rewrite;
	        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
	        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	      } else {
	        $cat = get_the_category(); $cat = $cat[0];
	        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
	        echo $cats;
	        if ($showCurrent == 1) echo $before . get_the_title() . $after;
	      }
	  
	    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	      $post_type = get_post_type_object(get_post_type());
	      echo $before . $post_type->labels->singular_name . $after;
	  
	    } elseif ( is_attachment() ) {
	       
	      if ($showCurrent == 1) echo ' ' . $before . get_the_title() . $after;
	  
	    } elseif ( is_page() && !$post->post_parent ) {
	      if ($showCurrent == 1) echo $before . get_the_title() . $after;
	  
	    } elseif ( is_page() && $post->post_parent ) {
	      $parent_id  = $post->post_parent;
	      $breadcrumbs = array();
	      while ($parent_id) {
	        $page = get_page($parent_id);
	        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	        $parent_id  = $page->post_parent;
	      }
	      $breadcrumbs = array_reverse($breadcrumbs);
	      for ($i = 0; $i < count($breadcrumbs); $i++) {
	        echo $breadcrumbs[$i];
	        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
	      }
	      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	  
	    } elseif ( is_tag() ) {
	      echo $before .  __('Posts tagged','accesspress-pro').' "' . single_tag_title('', false) . '"' . $after;
	  
	    } elseif ( is_author() ) {
	       global $author;
	      $userdata = get_userdata($author);
	      echo $before .  __('Articles posted by','accesspress-pro') . $userdata->display_name . $after;
	  
	    } elseif ( is_404() ) {
	      echo $before . __('Error 404','accesspress-pro') . $after;
	    }
	  
	    if ( get_query_var('paged') ) {
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
	      echo __('Page' , 'accesspress-pro') . ' ' . get_query_var('paged');
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
	    }
	  
	    echo '</div></div>';
	  
	  }
	} 

	function accesspress_pro_footercolumn(){
		$footer_column = 0;
		if(is_active_sidebar('footer-1'))
		$footer_column++;
		if(is_active_sidebar('footer-2'))
		$footer_column++;
		if(is_active_sidebar('footer-3'))
		$footer_column++;
		if(is_active_sidebar('footer-4'))
		$footer_column++;	
		return 'column-'.$footer_column;
	}

	function accesspress_pro_featuredcolumn(){
		$footer_column = 0;
		if(is_active_sidebar('textblock-1'))
		$footer_column++;
		if(is_active_sidebar('textblock-2'))
		$footer_column++;
		if(is_active_sidebar('textblock-3'))
		$footer_column++;
		return 'column-'.$footer_column;
	}

	function kriesi_pagination($pages = '', $range = 1){  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='accesspress_pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
	}

	function accesspress_pro_custom_css(){
		global $accesspress_pro_options;
		$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
		echo '<style type="text/css">';
			echo $accesspress_pro_settings['custom_css'];
		echo '</style>';
	}

	add_action('wp_head','accesspress_pro_custom_css');

	function accesspress_pro_custom_code(){
		global $accesspress_pro_options;
		$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
		?>
			<div id="fb-root"></div>
		    <script>
		    (function(d, s, id) {
		      var js, fjs = d.getElementsByTagName(s)[0];
		      if (d.getElementById(id)) return;
		      js = d.createElement(s); js.id = id;
		      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
		      fjs.parentNode.insertBefore(js, fjs);
		    }(document, 'script', 'facebook-jssdk'));
		    </script>
		<?php
		echo '<script type="text/javascript">';
			echo $accesspress_pro_settings['custom_code'];
		echo '</script>';
	}

	add_action('wp_head','accesspress_pro_custom_code'); 

	function accesspress_share_script(){
		global $accesspress_pro_options;
		$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
		$share_publisher_id = $accesspress_pro_settings['share_publisher_id'] ;
		
		if(!empty($share_publisher_id)){
			echo '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.$share_publisher_id.'"></script>';
		}
	}

	add_action('wp_footer','accesspress_share_script');

	function colourBrightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE 
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

function accesspress_get_attachment_id_from_url( $attachment_url = '' ) {
 
    global $wpdb;
    $attachment_id = false;
 
    // If there is no url, return.
    if ( '' == $attachment_url )
        return;
 
    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();
 
    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
    }
 
    return $attachment_id;
}

add_action( 'tgmpa_register', 'accesspress_pro_register_required_plugins' );

function accesspress_pro_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
            'name'               => 'Revolution Slider', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
			'name' => 'AccessPress Social Icons',
			'slug' => 'accesspress-social-icons',
			'required' => false,
		),
        array(
			'name' => 'AccessPress Social Counter',
			'slug' => 'accesspress-social-counter',
			'required' => false,
		),
        array(
			'name' => 'AccessPress Social Share',
			'slug' => 'accesspress-social-share',
			'required' => false,
		),
		array(
			'name' => 'Ultimate Form Builder Lite',
			'slug' => 'ultimate-form-builder-lite',
			'required' => false,
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'accesspress-pro',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'accesspress-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}


function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}


function exclude_category_from_blogpost($query) {
global $accesspress_pro_options;
$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );

	if(!empty($accesspress_pro_settings['exclude_cat'])){
	$accesspress_pro_exclude_cat = $accesspress_pro_settings['exclude_cat'];
		
	if(is_array($accesspress_pro_exclude_cat)):
	    $cats = array();
	    foreach($accesspress_pro_exclude_cat as $key => $value){
	        if($value == 1){
	            $cats[] = -$key; 
	        }
	    }
	    $category = join( "," , $cats);
	    if ( $query->is_home() ) {
	    $query->set('cat', $category);
	    }
	    return $query;
	endif;
	}
}

add_filter('pre_get_posts', 'exclude_category_from_blogpost');


function accesspress_ajax_script()
{
     wp_localize_script( 'ajax_script_function', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )) );
     wp_enqueue_script( 'ajax_script_function', get_template_directory_uri().'/inc/admin-panel/js/ajax.js', 'jquery', true);

}
add_action('admin_enqueue_scripts', 'accesspress_ajax_script');

function get_my_option()
{
	/*if ( !wp_verify_nonce( $_REQUEST['nonce'], "get_my_option_nonce")) {
     exit();
   	} */
   	global $accesspress_pro_options;
	$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
	$accesspress_pro_font_list = unserialize(get_option('accesspress_pro_google_fonts'));
   	
   	$font_family = $_REQUEST['font_family'];
	
	$font_array = search_key($accesspress_pro_font_list,'family', $font_family);

	$variants_array = $font_array['0']['variants'] ;

	foreach ($variants_array  as $variants ) {
		$options_array .= '<option value="'.$variants.'">'.$variants.'</option>';
	}
	echo $options_array;
    die();
}

add_action("wp_ajax_get_my_option", "get_my_option");

add_filter('show_admin_bar', '__return_false');

function search_key($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search_key($subarray, $key, $value));
        }
    }

    return $results;
}

function font_weight_style($variants){
	switch ($variants) {
		case '100':
			echo 'font-weight:100 !important; font-style:normal !important;';
			break;

		case '100italic':
			echo 'font-weight:100 !important;font-style:italic !important;';
			break;

		case '200':
			echo 'font-weight:200 !important;font-style:normal !important;';
			break;

		case '300':
			echo 'font-weight:300 !important;font-style:normal !important;';
			break;

		case '300italic':
			echo 'font-weight:300 !important;font-style:italic !important;';
			break;

		case 'regular':
			echo 'font-weight:400 !important;font-style:normal !important;';
			break;

		case 'italic':
			echo 'font-weight:400 !important;font-style:italic !important;';
			break;

		case '500':
			echo 'font-weight:500 !important;font-style:normal !important;';
			break;

		case '500italic':
			echo 'font-weight:500 !important;font-style:italic !important;';
			break;

		case '600':
			echo 'font-weight:600 !important;font-style:normal !important;';
			break;

		case '600italic':
			echo 'font-weight:600 !important;font-style:italic !important;';
			break;

		case '700':
			echo 'font-weight:700 !important;font-style:normal !important;';
			break;

		case '700italic':
			echo 'font-weight:700 !important;font-style:italic !important;';
			break;

		case '800':
			echo 'font-weight:800 !important;font-style:normal !important;';
			break;

		case '800italic':
			echo 'font-weight:800 !important;font-style:italic !important;';
			break;

		case '900':
			echo 'font-weight:900 !important;font-style:normal !important;';
			break;

		case '900italic':
			echo 'font-weight:900 !important;font-style:italic !important;';
			break;
		
		default:
			echo 'font-weight:500 !important;font-style:normal !important;';
			break;
	}
}

add_filter( 'woocommerce_breadcrumb_defaults', 'accesspress_woocommerce_breadcrumbs' );

function accesspress_woocommerce_breadcrumbs() {
	return array(
	'delimiter'   => ' &#47; ',
	'wrap_before' => '<div id="accesspreslite-breadcrumbs"><div class="ak-container">',
	'wrap_after' => '</div></div>',
	'before' => '',
	'after' => '',
	'home' => _x( 'Home', 'breadcrumb', 'woocommerce' ), 
);
} 

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	header( 'Location: '.admin_url('themes.php?page=theme_options'));
}

/* woocommerce */
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' , 10 );

add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' , 20 );

function woocommerce_template_loop_product_thumbnail(){
    echo woocommerce_get_product_thumbnail( 'shop-thumbnail', 300, 300 );
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper' , 10 );
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb' , 20 );

remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' , 10 );
add_filter('woocommerce_show_page_title', '__return_false');

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' , 10 );
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating' , 5 );
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' , 10 );
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description' , 10 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' , 10 );



add_action('woocommerce_before_main_content', 'accesspress_output_content_wrapper' , 10 );
add_action('woocommerce_after_main_content', 'accesspress_output_content_wrapper_end' , 10 );
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close' , 10 );
add_action('woocommerce_after_shop_loop_item_title', 'accesspress_after_shop_loop_item_title_open' , 4 );
add_action('woocommerce_after_shop_loop_item', 'accesspress_after_shop_loop_item_title_close' , 20 );
add_action('accesspress_before_main_content', 'woocommerce_breadcrumb' , 20 );
add_action('accesspress_archive_description', 'woocommerce_taxonomy_archive_description' , 10 );
add_action('accesspress_archive_description', 'woocommerce_product_archive_description' , 10 );



function accesspress_after_shop_loop_item_title_open(){
	echo '<div class="price-cart">';
}

function accesspress_after_shop_loop_item_title_close(){
	echo '</div>';
}

function accesspress_output_content_wrapper(){
	echo '<header class="entry-header">';
	do_action( 'accesspress_before_main_content' );
	echo '<h1 class="entry-title ak-container">';
	woocommerce_page_title();
	echo '</h1>';

	echo '<div class="ak-container">';

	do_action( 'accesspress_archive_description' );

	echo '</div>';

	echo '</header>';

	echo '<div class="ak-container">';
	echo '<div id="primary" class="content-area">';
}

function accesspress_output_content_wrapper_end(){
	echo '</div>';
	do_action( 'woocommerce_sidebar' );
	echo '</div>';
}

add_filter( 'loop_shop_columns',  'accesspress_shop_column');

function accesspress_shop_column( $number_columns ){
	return 3;
}

add_filter( 'woocommerce_output_related_products_args', 'accesspress_related_products_args' );
 
function accesspress_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

add_filter('body_class', 'accesspress_shop_body_class');

function accesspress_shop_body_class($body_class){
	$body_class[] = 'columns-3';
	return $body_class;
}

add_filter( 'loop_shop_per_page', 'accesspress_products_per_page', 20 );
if( !function_exists( 'accesspress_products_per_page' ) ) {
    function accesspress_products_per_page() {
        return 12;
    }
}

/*Event Post Table*/
add_filter( 'manage_events_posts_columns', 'add_events_columns');

function add_events_columns($columns) {
	unset($columns['date']);
    return array_merge($columns, 
              array('event_date' => __('Event Date', 'accesspress-pro'),
                    'event_expiry' =>__( 'Event Expiry', 'accesspress-pro'),
                    'date' => __('Date', 'accesspress-pro')
                    )
             );
}

function custom_events_column( $column, $post_id ) {
    switch ( $column ) {
      case 'event_date':
        $accesspress_pro_event_day = get_post_meta( $post_id, 'accesspress_pro_event_day', true );
		$accesspress_pro_event_month = get_post_meta( $post_id, 'accesspress_pro_event_month', true );
		$accesspress_pro_event_year = get_post_meta( $post_id, 'accesspress_pro_event_year', true );
		echo $accesspress_pro_event_day.' '.$accesspress_pro_event_month.' '.$accesspress_pro_event_year;
        break;

      case 'event_expiry':
      	$accesspress_pro_event_date = get_post_meta( $post_id, 'accesspress_pro_event_date', true );
      	$current_time = strtotime('-1 day');
        if($current_time > $accesspress_pro_event_date){
        	echo '<span class="ap-expired"></span>'. __('Expired', 'accesspress-pro');
        }else{
        	echo '<span class="ap-not-expired"></span>'. __('Not Expired', 'accesspress-pro');
        }
        break;
    }
}
add_action( 'manage_events_posts_custom_column' , 'custom_events_column', 10, 2  );

function events_sortable_columns( $columns ) {
    $columns['event_date'] = 'event_date';
    return $columns;
}
add_filter( 'manage_edit-events_sortable_columns', 'events_sortable_columns' );

function event_date_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'event_date' == $orderby ) {
        $query->set('meta_key','accesspress_pro_event_date');
        $query->set('orderby','meta_value_num');
    }
}

add_action( 'pre_get_posts', 'event_date_orderby' );

/*Removes hentry class from page and custom post type*/
function accesspress_pro_remove_hentry( $classes, $class, $post_id ) {
    $hentry_post_types = array(
        "post"
    );
 
    $post_type = get_post_type( $post_id );
 
    if ( !in_array( $post_type, $hentry_post_types ) ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
    }
 
    return $classes;
}
add_filter( 'post_class', 'accesspress_pro_remove_hentry', 10, 3 );