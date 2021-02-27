$(document).ready(function () {
    $('.form-control').focusin(function () {
        $(this).parent().children('label').addClass('label-toggle');
        console.log();
    })
    $('.form-control').focusout(function () {
        if ($(this).val() === '') {
            $(this).parent().children('label').removeClass('label-toggle');
        }
    })
});
