<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Accesspress Pro
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
	global $accesspress_pro_options;
	$accesspress_pro_settings = get_option( 'accesspress_pro_options', $accesspress_pro_options );
	$accesspress_pro_header_style = empty($accesspress_pro_settings['header_style']) ? "style1" : $accesspress_pro_settings['header_style'];
	$accesspress_pro_google_map = $accesspress_pro_settings['google_map'];
	$accesspress_pro_tc_activate = $accesspress_pro_settings['tc_activate'];

	if(!empty($accesspress_pro_tc_activate)){
		if($accesspress_pro_tc_activate == 1 && !is_user_logged_in()){ 
			wp_redirect( home_url() ); 
			exit;
		}
	}
?>
<div id="page" class="site">
	<?php if(!empty($accesspress_pro_google_map)) : ?>
		<div id="header-google-map">
		<?php echo $accesspress_pro_google_map; ?>
		</div>
	<?php endif; ?>

	<header id="masthead" class="site-header <?php echo $accesspress_pro_header_style; ?>">
		<?php
		switch ($accesspress_pro_header_style) {
			case 'style1':
				get_template_part('header/header-style1');
				break;

			case 'style2':
				get_template_part('header/header-style2');
				break;

			case 'style3':
				get_template_part('header/header-style3');
				break;

			case 'style4':
				get_template_part('header/header-style4');
				break;
			
			default:
				get_template_part('header/header-style1');
				break;
		}
		?>
	</header><!-- #masthead -->

	
	<?php do_action( 'accesspress_pro_slider' ); ?>

	<?php
	if(is_home() || is_front_page() ){
	$accesspress_pro_content_id = "home-content";
	}else{
	$accesspress_pro_content_id ="content";
	} ?>
	
	<div id="<?php echo $accesspress_pro_content_id; ?>" class="site-content">