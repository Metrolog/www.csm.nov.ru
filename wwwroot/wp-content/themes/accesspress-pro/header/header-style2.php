<?php 
	global $accesspress_pro_options;
	$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
	$accesspress_pro_google_map = $accesspress_pro_settings['google_map'];
	if(!empty($accesspress_pro_settings['sticky_header']) && $accesspress_pro_settings['sticky_header'] == 1){
		$accesspress_pro_sticky_header = " sticky-header";
	}else{
		$accesspress_pro_sticky_header = "";
	}
?>
	<div class="top-header">
		<div class="ak-container">
			<?php if(!empty($accesspress_pro_google_map)) : ?>
				<div class="google-icon"><i class="fa fa-map-marker"></i></div>
			<?php endif; ?>
		
			<?php do_action( 'accesspress_pro_header_text' ); 

			if($accesspress_pro_settings['show_social_header'] == 0){
				do_action( 'accesspress_pro_social_links' ); 
				}
			?>
		</div>
	</div>

    <div id="main-header" class="<?php echo $accesspress_pro_sticky_header; ?>">
		<div class="ak-container">
			<div class="site-branding">
				
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php if ( get_header_image() ) { ?>
					<img src="<?php header_image(); ?>" alt="<?php bloginfo('name') ?>">
				<?php }else{ ?>
				    <h1 class="site-title"><?php bloginfo('name') ?></h1>
                    <div class="site-desc"><?php bloginfo('description') ?></div>
				<?php } ?>
				</a>
				
			</div><!-- .site-branding -->
        

			<div class="right-header">
				<nav id="site-navigation" class="main-navigation clearfix">
					<h1 class="menu-toggle"><?php _e( 'Menu', 'accesspress-pro' ); ?></h1>
					<?php wp_nav_menu( array( 
					'theme_location' => 'primary',
					'container'      => 'div',
					'container_class'=> 'menu',
					'items_wrap'      => '<ul>%3$s</ul>',
					 ) ); ?>
					
					<?php if($accesspress_pro_settings['show_search'] == 1){ ?>
					<a href="javascript:void(0)" class="search-icon"><i class="fa fa-search"></i></a>
						<div class="ak-search">
						<?php get_search_form(); ?>
						</div>
					<?php } ?>
				</nav><!-- #site-navigation -->
			</div><!-- .right-header -->
		</div><!-- .ak-container -->
 	</div><!-- #top-header -->

  	