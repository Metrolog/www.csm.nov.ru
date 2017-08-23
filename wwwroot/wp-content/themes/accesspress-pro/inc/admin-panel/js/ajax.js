jQuery(document).ready(function($) {
    $('#heading_font, #body_font').on('change',function() {
        var font_family = $(this).val();
        var dis = $(this).attr('id');
        $.ajax({
            url: ajaxurl,
            data: ({
                'action': 'get_my_option',
                'font_family':font_family,
            }),
            success: function(response) {
                $('#'+dis+'_select').html(response);
            }
        });
    });
});