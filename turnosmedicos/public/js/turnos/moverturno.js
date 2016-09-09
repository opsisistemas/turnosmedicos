$('btn-mover-turno').on('click', function(){
	//Al cargar la página, cargamos los feriados de la BD
	$.ajax({
		url: 'getFeriados',
		type: 'GET',

		success: function (feriados)
		{
			//armamos los feriados
			var a_feriados = [];
			$.each(feriados, function(key,value) {
				day = value.fecha.substring(8, 10);
				month = value.fecha.substring(5, 7);
				year = value.fecha.substring(0, 4);
				
				comp_fecha = day + '-' + month + '-' + year;

				a_feriados.push(comp_fecha);
			});
			$('#feriados').html(a_feriados);
		}
	});
});

$("#medico_id").on('change', function (){
	var id = $("#medico_id").val();

    $.ajax({
		url:  'diasAtencion',
        type: 'GET',
        data: 'id=' + id,

        beforeSend: function()
        {
			getDiasTachados();
        },

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

	function getDiasTachados(){
		$.ajax({
			url: 'getDiasTachados',
			type: 'GET',
	        data: 'id=' + id,

			success: function (dias_tachados)
			{
				//armamos los dias_tachados
				var a_dias_tachados = [];
				$.each(dias_tachados, function(key,value) {
					day = value.fecha.substring(8, 10);
					month = value.fecha.substring(5, 7);
					year = value.fecha.substring(0, 4);
					
					comp_fecha = day + '-' + month + '-' + year;

					a_dias_tachados.push(comp_fecha);
				});

				$('#dias_tachados').html(a_dias_tachados);
			}
		});
	}

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
		var feriados = $('#feriados').html();//['28-9-2016', '29-9-2016', '30-9-2016'];
		var dias_tachados = $('#dias_tachados').html();

		$('#calpicker').datepicker({
			daysOfWeekDisabled: setDiasDeshabilitados(dias),
			startDate: new Date(),
			beforeShowDay:function(Date){
		        //
		        var curr_day = Date.getDate();
		        var curr_month = Date.getMonth()+1;
		        var curr_year = Date.getFullYear();        
		        var curr_date=curr_day+'-'+curr_month+'-'+curr_year;

		        if ((feriados.indexOf(curr_date)>-1)||(dias_tachados.indexOf(curr_date)>-1)) return false;
    		}
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
		//agregamos a un arreglo los días de atención del médico en cuestión
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
		//agregamos sábados y domingos
		result.push(0);
		result.push(6);
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
			//averigüamos el rol del usuario
			esPaciente = ($('#paciente_id').val() == null);

			//armamos los horarios
			var opciones = "";
			$.each(horarios, function(key,value) {
				if(value){
					attrEnabled = "class='turno'";
					label = "<label>"+key.substring(0, 5)+"&nbsp;&nbsp;&nbsp;&nbsp;</label>";
				}else{
					if(esPaciente){
						attrEnabled = "class='turno' 'disabled=true";
					}else{
						attrEnabled = "class='sobreturno'";
					}
					label = "<label class='noDisp'>"+key.substring(0, 5)+"&nbsp;&nbsp;&nbsp;&nbsp;</label>";
				}
				opciones = opciones + label + ("<input type='radio' onclick='horarioSeleccionado()' name='hora' "+attrEnabled+"value="+key.substring(0, 5)+"></input><br>");
			});

			$("#horarios").html(opciones).focus();
		}
	});
}

function horarioSeleccionado(){
	//diferenciamos los sobreturnos con las clases de los radiobuttons,
	//así se lo pasamos al controlador en el campo hidden 'sobreturno'
	if($("input[name='hora']:checked").attr('class') == 'sobreturno'){
		$('#sobreturno').val('1');
	}else{
		$('#sobreturno').val('0');
	}

	//habilitamos los botones para aceptar
	$("#buttons").attr('class', '');
	$("#btn-modalconfirm").focus();
}

$("#btn-modalconfirm").on("click", function () {
	medico = $("#medico_id option:selected").html();
	$("#medico").html(medico);

	adate = $("#calpicker").data("datepicker").getDate();
	var weekday = new Array(7);
	weekday[0]=  "Domingo";
	weekday[1] = "Lunes";
	weekday[2] = "Martes";
	weekday[3] = "Mi&eacute;rcoles";
	weekday[4] = "Jueves";
	weekday[5] = "Viernes";
	weekday[6] = "S&aacute;bado";

	var dia = weekday[adate.getDay()];

	var months = new Array(7);
	months[0]=  "Enero";
	months[1] = "Febrero";
	months[2] = "Marzo";
	months[3] = "Abril";
	months[4] = "Mayo";
	months[5] = "Junio";
	months[6] = "Julio";
	months[7] = "Agosto";
	months[8] = "Septiembre";
	months[9] = "Octubre";
	months[10] = "Noviembre";
	months[11] = "Diciembre";

	var mes = months[adate.getMonth()]; 

	formatted = dia + " " + adate.getDate() + " de " + mes;
	$("#dia").html(formatted);

	hora = $("input[name='hora']:checked").val();
	$("#hora").html(hora);
});