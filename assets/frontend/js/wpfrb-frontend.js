(function ($) {
    // login register popup
    $(document).on('click', '.tab.btn, .btn.menu', function () {
        $('.wpfrb-from-msg-status').text('');
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
            
            const registerFormInputs = $('#wpfrb-register-form input');
            if(registerFormInputs.next('p').length){
                registerFormInputs.removeClass('error');
                registerFormInputs.next('p').remove();
            }
        } else {
            $('#wpfrb-login-form').removeClass('active-form');
            $('.tab.btn.login').removeClass('active')
            $('.tab.btn.register').addClass('active')
            $('#wpfrb-register-form').addClass('active-form');
            const loginFromInputs = $('#wpfrb-login-form input');
            if(loginFromInputs.next('p').length){
                loginFromInputs.removeClass('error')
                loginFromInputs.next('p').remove();
            }
        }
    }


    // handle login/register form
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
                    action: 'wpfrb_user_register',
                    nonce: ajax_obj.nonce,
                    ...data
                },
                success(res) {
                    if (res.success) {
                        $('#wpfrb-register-form').trigger("reset");
                        $(`#wpfrb-register-form input`).removeClass('error');
                        $(`#wpfrb-register-form input + p`).remove();
                        $('.wpfrb-from-msg-status.register').text('Registration successful! Redirecting....');
                        setTimeout(() => {
                            $('#wpfrb-register-form').removeClass('active-form');
                            $('.tab.btn.register').removeClass('active')
                            $('.tab.btn.login').addClass('active')
                            $('#wpfrb-login-form').addClass('active-form');
                        }, 2000)
                    }
                },
                error({responseJSON: {data}}, _, err) {
                    const errors = data;
                    $(`#wpfrb-register-form input`).removeClass('error');
                    $(`#wpfrb-register-form input + p`).remove();
                    for (const err in errors) {
                        const element = $(`#wpfrb-register-form input[name=${err}]`);
                        $(`#wpfrb-register-form input[name=${err}] + p`).remove();
                        element.addClass('error')
                        element.after(`<p style="color: red; font-size: small">${errors[err]}</p>`);
                    }
                }
            })
        }
        if (this.id === 'wpfrb-login-form') {
            //get form data in a object
            const data = $(this).serializeArray().reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj
            }, {});

            //ajax login request
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_obj.ajaxurl,
                data: {
                    action: 'wpfrb_user_login',
                    nonce: ajax_obj.nonce,
                    ...data
                },
                success(res) {
                    if (res.success) {
                        $('.wpfrb-from-msg-status.login').text('Login successful! Redirecting....');
                        $('#wpfrb-login-form').trigger("reset");
                        $(`#wpfrb-login-form input`).removeClass('error');
                        $(`#wpfrb-login-form input + p`).remove();
                        setTimeout(() => {
                            $('.wpfrb-popup-overlay.wpfrb-login-register').remove();
                            location.reload();
                        }, 1500)
                    }
                },
                error({responseJSON: {data}}, _, err) {
                    const errors = data;
                    $(`#wpfrb-login-form input`).removeClass('error');
                    $(`#wpfrb-login-form input + p`).remove();
                    for (const err in errors) {
                        const element = $(`#wpfrb-login-form input[name=${err}]`);
                        $(`#wpfrb-login-form input[name=${err}] + p`).remove();
                        element.addClass('error')
                        element.after(`<p style="color: red; font-size: small">${errors[err]}</p>`);
                    }
                }
            })
        }
    })

    // hover profile log handle
    $('.wpfrb .header-right').hover(function(){
     $('.wpfrb .header-right .user-logout-dropdown').show()
    },function(){
        $('.wpfrb .header-right .user-logout-dropdown').hide()
    })
    $('.wpfrb .header-right').click(function(){
        $('.wpfrb .header-right .user-logout-dropdown').toggle()
    })
    // handle feature req form show hide
    $('.frb-req-add-button').click(function(){
        $('.frb-req-form-area').animate({
            height: 'toggle'
          });
    })
})(jQuery)