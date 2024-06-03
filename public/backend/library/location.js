(function ($) {
    'use strict';

    var HT = {};

    HT.province = () => {
        $(document).on('change', '.province', function () {
            let _this = $(this);
            let province_id = _this.val();


            $.ajax({
                url: 'ajax/location/index',
                type: 'GET',
                dataType: 'json',
                data: {
                    province_id: province_id
                },
                success: function (response) {
                    $('.district').html(response.html);
                }, error: function (error) {
                    console.log(error)
                }
            });
        });
    }

    $(document).ready(function () {
        HT.province();
    })
})(jQuery)
