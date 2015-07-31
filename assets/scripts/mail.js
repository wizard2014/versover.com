// Send mail
$('.contact-form').on('submit', function(e) {
    e.preventDefault();

    var name    = $.trim($('#cname').val()),
        email   = $.trim($('#cemail').val()),
        message = $.trim($('#cmessage').val()),
        subject = $.trim($('#csubject').val()),
        btn     = $('.sbm-btn');

    var html  = '',
        error = false;

    $.ajax({
        type: 'POST',
        url: '/contact/send',
        data: { name: name, email: email, subject: subject, message: message },

        beforeSend: function() {
            btn.prop('disabled', true);
        }
    })
        .done(function(data) {
            if (data.error === undefined) {
                html += '<div class="email-message email-message-success" title="Нажмите чтобы закрыть"><h2 class="text-center">'  + data.success + '<h2></div>';

                $('.close').trigger('click');
            } else {
                html += '<div class="email-message email-message-error" title="Нажмите чтобы закрыть"><h2 class="text-center">'  + data.error + '<h2></div>';

                error = true;
            }

            $('body').append(html);
        })
        .fail(function() {
            html += '<div class="email-message email-message-error" title="Нажмите чтобы закрыть"><h2 class="text-center">Что-то пошло не так, повторите попытку позже.<h2></div>';
        })
        .always(function() {
            var messenger   = $('.email-message'),
                timer       = null;

            autoClose();

            messenger.on('click', function() {
                $(this).fadeOut('slow');

                clearTimeout(timer);
            });

            function autoClose() {
                timer = setTimeout(function(){ messenger.trigger('click'); }, 8000);
            }

            btn.prop('disabled', false);

            // Clear fields
            if (!error) {
                $('#cname').val('');
                $('#cemail').val('');
                $('#csubject').val('');
                $('#cmessage').val('');
            }
        });
});