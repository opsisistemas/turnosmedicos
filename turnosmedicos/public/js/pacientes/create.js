$(document).on("click", ".btn-create-paciente", function () {
	$("#apellido_c").val("");
	$("#nombre_c").val("");
	$("#telefono_c").val("");
	$("#nroDocumento_c").val("");

	//consulto para obtener los paises desde la BD
	//lo hago así para cargarlo sólo en el caso de "create" y no cuando se carga la página
    $.ajax({
		url:  'getPaises',
        type: 'GET',

		success:  function (pais)
		{
			var opciones = "<option value=-1>--Seleccionar--</option>";
			$.each(pais, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});
			$("#pais_c").html(opciones);
		}
	});

    $.ajax({
		url:  'getObrasSociales',
        type: 'GET',

		success:  function (obras_sociales)
		{
			var opciones = "<option value=-1>--Seleccionar--</option>";
			$.each(obras_sociales, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});
			$("#obra_social_c").html(opciones);

			$("#apellido_c").focus();
		}
	});
});

$("#pais_c").on('change', function (){
	var id = $("#pais_c").val();

    $.ajax({
		url:  'provinciasPais',
        type: 'GET',
        data: 'id=' + id,

		success:  function (provincias)
		{
			var opciones = "<option value=-1>--Seleccionar--</option>";
			$.each(provincias, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#provincia_c").html(opciones).change();
		}
	});
});

$("#provincia_c").on('change', function (){
	var id = $("#provincia_c").val();

    $.ajax({
		url:  'localidadesProvincia',
        type: 'GET',
        data: 'id=' + id,

		success:  function (localidades)
		{
			var opciones = "<option value=-1>--Seleccionar--</option>";
			$.each(localidades, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#localidad_c").html(opciones);
		}
	});
});

$("#obra_social_c").on('change', function (){
	var id = $("#obra_social_c").val();

    $.ajax({
		url:  'planesObraSocial',
        type: 'GET',
        data: 'id=' + id,

		success:  function (planes)
		{
			var opciones = "<option value=-1>--Seleccionar--</option>";
			$.each(planes, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#plan_c").html(opciones);
		}
	});
});