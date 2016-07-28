$(document).on("click", ".btn-create-medico", function () {
	$("#apellido_c").val("");
	$("#nombre_c").val("");
	$("#telefono_c").val("");
	$("#nroDocumento_c").val("");

	//consulto para obtener las especialidades desde la BD
	//lo hago así para cargarlo sólo en el caso de "create" y no cuando se carga la página
    $.ajax({
		url:  'getEspecialidades',
        type: 'GET',

		success:  function (especialidad)
		{
			var opciones = "<option value=-1>--Seleccionar--</option>";
			$.each(especialidad, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.descripcion+"</option>");
			});
			$("#especialidad_c").html(opciones);
			$("#apellido_c").focus();
		}
	});
});