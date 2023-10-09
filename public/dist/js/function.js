(function ($) {
    'use strict'


    $(document).on('collapsed.lte.pushmenu', '[data-widget="pushmenu"]', function () {
        $('.hamburger').addClass('is-active');
    })
    $(document).on('shown.lte.pushmenu', '[data-widget="pushmenu"]', function () {
        $('.hamburger').removeClass('is-active');
    })

})(jQuery)