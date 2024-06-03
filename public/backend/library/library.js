(function ($) {
    'use strict';

    var HT = {};

    var document = $(document);

    HT.switchery = () => {
        $('.js-switch').each(function () {
            var switchery = new Switchery(this, { color: '#26B99A' });
        });
    }

    HT.select2 = () => {
        $('.select2').select2();
    }

    document.ready(function () {
        HT.switchery();
        HT.select2();
    })
})(jQuery)
