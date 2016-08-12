$("#especialidad_id").on('change', function (){
	var id = $("#especialidad_id").val();

    $.ajax({
		url:  'diasAtencion_esp',
        type: 'GET',
        data: 'id=' + id,

		success:  function (dias)
		{
			//habilitamos el calendario
			$("#calendar-picker").attr('class', 'panel panel-default');
			//deshablilitamos el resto
			$("#medicos").attr('class', 'form-group hidden');
			$("#hour-picker").attr('class', 'panel panel-default hidden');
			$("#buttons").attr('class', 'hidden');
			$('#datepicker-center').html('<div id="calpicker"></div>');
			configurarCalendario(dias);
		}
	});

	function configurarCalendario(dias){
		$('#calpicker').datepicker({
			daysOfWeekDisabled: setDiasDeshabilitados(dias)
		}).on("changeDate", function() {
			$('#fecha_dp').val(
				$('#calpicker').datepicker('getFormattedDate')
			);
			calendarClick();
		}).focus();
	}

	function setDiasDeshabilitados(dias){
		result=[];
		days=[];
		//agregamos a un arreglo los diçías de atención del médico en cuestión
		//lo hacemos de la forma (por ej., si atendiera lun y vie):
		//dias[0] = 1; dias[1] = 5;
		for (i = 0; i < dias.length; i++) {
			days[i]=dias[i].dia_id;
		}
		//verificamos uno a uno los siete días de la semana y agregamos a result[],
		//aquellos que se encuentren en dias[]
		for (j = 0; j < 7; j++) {
			if(days.indexOf(j) == -1 ){
				result.push(j);
			}
		}
		//retornamos los días en un arreglo simple, el del ejemplo quedaría: [1, 5]
		return result;
	}
});

function calendarClick(){
	//obtenemos el dia_id, respetando la codificación de php, la cual usamos en la bd, 
	//corresponiente al modelo "Dia" del proyecto
	fecha = $("#fecha_dp").val();
	date_string = fecha.substring(6, 10) + '-' + fecha.substring(3, 5) + '-' + fecha.substring(0, 2);
	date = new Date(date_string);
	dia_id = (date.getDay() + 1) % 7;
	especialidad_id = $("#especialidad_id").val();

	$.ajax({
		url: 'medicosDia',
		type: 'GET',
		data: 'dia_id=' + dia_id + '&especialidad_id=' + especialidad_id,

		success: function(medicos){
			//desocultamos el panel de selección de médicos
			$("#medico_id").attr('class', 'form-control')
			//ocultamos el panel de botones de aceptar/cancelar y los horarios
			$("#buttons").attr('class', 'hidden');
			$("#hour-picker").attr('class', 'panel panel-default hidden');

			//armamos los medicos
			var opciones = "";
			var tam = 0;
			$.each(medicos, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.apellido+"</option>");
				tam += 1;
			});
			
			$("#medicos").attr('class', 'form-group');
			$("#medico_id").html(opciones);
			if(tam == 1){$("#medico_id").change()}
		}
	});
}

$("#medico_id").on('change', function (){
	var fecha = $("#fecha_dp").val();
	var medico_id = $("#medico_id").val();

	$.ajax({
		url: 'diaDisponible',
		type: 'GET',
		data: 'fecha=' + fecha + '& medico_id=' + medico_id,

		success: function(horarios){
			//desocultamos el panel de horarios
			$("#hour-picker").attr('class', 'panel panel-default')
			//ocultamos el panel de botones de aceptar/cancelar
			$("#buttons").attr('class', 'hidden');

			//armamos los horarios
			var opciones = "";
			$.each(horarios, function(key,value) {
				if(value){
					attrEnabled = '';
					label = "<label>"+key.substring(0, 5)+"&nbsp;&nbsp;&nbsp;&nbsp;</label>";
				}else{
					attrEnabled = 'disabled=true';
					label = "<label class='noDisp'>"+key.substring(0, 5)+"&nbsp;&nbsp;&nbsp;&nbsp;</label>";
				}
				opciones = opciones + label + ("<input type='radio' onclick='horarioSeleccionado()' name='hora' "+attrEnabled+"value="+key.substring(0, 5)+"></input><br>");
			});

			$("#horarios").html(opciones).focus();
		}
	});
});

function horarioSeleccionado(){
	$("#buttons").attr('class', '');
	$("#btn-submit").focus();
}