//Place this plugin snippet into another file in your applicationb
(function ($) {
    $.toggleShowPassword = function (options) {
        var settings = $.extend({
            field: "#password",
            control: "#toggle_show_password",
        }, options);

        var control = $(settings.control);
        var field = $(settings.field)

        control.bind('click', function () {
            if (control.is(':checked')) {
                field.attr('type', 'text');
            } else {
                field.attr('type', 'password');
            }
        })
    };
}(jQuery));

//Here how to call above plugin from everywhere in your application document body
$.toggleShowPassword({
    field: '.pwd',
    control: '#eye'
});

$('#reload-captcha').on('click', function(){
    $.ajax({
        url: 'getCaptcha',
        type: 'GET',

        success: function(captcha){
            $('#captcha').html(captcha);
        }
    });
});