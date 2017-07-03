/*
* @Author: Ngo Quang Cuong
* @Date:   2017-07-02 16:47:45
* @Last Modified by:   nquangcuong
* @Last Modified time: 2017-07-03 16:00:03
*/

require([
        'jquery',
        'jquery/ui',
        'jquery/validate',
        'mage/translate'
    ], function ($) {
    //Validate Image FileSize
    $('.avatar.validate-image').on('change', function() {
        $('.profile-image, .avatar-file-upload').css({'opacity':'0.5'});
    });
    $.validator.addMethod(
        'validate-image', function (v, elm) {
            if (elm.value != '') {
                var ext = elm.value.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    return false;
                }
            }
            return true;
        }, $.mage.__('Image invalid (Accepting format .gif .png .jpg .jpeg)')
    );
});
