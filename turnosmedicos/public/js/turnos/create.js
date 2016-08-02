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

			$("#medico_id").html(opciones).focus().change();
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
			$("#calendario").html("<div class='form-group' id='datepicking' onclick='calendarClick()'><div style='overflow:hidden;'><div class='form-group'><div class='row'><div class='col-md-8'><div id='calendar'></div></div></div></div></div></div>");
			$("#datepicking").datepicker({
				inline: true,
				sideBySide: true,
				daysOfWeekDisabled: setDiasDeshabilitados(dias)
			}).on('changeDate', function(e){
      			$('#fecha_dp').val(e.format('dd-mm-yyyy'))
			}).focus();
		}
	});

	function setDiasDeshabilitados(dias){
		result=[];
		days=[];
		for (i = 0; i < dias.length; i++) {
			days[i]=dias[i].dia;
		}
		for (j = 0; j < 7; j++) {
			if(days.indexOf(j) == -1 ){
				result.push(j);
			}
		}
		return result;
	}
});

function calendarClick(){
	var fecha = $("#fecha_dp").val();
	var medico_id = $("#medico_id").val();

	$.ajax({
		url: 'diaDisponible',
		type: 'GET',
		data: 'fecha=' + fecha + '& medico_id=' + medico_id,

		success: function(horarios){
			var opciones = "";
			$.each(horarios, function(key,value) {
				if(value){attrEnabled = "";}else{attrEnabled = 'disabled=true';}
				opciones = opciones + ("<input type='radio' onclick='horarioSeleccionado()' name='hora' "+attrEnabled+"value="+key+"> "+key.substring(0, 5)+"<br>");
			});

			$("#horarios").html(opciones).focus();
		}
	});
}

function horarioSeleccionado(){
	$("#buttons").attr('class', '');
	$("#btn-submit").focus();
}