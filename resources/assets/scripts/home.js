function checkPasswords() {
    if ($('#pass').val() == $('#cpass').val()) {
        $('#message').html('Matching').css('color', 'green');
        return true;
    } else {
        $('#message').html('Not Matching').css('color', 'red');
        return false;
    }
}
$(document).ready(function() {

    /**
     * Registration form submission AJAX
     */

    /**
     * Please note the below code has been repeated
     * which is not a good practice.
     * window.function was tried.
     * There are multiple ways of solving the below problem
     * but right now there is a time constraint
     */
    //-----------------------------------------------
    var check = false;
    $('#pass, #cpass').on('keyup', function() {
        if ($('#pass').val() == $('#cpass').val()) {
            $('#message').html('Matching').css('color', 'green');
            check = true;
        } else {
            $('#message').html('Not Matching').css('color', 'red');
        }
        check = false;
    });
    //------------------------------------------------

    $('#registration_form').submit(function(event) {
        var data = {
            username: $('#username').val(),
            email: $('#email').val(),
            name: $('#name').val(),
            password: $('#pass').val(),
            phone: $('#phone').val(),
            gender: $('[name="gender"]:checked').val()
        };
        if (checkPasswords()) {
            $.ajax({
                    url: '/registerUser',
                    type: 'POST',
                    data: data,
                    dataType: "text",
                })
                .done(function(data) {
                    // console.log(data);
                    if (data == "ok") {
                        Swal.fire(
                            'User Registered Successfully!',
                            data,
                            'success'
                        ).then(function() {
                            window.location.href = "/";
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: data,
                        });
                    }
                })
                .fail(function() {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.'
                    });
                });
        }
        event.preventDefault();
    });

    /**
     * Login form submit
     *
     */
    $('#login-form').submit(function(event) {
        var data = {
            username: $('#username-login').val(),
            password: $('#password-login').val()
        };
        // console.log(data);
        $.ajax({
                url: '/loginCheck',
                type: 'POST',
                data: data,
                dataType: "text",
            })
            .done(function(data) {
                // console.log(data);
                if (data == "login-success") {
                    window.location.href = "/";
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: data,
                    });
                    $('#password-login').val('');
                }
            })
            .fail(function() {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again later.'
                });
            });
        event.preventDefault();
    });




    /**
     * Edit profile -> after logged in
     */
    $('#edit-profile').submit(function(event) {
        var data = {
            email: $('#email').val(),
            name: $('#name').val(),
            password: $('#pass').val(),
            phone: $('#phone').val(),
            gender: $('[name="gender"]:checked').val()
        };
        if (checkPasswords()) {
            $.ajax({
                    url: '/updateUser',
                    type: 'POST',
                    data: data,
                    dataType: "text",
                })
                .done(function(data) {
                    console.log(data);
                    if (data == "ok") {
                        Swal.fire(
                            'Account Information is updated successfully!',
                            data,
                            'success'
                        ).then(function() {
                            window.location.href = "/";
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: data,
                        });
                    }
                })
                .fail(function() {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.'
                    });
                });
        }
        event.preventDefault();
    });

    //forgot-password

    $('#forgot-password').submit(function(event) {
        var data = {
            email: $('#forgot-password-email').val()
        };
        // console.log(data);
        $.ajax({
                url: '/forgotPassword',
                type: 'POST',
                data: data,
                dataType: "text",
            })
            .done(function(data) {
                // console.log(data);
                if (data == "email-sent") {
                    Swal.fire(
                        'Email sent!',
                        `An email has been sent to you at corresponding email. 
                        Kindly check the email`,
                        'success'
                    ).then(function() {
                        window.location.href = "/";
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Incorrect email ID',
                        text: data,
                    });
                }
            })
            .fail(function() {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again later.'
                });
            });
        event.preventDefault();
    });
});