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
			//medico es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "medicos/"+idMedico);
			$("#apellido_e").val(medico[0].apellido);
			$("#nombre_e").val(medico[0].nombre);
			$("#tipoDocumento_e").val(medico[0].tipoDocumento);
			$("#nroDocumento_e").val(medico[0].nroDocumento);
			$("#sexo_e").val(medico[0].sexo);
			$("#telefono_e").val(medico[0].telefono);
			$("#fechaNacimiento_e").val(medico[0].fechaNacimiento.substring(8, 10)+medico[0].fechaNacimiento.substring(4, 8)+medico[0].fechaNacimiento.substring(0, 4));
			$("#email_e").val(medico[0].email);
			$("#duracionTurno_e").val(medico[0].duracionTurno.substring(11, 16));
			setEspecialidad(medico[0].especialidad_id);
		}
	});

	function setEspecialidad(id) {
		$("#especialidad_id_e").val(id);
		$("#apellido_e").focus();
	}
});