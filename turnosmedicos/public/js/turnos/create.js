$(document).ready(function() {
	//consulto para obtener los paises desde la BD
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
			$("#especialidad_id").html(opciones).focus();
		}
	});
});

$("#especialidad_id").on('change', function (){
	var id = $("#especialidad_id").val();

    $.ajax({
		url:  'medicosEspecialidad',
        type: 'GET',
        data: 'id=' + id,

		success:  function (medicos)
		{
			var opciones = "";
			$.each(medicos, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#medico_id").html(opciones).focus();
		}
	});
});

$("#medico_id").on('change', function (){
	var id = $("#medico_id").val();

    $.ajax({
		url:  'diasAtencion',
        type: 'GET',
        data: 'id=' + id,

		success:  function (dias)
		{
			var opciones = "";
			$.each(dias, function(key,value) {
				opciones = opciones + ("<input type='radio' value="+value.dia+">"+value.nombre+"<br>");
			});

			$("#dias").html(opciones).focus();
		}
	});
});