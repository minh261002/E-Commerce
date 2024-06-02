(function ($) {
    'use strict';

    var HT = {};

    var document = $(document);

    HT.switchery = () => {
        $('.js-switch').each(function () {
            var switchery = new Switchery(this, { color: '#26B99A' });
        });
    }

    document.ready(function () {
        HT.switchery();
    })
})(jQuery)
