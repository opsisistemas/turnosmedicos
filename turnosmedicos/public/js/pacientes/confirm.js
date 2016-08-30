$(document).on("click", ".btn-confirm-paciente", function () {
	//me guardo el idPaciente (que manda el button en el atributo "data-id")
    var idPaciente = $(this).data('id');   

    //#pacienteId es un input de tipo hidden en el edit.blade.php de pacientees
	$(".paciente_id").val( idPaciente );

	//consulto para obtener los datos del paciente correspondiente en BD
    $.ajax({
		url:  'getPaciente',
        type: 'GET',
        data: 'id=' + idPaciente,

		success:  function (paciente)
		{
			//paciente es un arreglo con un sólo elemento (accedemos con [0])
			$("#formConfirm").attr("action", "pacientes/"+idPaciente);
			$("#paciente_a_confirmar").html(paciente[0].apellido + ', ' + paciente[0].nombre);
		}
	});
});