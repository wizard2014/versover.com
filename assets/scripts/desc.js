// show/hide description
(function() {
    var item = $('.item-inner'),
        height;

    item.on('mouseenter', function() {
        $(this).find('.desc').addClass('on');
        height = $(this).css('height');
        $(this).removeAttr('style');
    });
    item.on('mouseleave', function() {
        $(this).find('.desc').removeClass('on');
        $(this).css('height', height);
    });
})();
