jQuery(document).ready(function($){
  var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;

  $('.accesspress_pro_fav_icon .button').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = $(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        $("#"+id).val(attachment.url);
        $('#accesspress_pro_media_image').fadeIn();
        $("#accesspress_pro_show_image").attr('src',attachment.url);
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open(button);
    return false;
  });

  $('#accesspress_pro_fav_icon_remove').click(function(){
    $('#accesspress_pro_media_image').hide();
    $('#accesspress_pro_media_image img').attr('src','');
    $('#accesspress_pro_media_upload').val('');
  });

  $('.accesspress_pro_tc .button').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = $(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        $("#"+id).val(attachment.url);
        $('#accesspress_pro_tc_image').fadeIn();
        $("#accesspress_pro_tc_show_image").attr('src',attachment.url);
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open(button);
    return false;
  });

  $('#accesspress_pro_tc_remove').click(function(){
    $('#accesspress_pro_tc_image').hide();
    $('#accesspress_pro_tc_image img').attr('src','');
    $('#accesspress_pro_tc_upload').val('');
  });

  $('#upload-header-image').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        $('#hidden-input').val(attachment.url);
        $('#accesspress_pro_header_image').fadeIn();
        $('#remove_header_image').fadeIn();
        $("#accesspress_pro_header_image").attr('src',attachment.url);
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open($(this));
    return false;
  });

  $('#remove_header_image').click(function(){
    $(this).hide();
    $('#accesspress_pro_header_image').hide();
    $('#hidden-input').val('');
  });

  $(document).on('click','.upload-slider-image', function(e) {
    var dis = $(this);
    var send_attachment_bkp = wp.media.editor.send.attachment;
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        $(dis).siblings('.hidden-input-image').val(attachment.url);
        $(dis).siblings('.img-image').children('img').attr('src',attachment.url).fadeIn();
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open($(this));
    return false;
  });
  
  $(document).on('click','.upload-slider-banner', function(e) {
    var dis = $(this);
    var send_attachment_bkp = wp.media.editor.send.attachment;
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        $(dis).siblings('.hidden-input-banner').val(attachment.url);
        $(dis).siblings('.img-banner').children('img').attr('src',attachment.url).fadeIn();
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open($(this));
    return false;
  });

});