$("#pais_e").on('change', function (){
	var id = $("#pais_e").val();

    $.ajax({
		url:  'provinciasPais',
        type: 'GET',
        data: 'id=' + id,

		success:  function (provincias)
		{
			var opciones = "";
			$.each(provincias, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#provincia_e").html(opciones).change();
		}
	});
});

$("#provincia_e").on('change', function (){
	var id = $("#provincia_e").val();

    $.ajax({
		url:  'localidadesProvincia',
        type: 'GET',
        data: 'id=' + id,

		success:  function (localidades)
		{
			var opciones = "";
			$.each(localidades, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#localidad_e").html(opciones);
		}
	});
});

$("#obra_social_e").on('change', function (){
	var id = $("#obra_social_e").val();

    $.ajax({
		url:  'planesObraSocial',
        type: 'GET',
        data: 'id=' + id,

		success:  function (planes)
		{
			var opciones = "";
			$.each(planes, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#plan_e").html(opciones);
		}
	});
});

$().ready(function(){
	value = $('#fechaNacimiento_e').val();

	day = value.substring(8, 10);
	month = value.substring(5, 7);
	year = value.substring(0, 4);

	comp_fecha = day + '-' + month + '-' + year;
	
	$('#fechaNacimiento_e').val(comp_fecha);
});