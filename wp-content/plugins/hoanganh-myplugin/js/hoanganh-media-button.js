(function(jQuery){
    jQuery.fn.hoanganhBtnMedia = function (inputID) {
        console.log(inputID);
        var backup_send_to_editor = window.send_to_editor;
        jQuery(this).click(function(){
            tb_show('', 'media-upload.php?type=image&TB_iframe=true');
            window.send_to_editor = function(html) {
                var img_url = jQuery(html).attr('src');
                console.log(img_url);
                jQuery("#" + inputID).val(img_url);
                tb_remove();
                window.send_to_editor = backup_send_to_editor;
            };
            return false;
        });
    }
}(jQuery));
