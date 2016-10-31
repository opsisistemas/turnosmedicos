$(document).on("click", ".btn-create-tipopago", function () {
	$("#codigo_c").val("");
	$("#descripcion_c").val("");
	$("#descripcion_c").focus();
});

//controlamos que se ingresa
$('#codigo_c').keydown ( function (e) {
    //list of functional/control keys that you want to allow always
    var keys = [8, 9, 16, 17, 18, 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 144, 145];

    if( $.inArray(e.keyCode, keys) == -1) {
        if (checkMaxLength ($('#codigo_c').val(), 1)) {
        	alert('El campo debe contener solamente un caracter!');
			$('#codigo_c').val('');
        }
    }
});

function checkMaxLength (text, max) {
    return (text.length >= max);
}