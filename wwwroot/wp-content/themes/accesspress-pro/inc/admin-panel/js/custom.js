jQuery(document).ready(function($){
     
            // Loads tabbed sections if they exist
            if ( $('#optionsframework-wrap .nav-tab-wrapper').length > 0 ) {
                    accesspress_pro_tabs();
            }   
     
            $( "#portfolio-page-layout input" ).change(function() {
                    if($( "#portfolio-page-layout input:checked" ).val()=='portfolio_grid'){
                            $("#portfolio_grid_columns" ).fadeIn();
                    }else{
                            $("#portfolio_grid_columns" ).fadeOut();
                    }
            }).change();
     
            $( "#event-page-layout input" ).change(function() {
                    if($( "#event-page-layout input:checked" ).val()=='event_grid'){
                            $("#event_grid_columns" ).fadeIn();
                    }else{
                            $("#event_grid_columns" ).fadeOut();
                    }
            }).change();
     
     
            $('input#show_fontawesome').change(function(){
                    if($('input#show_fontawesome').is(':checked')){
                            $('.big_icon_option').fadeIn();
                    }else{
                            $('.big_icon_option').fadeOut();
                    }
            }).change();
     
     
            function accesspress_pro_tabs() {
     
                    // Hides all the .group sections to start
                    $('.group').hide();
     
                    // Find if a selected tab is saved in localStorage
                    var active_tab = '';
                    active_tab = $('#tab_id').attr('value');
                
                    // If active tab is saved and exists, load it's .group
                    if (active_tab != '' && $(active_tab).length ) {
                            $(active_tab).fadeIn();
                            $(active_tab + '-tab').addClass('options-nav-tab-active');
                    } else {
                            $('.group:first').fadeIn();
                            $('#optionsframework-wrap .nav-tab-wrapper a:first').addClass('options-nav-tab-active');
                    }
     
                    // Bind tabs clicks
                    $('#optionsframework-wrap .nav-tab-wrapper a').click(function(evt) {
     
                            evt.preventDefault();

                            activeTab = $(this).attr('href');
                            $('#tab_id').attr('value', activeTab);
     
                            // Remove active class from all tabs
                            $('#optionsframework-wrap .nav-tab-wrapper a').removeClass('options-nav-tab-active');
     
                            $(this).addClass('options-nav-tab-active').blur();
     
                            var group = $(this).attr('href');
     
     
                            $('.group').hide();
                            $(group).fadeIn();
     
     
                    });
            }
            if($('#slider_count').length > 0){
            var count_slider = $('#slider_count').val();
            }else{
                    var count_slider =0
            }
        $('#add-slider').click(function(){
          count_slider++;
          $('.add-slider-wrap').append('<div class="form-row">'+
          '<label class="block">Silder Image</label>'+
          '<div class="slider-image-wrap">'+
          '<input class="hidden-input-banner" type="hidden" name="accesspress_pro_options[slider]['+count_slider+'][banner]" value="">'+
          '<input class="hidden-input-image" type="hidden" name="accesspress_pro_options[slider]['+count_slider+'][image]" value="">'+
          '<div class="img-banner"><img class="img-banner" src="" alt="slider-banner" style="display:none"/></div>'+
          '<div class="img-image"><img class="img-image" src="" alt="slider-image" style="display:none"/></div>'+
          '<div class="clearfx"></div>'+      
          '<label class="block">Caption Header</label>'+
          '<input name="accesspress_pro_options[slider]['+count_slider+'][caption_header]" type="text">'+
          '<label class="block">Caption Description</label>'+
          '<textarea name="accesspress_pro_options[slider]['+count_slider+'][caption_desc]"></textarea>'+
          '<label class="block">Read More Text</label>'+
          '<input type="text" name="accesspress_pro_options[slider]['+count_slider+'][slider_read_more]" >'+
          '<label class="block">Read More Link</label>'+
          '<input type="text" name="accesspress_pro_options[slider]['+count_slider+'][slider_read_more_link]" >'+
          '<a class="upload-slider-banner button" href="javascript:void(0)">Upload Background Image</a>'+
          '<a class="upload-slider-image button" href="javascript:void(0)">Upload Foreground Image</a>'+
          '<a class="remove-slider button" href="javascript:void(0)">Remove</a>'+
          '</div></div>')
         
          $('#slider_count').val(count_slider);
        });
     
        $(document).on('click','.remove-slider', function(){
            var form_row = $(this);
            form_row.parent().parent('.form-row').slideUp('2000');
            $('#optionsframework-submit input').attr('disabled','disabled');
                setTimeout(function(){
                    form_row.parent().parent('.form-row').remove();
                    $('#optionsframework-submit input').removeAttr('disabled');
                }, 3000);
                });
     
        $('.accesspress_pro-color').wpColorPicker();

        $('.skin-select input').click(function(){
          theme_color = $(this).val();
          $('#ap_theme_color').attr('value',theme_color);
          $('.theme_color .wp-color-result').css('background',theme_color);
        });
        
        $('#page_template').on('change',function(){
            console.log('changed');
            if($(this).val() == 'page-events.php' || $(this).val() == 'page-faq.php' || $(this).val() == 'page-porfolio.php' ){
                $('#accesspress_pro_sidebar_layout').slideUp();
            }else{
                $('#accesspress_pro_sidebar_layout').slideDown();
            }
        }).change();
    });

