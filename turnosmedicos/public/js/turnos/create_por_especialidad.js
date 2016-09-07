$().ready( function(){
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

$("#especialidad_id").on('change', function (){
	var id = $("#especialidad_id").val();

    $.ajax({
		url:  'diasAtencion_esp',
        type: 'GET',
        data: 'id=' + id,

		success:  function (dias)
		{
			//habilitamos el calendario
			$("#calendar-picker").attr('class', '');
			//deshablilitamos el resto
			$("#medicos").attr('class', 'form-group hidden');
			$("#hour-picker").attr('class', 'hidden');
			$("#buttons").attr('class', 'hidden');
			$('#datepicker-center').html('<div id="calpicker"></div>');
			configurarCalendario(dias);
		}
	});

	function configurarCalendario(dias){
		var forbidden = $('#feriados').html();//['28-9-2016', '29-9-2016', '30-9-2016'];

		$('#calpicker').datepicker({
			daysOfWeekDisabled: setDiasDeshabilitados(dias),
			startDate: new Date(),
			beforeShowDay:function(Date){
		        //
		        var curr_day = Date.getDate();
		        var curr_month = Date.getMonth()+1;
		        var curr_year = Date.getFullYear();        
		        var curr_date=curr_day+'-'+curr_month+'-'+curr_year;

		        if (forbidden.indexOf(curr_date)>-1) return false;
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
			$("#hour-picker").attr('class', 'hidden');

			//armamos los medicos
			var opciones = "";
			var tam = 0;
			$.each(medicos, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.apellido+"</option>");
				tam += 1;
			});
			
			$("#medicos").attr('class', 'form-group');
			$("#medico_id").html(opciones);
			$("#medico_id").change();
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
});

function horarioSeleccionado(){
	$("#buttons").attr('class', '');
	$("#btn-submit").focus();
}

$("#btn-modalconfirm").on("click", function () {
	especialidad = $("#especialidad_id option:selected").html();
	$("#especialidad").html(especialidad);

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