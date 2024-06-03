(function ($) {
    'use strict';

    var HT = {};

    HT.getLocation = () => {
        $(document).on('change', '.location', function () {
            let _this = $(this);
            let option = {
                'data': {
                    'location_id': _this.val()
                },
                'target': _this.attr('data-target')
            }

            HT.senDataTogetLocation(option);
        });
    }

    HT.senDataTogetLocation = (option) => {
        $.ajax({
            url: 'ajax/location/index',
            type: 'GET',
            dataType: 'json',
            data: option,

            success: function (response) {
                $('.' + option.target).html(response.html);

                if (district_id != '' && option.target == 'districts') {
                    $('.' + option.target).val(district_id).trigger('change');
                }

                if (ward_id != '' && option.target == 'wards') {
                    $('.' + option.target).val(ward_id).trigger('change');
                }

            }, error: function (error) {
                console.log(error)
            }
        });
    }

    HT.loadCity = () => {
        if (province_id != '') {
            $('.province').val(province_id).trigger('change');
        }
    }

    $(document).ready(function () {
        HT.getLocation();
        HT.loadCity();
    })
})(jQuery)
