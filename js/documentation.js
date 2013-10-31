$(function() {
    $('.disable-links a').click(function (e) {
        e.preventDefault();
    });

    $(window).scroll(function() {
        $('.affix-top').each(function () {
            var p = $(this).parent();
            var width = parseInt(p.css('width')) - parseInt(p.css('padding-left')) - parseInt(p.css('padding-right'));
            $(this).css('width', width);
        });
    });

    $('body').scrollspy({ target: '.sidebar' });
});
