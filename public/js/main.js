/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

$(document).ready(function() {
    $("#iscredential").change(function() {
        if ($("#iscredential").is(':checked')) {
            $(".toggle").slideDown(200);
        } else {
            $(".toggle").slideUp(200);
        }
    });
});