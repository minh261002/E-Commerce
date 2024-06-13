(function ($) {
    'use strict';

    var HT = {};

    var document = $(document);
    var _token = $('meta[name="csrf-token"]').attr('content');

    HT.switchery = () => {
        $('.js-switch').each(function () {
            var switchery = new Switchery(this, { color: '#26B99A' });
        });
    }

    HT.select2 = () => {
        $('.select2').select2();
    }

    HT.changeStatus = () => {
        $('body').on('change', '.status', function (e) {
            e.preventDefault();
            let _this = $(this);
            let option = {
                'value': _this.val(),
                'modelId': _this.attr('data-modelId'),
                'model': _this.attr('data-model'),
                'field': _this.attr('data-field'),
                '_token': _token
            }

            $.ajax({
                url: 'ajax/dashboard/changeStatus',
                type: 'POST',
                dataType: 'json',
                data: option,
                success: function (res) {
                    console.log(res)
                },
                error: function (error) {
                    console.log(error)
                }
            })
        });
    }

    HT.changeStatusAll = () => {
        if ($('.changeStatusAll').length) {
            $('body').on('click', '.changeStatusAll', function (e) {
                e.preventDefault();
                let _this = $(this);
                let id = [];
                $('.checkBoxItem').each(function () {
                    let checkbox = $(this);
                    if (checkbox.prop('checked')) {
                        id.push(checkbox.val());
                    }
                });

                let option = {
                    'value': _this.attr('data-value'),
                    'model': _this.attr('data-model'),
                    'field': _this.attr('data-field'),
                    'id': id,
                    '_token': _token
                }

                $.ajax({
                    url: 'ajax/dashboard/changeStatusAll',
                    type: 'POST',
                    dataType: 'json',
                    data: option,
                    success: function (res) {
                        if (res.status == 200) {
                            let cssActive1 = 'box-shadow: rgb(38, 185, 154) 0px 0px 0px 16px inset; border-color: rgb(38, 185, 154); background-color: rgb(38, 185, 154); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;';
                            let cssActive2 = 'left: 20px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s; background-color: rgb(255, 255, 255);';
                            let cssUnActive1 = 'box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;';
                            let cssUnActive2 = 'left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;'
                            if (option.value == 1) {
                                for (let i = 0; i < id.length; i++) {
                                    $('.js-switch-' + id[i]).find('span.switchery').attr('style', cssActive1).find('small').attr('style', cssActive2);
                                    $('.js-switch-' + id[i]).find('input').prop('checked', true);
                                }
                            } else {
                                for (let i = 0; i < id.length; i++) {
                                    $('.js-switch-' + id[i]).find('span.switchery').attr('style', cssUnActive1).find('small').attr('style', cssUnActive2);
                                    $('.js-switch-' + id[i]).find('input').prop('checked', false);
                                }
                            }
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        }
    }

    HT.checlAll = () => {
        $('body').on('click', '#checkAll', function () {
            let isChecked = $(this).prop('checked');

            $('.checkBoxItem').prop('checked', isChecked);
            $('.checkBoxItem').each(function () {
                let _this = $(this);
                HT.changeBackground(_this);
            });
        });
    }

    HT.checkBoxItem = () => {
        $('body').on('click', '.checkBoxItem', function () {
            let _this = $(this);
            HT.changeBackground(_this);
            HT.allChecked();
        });
    }

    HT.allChecked = () => {
        let allChecked = $('.checkBoxItem:checked').length === $('.checkBoxItem').length;
        $('#checkAll').prop('checked', allChecked);
    }

    HT.changeBackground = (object) => {
        let isChecked = object.prop('checked');
        if (isChecked) {
            object.closest('tr').addClass('active-bg');
        } else {
            object.closest('tr').removeClass('active-bg');
        }
    }

    document.ready(function () {
        HT.switchery();
        HT.select2();
        HT.changeStatus();
        HT.checlAll();
        HT.checkBoxItem();
        HT.changeStatusAll();
    })
})(jQuery)
