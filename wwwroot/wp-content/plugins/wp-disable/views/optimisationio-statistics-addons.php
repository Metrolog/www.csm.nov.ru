<?php
$str_i18n = array(
	'n/a'	=> __( 'n/a', 'optimisationio' ),
	'install' => __( 'Install', 'optimisationio' ),
	'activate' => __( 'Activate', 'optimisationio' ),
	'deactivate' => __( 'Deactivate', 'optimisationio' ),
	'page_title' => __( '%1$s Optimisation.io %2$s', 'optimisationio' ),
	'changes_may_not_saved' => __('Changes you made may not be saved.', 'optimisationio'),
);

$disable_slug = 'wp-disable';
$cache_slug = 'cache-performance';
$img_compress_slug = 'wp-image-compression';

$addons = Optimisationio_Stats_And_Addons::$addons;

$active_addons_number = Optimisationio_Stats_And_Addons::active_addons_number();

if ( $addons[$img_compress_slug]['activated'] ) {
	global $wpdb;
	$image_compress_info = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "image_compression_settings", ARRAY_A);
}

$cache_info = $addons[$cache_slug]['activated'] ? Optimisationio_CacheEnabler::get_optimisation_info() : null;

$loading_gif = '<img src="' . admin_url('images/wpspin_light.gif') . '" alt="" />';
?>

<div class="wrap">



	<div class="wrap-main">
	<h2></h2>

		<div class="wrap-stats">

			<div class="wrap-inner">

	   			<div class="header">
	   				<span class="logo"></span>
	   				<span class="request"><a href="https://optimisation.io/contact-us/">REQUEST MANUAL OPTIMISATION</a></span>
	   				<span class="support"><a href="https://optimisation.io/contact-us/">Support</a></span>
	   			</div>

	   			<div class="middle-content">
	   			</div>

	   			<div class="footer-content">
	   				<ul>
	   					<li>Disable</li>
	   					<li>Images</li>
	   					<li>Cache</li>
	   				</ul>
				</div>

   			</div>

		</div>

		<div class="wrap-addons">

			<div class="wrap-inner">

				<?php foreach( $addons as $k => $v ){ ?>

					<div class="stats-section">

						<div class="header"><h3><span class="state <?php Optimisationio_Stats_And_Addons::echo_addon_state_color( $v['activated'], $v['installed'] ); ?>"></span><?php echo $v['title']; ?></h3><span class="on-process hidden"><?php echo $loading_gif; ?></span></div>

						<div class="main">

							<div class="inner addon-inner">

								<div class="left-part">
									<a href="<?php echo esc_url( $v['homepage'] ); ?>" target="_blank" style="background-image:url(<?php echo esc_url( $v['thumb'] ); ?>);"></a>
								</div>

								<div class="right-part">
									<p><?php echo $v['description']; ?></p>

									<div class="addon-buttons"
										 data-slug="<?php echo esc_attr($k); ?>"
										 data-file="<?php echo esc_attr($v['file']); ?>"
										 data-link="<?php echo esc_attr($v['download_link']); ?>">

										<button class="button button-primary install-addon <?php echo ! $v['installed'] ? '' : 'hidden'; ?>">
											<?php echo $str_i18n['install'] ?>
										</button>

										<button class="button button-primary activate-addon <?php echo $v['installed'] && ! $v['activated'] ? '' : 'hidden'; ?>"><?php echo $str_i18n['activate'] ?></button>
										<?php

										if( $v['installed'] && $v['activated'] ){
											// $cn = 1 === $active_addons_number ? "disabled" : "";
											$cn = "";
										}
										else{
											$cn = "hidden";
										}
										?>

										<button class="button deactivate-addon <?php echo $cn; ?>"><?php echo $str_i18n['deactivate'] ?></button>

									</div>
								</div>

							</div>

						</div>

					</div>

				<?php } ?>

			</div>

		</div>

	</div>

	<?php wp_nonce_field( 'optimisationio-addons-nonce', 'optimisationio_addons_nonce' ); ?>
