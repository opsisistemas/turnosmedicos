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

			diasAtencionMedico();
		}
	});

	function diasAtencionMedico(){
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
				//habilitamos el calendario
				$("#calendar-picker").attr('class', '')
				$('#datepicker-center').html('<div id="calpicker"></div>');

				configurarCalendario(dias);
			}
		});
	}

	function getDiasTachados(){
		var id = $("#medico_id").val();

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
		});
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