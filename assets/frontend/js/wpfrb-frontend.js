(function ($) {
    // login register popup
    $(document).on('click', '.tab.btn, .btn.menu', function () {
        if ($(this).hasClass('tab')) {
            loginRegisterTabHandle(this)
        } else {
            $('.wpfrb-login-register').addClass('show')
            loginRegisterTabHandle(this)
        }
    })

    // close login/register popup
    $('.wpfrb .overlay-close').click(function (e) {
        $('.wpfrb-login-register').removeClass('show')
    })

    // handle login register tab
    function loginRegisterTabHandle(that) {
        if ($(that).hasClass('login')) {
            $('#wpfrb-register-form').removeClass('active-form');
            $('.tab.btn.register').removeClass('active')
            $('.tab.btn.login').addClass('active')
            $('#wpfrb-login-form').addClass('active-form');
        } else {
            $('#wpfrb-login-form').removeClass('active-form');
            $('.tab.btn.login').removeClass('active')
            $('.tab.btn.register').addClass('active')
            $('#wpfrb-register-form').addClass('active-form');
        }
    }


    // handle register form
    $(document).on('submit', 'form#wpfrb-register-form, form#wpfrb-login-form', function (e) {
        e.preventDefault();
        if (this.id === 'wpfrb-register-form') {
            //get form data in a object
            const data = $(this).serializeArray().reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj
            }, {});
            // ajax register request
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_obj.ajaxurl,
                data: {
                    'action': 'wpfrb_user_register',
                    ...data
                },
            })
        }
        if (this.id === 'wpfrb-login-form') {
            //get form data in a object
            const data = $(this).serializeArray().reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj
            }, {});

            //ajax login request
        }
    })
})(jQuery)