</div>

<script type="text/javascript">
	(function ($) {

		"use strict";

		var activated_addons_num = <?php echo $active_addons_number; ?>;
		var running_processes = 0;
		var on_deactivate_process = false;
		var deactivates_queue = [];

		function confirm_page_leave(event){
		    if (0 !== running_processes) {
		        var msg = "<?php echo $str_i18n['changes_may_not_saved']; ?>";
		        event.returnValue = msg;
		        return msg;
		    }
		}

		function on_action_click( $btn, action ){

			var slug, file, link, $parent;

			if( ! $btn.hasClass("disabled") ){
				$btn.addClass("disabled");
				$btn.parents('.stats-section').find('.on-process').removeClass('hidden');
				$parent = $btn.parent('.addon-buttons');
				slug = $parent.data('slug');
				file = $parent.data('file');
				link = $parent.data('link');

				if( on_deactivate_process ){
					deactivates_queue.push({
						action: action,
						slug: slug,
						file: file,
						link: link,
						'$btn': $btn
					});
				}
				else{
					ajax_request( action, slug, file, link, $btn );
				}
			}
		}

		function ajax_request(action, slug, file, link, $btn){

			running_processes++;

			on_deactivate_process = 'deactivate' === action;

			$.ajax({
                type: 'post',
                url: ajaxurl,
                data:{
                	action: 'optimisationio_' + action + '_addon',
                	slug: slug,
                	file: file,
                	link: link,
                	nonce: $('#optimisationio_addons_nonce').val(),
                },
                dataType: 'json',
                success: function (data, textStatus, XMLHttpRequest) {

                	var to_activate, $state_light, next;

                	if( 0 !== data.error ){
                		if("undefined" !== typeof data.type && "deny-disable" === data.type ){
                			$btn.parents('.stats-section').find('.on-process').addClass('hidden');
                			alert(data.msg);
                			on_deactivate_process = false;
                			running_processes--;
                			$btn.removeClass("disabled");
                		}
                		else{
                			console.error(data.msg);
                		}
                	}
                	else{

                		$state_light = $btn.parents('.stats-section').find('.header h3 .state');

                		switch(action){
                			case 'install':
                				to_activate = 'activate';
                				$state_light.removeClass('red').addClass('orange');
                				break;
							case 'activate':
								to_activate = 'deactivate';
								$state_light.removeClass('orange').addClass('green');
								break;
							case 'deactivate':

								on_deactivate_process = false;

								if( deactivates_queue.length ){
									next = deactivates_queue.pop();
									ajax_request(next.action, next.slug, next.file, next.link, next['$btn']);
								}

								to_activate = 'activate';
								$state_light.removeClass('green').addClass('orange');
								break;
                		}

                		if( to_activate ){
	                		$btn.parent('.addon-buttons').find('.' + to_activate + '-addon').removeClass('hidden').removeClass("disabled");
	                		$btn.parents('.stats-section').find('.on-process').addClass('hidden');
	                		$btn.addClass("hidden");
	                		running_processes--;
	                	}
                	}
                },
                error: function (data, textStatus, XMLHttpRequest) {
                	console.error("ERROR: ", slug, action);
                	// console.log(data);
                	$btn.parents('.stats-section').find('.on-process').addClass('hidden');
                	$btn.text("ERROR");
                	running_processes--;
                }
            });
		}

		$(function () {
			$('.install-addon').on('click', function(){ on_action_click( $(this), 'install' ); });
			$('.activate-addon').on('click', function(){ on_action_click( $(this), 'activate' ); });
			$('.deactivate-addon').on('click', function(){ on_action_click( $(this), 'deactivate' ); });
			window.onbeforeunload = confirm_page_leave;
		});
	}(jQuery));
</script>
