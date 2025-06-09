$(document).ready(function() {
    $('.fieldset-header').on('click', function() {
        const $content = $(this).next();
        const $chevron = $(this).find('.chevron-icon');
        
        if ($content.is(':hidden')) {
            $content.slideDown(500);
            $chevron.css('transform', 'rotate(0deg)');
        } else {
            $content.slideUp(500);
            $chevron.css('transform', 'rotate(180deg)');
        }
    });
});