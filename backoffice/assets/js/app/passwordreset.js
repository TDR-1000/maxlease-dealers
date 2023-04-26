/**
 * Validate and submit forgot password form.
 */
$("#forgot form").validate({
    rules: {
        email: {
            required: true,
            email: true
        }
    },
    submitHandler: function(form) {
        MAX.Http.submit(form, {
            action: "forgotPassword",
            email: form['email'].value
        }, function () {
            MAX.Util.displaySuccessMessage($(form), $_lang.password_reset_email_sent);
        });
    }
});

/**
 * Validate and submit password reset form.
 */
$("#password-reset-form").validate({
    rules: {
        new_password: {
            required: true,
            minlength: 6
        }
    },
    submitHandler: function(form) {
        MAX.Http.submit(form, getPasswordResetFormData(form), function () {
            MAX.Util.displaySuccessMessage($(form), $_lang.password_updated_successfully_login);
        });
    }
});

/**
 * Build password reset form data as JSON.
 * @param form
 * @returns {{action: string, new_password: string, key: string}}
 */
function getPasswordResetFormData(form) {
    return {
        action: "resetPassword",
        new_password: MAX.Util.hash(form['new_password'].value),
        key: MAX.Util.urlParam("k")
    };
}
