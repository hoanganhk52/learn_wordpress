jQuery(document).ready(function ($) {
    jQuery("#hoanganh_mp_st_ajax_title").on('blur', function (e) {
        var dataObj = {
            'action': 'hoanganh_check_form',
            'value': $(this).val()
        };

        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: dataObj,
            dataType: "json",
            success: function (data, status, jsXHR) {
                if (!data.status) {
                    $("#hoanganh_mp_st_ajax_title").after('<span>' + data.errors.hoanganh_mp_st_ajax_title + '</span>');
                }
            }
        });
    });
});