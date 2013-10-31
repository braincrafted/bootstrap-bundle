$(function() {
    $('.disable-links a').click(function (e) {
        e.preventDefault();
    });

    $('.affix').each(function () {
            fixAffixWidth(this);
        });

    $(window).scroll(function() {
        $('.affix-top').each(function () {
            fixAffixWidth(this);
        });
        $('.affix').each(function() {
            fixAffixWidth(this);
        })
    });

    $('body').scrollspy({ target: '.sidebar' });
});

function fixAffixWidth(elem) {
    var p = $(elem).parent();
    var width = parseInt(p.css('width')) - parseInt(p.css('padding-left')) - parseInt(p.css('padding-right'));
    $(elem).css('width', width);
}
