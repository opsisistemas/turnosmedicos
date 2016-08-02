$(document).on("click", ".btn-edit-medico", function () {
	//me guardo el idMedico (que manda el button en el atributo "data-id")
    var idMedico = $(this).data('id');   

    //#medicoId es un input de tipo hidden en el edit.blade.php de medicoes
	$("#medico_id").val( idMedico );

	//consulto para obtener las especialidades desde la BD
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
			$("#especialidad_e").html(opciones);
		}
	});

	//consulto para obtener los datos del medico correspondiente en BD
    $.ajax({
		url:  'getMedico',
        type: 'GET',
        data: 'id=' + idMedico,

		success:  function (medico)
		{			
			$("#formEdit").attr("action", "medicos/"+idMedico);
			$("#apellido_e").val(medico.apellido);
			$("#nombre_e").val(medico.nombre);
			$("#tipoDocumento_e").val(medico.tipoDocumento);
			$("#nroDocumento_e").val(medico.nroDocumento);
			$("#sexo_e").val(medico.sexo);
			$("#telefono_e").val(medico.telefono);
			$("#fechaNacimiento_e").val(medico.fechaNacimiento.substring(8, 10)+medico.fechaNacimiento.substring(4, 8)+medico.fechaNacimiento.substring(0, 4));
			$("#email_e").val(medico.email);
			$("#especialidad_e").val(medico.especialidad_id);
			$("#duracionTurno_e").val(medico.duracionTurno.substring(11, 16));
			$("#especialidad_id_e").val(medico.especialidad.id);
			
			//$("#apellido_e").focus();
			
		}
	});

});