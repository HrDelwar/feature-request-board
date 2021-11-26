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
        $('#frb-req-form-area').animate({
            height: 'toggle'
          });
    })

    // handle feature req form logo
    $(".wpfrb .frb-req-selcet-logo").on("change", function(e) {

        if (window.File && window.FileList && window.FileReader) {
            
            let file = e.target.files[0];
            if(file){
                $(".wpfrb .logowrap .logo-preview-wraper .logo-preview").remove();
                let reader = new FileReader();
                reader.onload = (function(e) {
                    $(".wpfrb .logowrap .logo-preview-wraper").append("<div class=\"logo-preview\">" +
                        "<img class=\"logo\" src=\"" + e.target.result + "\" title=\"" + e.target.name + "\"/>" +
                        "<span class=\"remove-preview-logo\">+</span>" +
                        "</div>");
                    $(".remove-preview-logo").click(function(e){
                        $(this).parent(".logo-preview").remove();
                        $('.wpfrb .frb-req-selcet-logo').val('');
                    });
                });
                reader.readAsDataURL(file);
            }
        } else {
          alert("Your browser doesn't support to File API")
        }
    });

    // handle feature req form submit 
    $(document).on('submit','form#wpfrb-add-feature-req-form', function(e){
        e.preventDefault();
        let form_data = new FormData($(this)[0]);
        form_data.append('action','wpfrb_add_feature');
        form_data.append('nonce',ajax_obj.nonce)
       
        $.ajax({
            type: 'POST',
            url: ajax_obj.ajaxurl,
            data:form_data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success(res) {
                if (res.success) {
                    $('#wpfrb-add-feature-req-form').trigger("reset");
                    $('.wpfrb .frb-req-selcet-logo').val('');
                    $("#wpfrb-add-feature-req-form .logo-preview").remove();
                    $(`#wpfrb-add-feature-req-form input, #wpfrb-add-feature-req-form textarea`).removeClass('error');
                    $(`#wpfrb-add-feature-req-form input + p, #wpfrb-add-feature-req-form textarea + p`).remove();
                    $('.wpfrb-from-msg-status.feature-req').text('Request add successful....!'); 
                    // setTimeout(() => {
                    //     location.reload();
                    // },1500)
                }
            },
            error({responseJSON: {data}}, _, err) {
                const errors = data;
                $(`#wpfrb-add-feature-req-form input, #wpfrb-add-feature-req-form textarea`).removeClass('error');
                $(`#wpfrb-add-feature-req-form input + p, #wpfrb-add-feature-req-form textarea + p`).remove();
                for (const err in errors) {
                    const element = err === 'description' ? $(`#wpfrb-add-feature-req-form textarea[name=${err}]`) : $(`#wpfrb-add-feature-req-form input[name=${err}]`);
                    $(`#wpfrb-add-feature-req-form input[name=${err}] + p, #wpfrb-add-feature-req-form textarea[name=${err}] + p`).remove();
                    element.addClass('error')
                    element.after(`<p style="color: red; font-size: small;margin-top:-16px; margin-bottom:12px;">${errors[err]}</p>`);
                }
            }
        })
    })

})(jQuery)