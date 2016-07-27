$(document).on("click", ".btn-create-localidad", function () {
	$("#nombre_c").val("");
	$("#nombre_c").focus();
});

$("#pais_c").on('change', function (){
	var id = $("#pais_c").val();

    $.ajax({
		url:  'provinciasPais',
        type: 'GET',
        data: 'id=' + id,

		success:  function (data)
		{
			var opciones = "";
			$.each(data, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#provincia_c").html(opciones);
		}
	});
});