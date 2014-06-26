$(document).ready(function() {
    var working = false;
    /* Данный флаг предотвращает отправку нескольких комментариев: */
    $('form').submit(function(e) {
        e.preventDefault();
        if (working)
            return false;
        working = true;
        $('#submit').text('Подождите..');
        $.post('inc/ajax/submit.php', $(this).serialize(), function(msg) {
            /* Отправляем значения формы в submit.php: */
            working = false;

            $('#submit').text('Submit');

            if (msg.status)
                    //   Если данные корректны, добавляем сообщение
                    {
                        $('#captcha').text(msg.captcha);
                        $('#email_cont').removeClass("has-warning");
                        $('#user_cont').removeClass("has-warning");
                        $('#message_cont').removeClass("has-warning");
                        $('#captcha_cont').removeClass("has-warning");
                        $('#message').val('');
                        $('#captcha_val').val('');
                        alert("Сообщение сохранено");
                        $.each(msg.message, function(k, v) {
                            if (k == 'user') {
                                user = v;
                            }
                            if (k == 'message') {
                                mes = v;
                            }


                        });
                        $('<div id="mes"><blockquote><p>' + mes + '</p><footer>' + user + '</footer></blockquote></div>').appendTo('#message_list');
                    }
            else
            {
                //   Если есть ошибки, проходим циклом по объекту
                //  msg.errors и выводим их на страницу
                $('#email_cont').removeClass("has-warning");
                $('#user_cont').removeClass("has-warning");
                $('#message_cont').removeClass("has-warning");
                $('#captcha_cont').removeClass("has-warning");
                $.each(msg.errors, function(k, v) {


                    if (k == 'captcha') {
                        $('#captcha').text(v);
                        $('#' + k + '_cont').addClass("has-warning");
                        $('#captcha_val').val('');
                    }
                    if (k == 'user') {
                        $('#' + k + '_cont').addClass("has-warning");
                    }
                    if (k == 'email') {
                        $('#' + k + '_cont').addClass("has-warning");
                    }
                    if (k == 'message') {
                        $('#' + k + '_cont').addClass("has-warning");
                    }
                });
            }
        }, 'json');
    });
});