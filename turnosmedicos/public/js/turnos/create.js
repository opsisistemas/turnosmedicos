$("#medico_id").on('change', function (){
	var id = $("#medico_id").val();

    $.ajax({
		url:  'diasAtencion',
        type: 'GET',
        data: 'id=' + id,

		success:  function (dias)
		{
			getEspecialidades();
			//habilitamos el calendario
			$("#calendar-picker").attr('class', '')
			//deshablilitamos el resto
			$("#hour-picker").attr('class', 'hidden')
			$("#buttons").attr('class', 'hidden')			
			$('#datepicker-center').html('<div id="calpicker"></div>');
			configurarCalendario(dias);
		}
	});

	function getEspecialidades(){
		$.ajax({
			url: 'especialidadesMedico',
			type: 'GET',
			data: 'id=' + id,

			success: function (especialidades)
			{
				//armamos los especialidades
				var opciones = "";
				var tam = 0;
				$.each(especialidades, function(key,value) {
					opciones = opciones + ("<option value="+value.id+">"+value.descripcion+"</option>");
					tam += 1;
				});
				
				$("#especialidad_id").html(opciones);
				if(tam > 1){
					//habilitamos la especialidad (si es más de una, el usuario debería informarla)
					$("#especialidad").attr('class', 'form-group');
				}else{
					//si sólo tiene una especialidad, no es necesario que el paciente la informe desde ésta utilidad 
					$("#especialidad").attr('class', 'form-group hidden');
				}
			}
		});
	}

	function configurarCalendario(dias){
		$('#calpicker').datepicker({
			daysOfWeekDisabled: setDiasDeshabilitados(dias), startDate: new Date()
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
	var fecha = $("#fecha_dp").val();
	var medico_id = $("#medico_id").val();

	$.ajax({
		url: 'diaDisponible',
		type: 'GET',
		data: 'fecha=' + fecha + '& medico_id=' + medico_id,

		success: function(horarios){
			//desocultamos el panel de horarios
			$("#hour-picker").attr('class', '')
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
}

function horarioSeleccionado(){
	$("#buttons").attr('class', '');
	$("#btn-submit").focus();
}