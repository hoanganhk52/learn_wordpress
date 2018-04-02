jQuery(document).ready(function ($) {
    var hash = window.location.hash;

    if (!hash) {
        hash = 'tab1';
    }
    load_content(hash);

    $("#hoanganh-mp-tabs a").on('click', function (e) {
        load_content(hash)
    });


    function load_content (tabName) {
        var dataObj = {
            'action': 'hoanganh_load_content',
            'tab': tabName
        };

        $.ajax({
            url: ajaxurl,
            type: "GET",
            data: dataObj,
            dataType: "html",
            beforeSend: function () {
                $("#hoanganh-mp-tabs-content").html('Loading...');
            },
            success: function (data, status, jsXHR) {
                if (data) {
                    console.log(data);
                    $("#hoanganh-mp-tabs-content").html(data);
                }
            }
        });
    }
});

