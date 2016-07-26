$(document).ready(function() {
    $(".amount").on("input", function() {
        // allow numbers, a comma or a dot
        $(this).val($(this).val().replace(/[^0-9,\.]+/, ''));
    });
});