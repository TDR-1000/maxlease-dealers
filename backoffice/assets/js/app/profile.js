/**
 * Prevent's forms with class "no-submit" to be submitted.
 */
$(".no-submit").submit(function () {
    return false;
});

/**
 * Validate and submit change password form.
 */
$("#change-password-form").validate({
    rules: {
        old_password: "required",
        new_password: {
            required: true,
            minlength: 6
        },
        new_password_confirmation: "required"
    },
    submitHandler: function(form) {
        MAX.Http.submit(form, getChangePasswordFormData(form), function () {
            MAX.Util.displaySuccessMessage($(form), $_lang.password_updated_successfully);
        });
    }
});

/**
 * Builds a change password form data.
 * @param form
 * @returns *
 */
function getChangePasswordFormData(form) {
    return {
        action: "updatePassword",
        old_password: MAX.Util.hash(form['old_password'].value),
        new_password: MAX.Util.hash(form['new_password'].value),
        new_password_confirmation: MAX.Util.hash(form['new_password_confirmation'].value)
    };
}

/**
 * Submits the form to update user details.
 */
$("#update_details").click(function () {
    var $form = $("#form-details"),
        form = $form[0];

    MAX.Http.post({
        action : "updateDetails",
        details: {
            first_name: form['first_name'].value,
            last_name: form['last_name'].value,
            address: form['address'].value,
            phone: form['phone'].value
        }
    }, function () {
        MAX.Util.displaySuccessMessage($form, $_lang.details_updated);
    }, function () {
        MAX.Util.displayErrorMessage($form.find("input"));
        MAX.Util.displayErrorMessage(
            $form.find("input[name=phone]"),
            $_lang.error_updating_db
        );
    });
});
