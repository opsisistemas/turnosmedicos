$(document).on("click", ".btn-edit-paciente", function () {
	//me guardo el idPaciente (que manda el button en el atributo "data-id")
    var idPaciente = $(this).data('id');   

    //#pacienteId es un input de tipo hidden en el edit.blade.php de pacientees
	$("#paciente_id").val( idPaciente );

	//consulto para obtener los paises desde la BD
	//lo hago así para cargarlo sólo en el caso de "create" y no cuando se carga la página
    $.ajax({
		url:  'getPaises',
        type: 'GET',

		success:  function (pais)
		{
			var opciones = "";
			$.each(pais, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});
			$("#pais_e").html(opciones).change();
		}
	});

    $.ajax({
		url:  'getObrasSociales',
        type: 'GET',

		success:  function (obras_sociales)
		{
			var opciones = "";
			$.each(obras_sociales, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});
			$("#obra_social_e").html(opciones).change();;

			$("#apellido_e").focus();
		}
	});

    $.ajax({
		url:  'getTiposPago',
        type: 'GET',

		success:  function (tipos)
		{
			var opciones = "";
			$.each(tipos, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.codigo+"</option>");
			});
			$("#tipo_pago_id_e").html(opciones).change();
		}
	});

	//consulto para obtener los datos del paciente correspondiente en BD
    $.ajax({
		url:  'getPaciente',
        type: 'GET',
        data: 'id=' + idPaciente,

		success:  function (paciente)
		{
			//paciente es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "pacientes/"+idPaciente);
			$("#apellido_e").val(paciente[0].apellido);
			$("#nombre_e").val(paciente[0].nombre);
			$("#tipoDocumento_e").val(paciente[0].tipoDocumento);
			$("#nroDocumento_e").val(paciente[0].nroDocumento);
			$("#sexo_e").val(paciente[0].sexo);
			$("#telefono_e").val(paciente[0].telefono);
			if (paciente[0].fechaNacimiento !== null) {
				$("#fechaNacimiento_e").val(paciente[0].fechaNacimiento.substring(8, 10)+paciente[0].fechaNacimiento.substring(4, 8)+paciente[0].fechaNacimiento.substring(0, 4));
			}
			$("#pais_e").val(paciente[0].pais_id);
			$("#provincia_e").val(paciente[0].provincia_id);
			$("#localidad_e").val(paciente[0].localidad_id);
			$("#obra_social_e").val(paciente[0].obra_social_id);
			$("#plan_e").val(paciente[0].plan);
			$("#nro_afiliado_e").val(paciente[0].nro_afiliado);
			$("#tipo_pago_id_e").val(paciente[0].tipo_pago_id);
			$("#factura_e").attr('checked', (paciente[0].factura == 1));
			$("#observaciones_e").val(paciente[0].observaciones);
		}
	});
});

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