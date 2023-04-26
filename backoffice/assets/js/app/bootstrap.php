<?php
    include_once "../../../MAXEngine/MAX.php";
    header('Content-Type: application/javascript');
?>

var $_lang = <?= MAXLang::all() ?>;
var _data = {};
_data["<?= MAXCsrf::TOKEN_NAME ?>"] = "<?= MAXCsrf::getToken() ?>";
jQuery.ajaxSetup({ data: _data, type: "POST" });

jQuery.validator.setDefaults({
    errorElement: "em",
    errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");

        element.prop("type") === "checkbox"
            ? error.insertAfter(element.next("label"))
            : error.insertAfter(element);
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid");
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass("is-invalid");
    }
});


var MAX = {
    App: {
        lang: "<?= MAXLang::getLanguage() ?>"
    },
    Util: {},
    Http: {}
};