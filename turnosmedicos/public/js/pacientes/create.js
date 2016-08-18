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