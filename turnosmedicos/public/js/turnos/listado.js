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
			$("#especialidad").html(opciones).focus();
		}
	});
});

$("#especialidad").on('change', function (){
	var id = $("#especialidad").val();

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

			$("#medico").html(opciones).focus().change();
		}
	});
});

$("#btn-search").on('click', function (){
	var medico_id = $("#medico").val();
	var dia = $("#dia").val();

    $.ajax({
		url:  'turnosMedicoDia',
        type: 'GET',
        data: 'medico=' + medico_id + '&dia=' + dia,

		success:  function (horarios)
		{
			var listado = "<tr>";
			$.each(horarios, function(key,value) {
				listado = listado + ("<td class='table-text'><div>"+value.hora.substring(10, 16)+"</div></td>");
				listado = listado + ("<td class='table-text'><div>"+value.paciente.nombre+"</div></td>");
				listado = listado + ("<td class='table-text'><div>"+value.paciente.telefono+"</div></td>");
				listado = listado + ("<td class='table-text'><div>"+value.paciente.obra_social.nombre+"</div></td>");
				listado = listado + ("<td class='table-text'><div>"+value.paciente.nro_afiliado+"</div></td>");
				listado = listado + "</tr>";
			});

			$("#listado").html(listado);
		}
	});
});


$("#btn-pdf").on('click', function (){
    $.ajax({
		url:  'pdfListado',
        type: 'GET'
	});
});