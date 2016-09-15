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

$(function() {
    $('#dni').on('keypress', function(e) {
        //#48 = 0, #57 = 9, ## < 32 = Caracteres de control
        if (((e.which >= 48)&&(e.which <=57))||(e.which < 32)){
            return true;
        }else{
            return false;
        }
    });
});