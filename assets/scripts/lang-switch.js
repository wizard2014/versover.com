(function() {
    var switcher = $('.lang-switch');

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 80) {
            switcher.animate({top: '12px'}, 'slow');
        } else {
            switcher.stop(true, true).animate({top: '27px'}, 'slow');
        }
    });

    $(window).on('resize', function() {
        if ($( window ).width() < 770) {
            switcher.animate({top: '12px'}, 'slow');
        } else {
            switcher.stop(true, true).animate({top: '27px'}, 'slow');
        }
    });

    if (window.location.pathname.split('/')[1] == 'ru') {
        $('.ru').addClass('active');

        var versover = $('.versover');
        versover.prop('href', versover.prop('href') + 'ru');
    } else {
        $('.en').addClass('active');

        $('.phone-hide').addClass('hide');
    }

    switcher.find('.lang').on('click', function() {
        var data = $(this).data('lang');

        var href = window.location.pathname;

        if (data == 'ru') {
            setRuLang(href, data);
        } else if (data == 'en') {
            setEnLang(href);
        }
    });

    function setEnLang(href) {
        var tmp = href.split('/').pop();

        if (tmp != 'ru') {
            window.location = '/' + tmp;
        } else {
            window.location = '/';
        }
    }

    function setRuLang(href, data) {
        localStorage.setItem('lang', 'ru');

        if (href != '/') {
            window.location = '/' + data + href;
        } else {
            window.location = data + href.substr(1);
        }
    }
})();
