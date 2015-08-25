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

        setHtmlLang('ru');
        setRuBtn();
    } else {
        $('.en').addClass('active');

        $('.phone-hide').addClass('hide');

        setHtmlLang('en');
    }

    switcher.find('.lang').on('click', function() {
        var data = $(this).data('lang');

        var href = window.location.pathname;

        if (data == 'ru') {
            setRuLang(href, data);
            setHtmlLang('ru');
            setRuBtn();
        } else if (data == 'en') {
            setEnLang(href);
            setHtmlLang('en');
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
        if (href != '/') {
            window.location = '/' + data + href;
        } else {
            window.location = data + href.substr(1);
        }
    }

    function setRuBtn() {
        var btn  = $('a.btn');

        if (btn.length > 0) {
            var href = btn.prop('href').split('/').pop();

            btn.prop('href', '/ru/' + href);
        }
    }

    function setHtmlLang(lang) {
        $('html').prop('lang', lang);
    }
})();
