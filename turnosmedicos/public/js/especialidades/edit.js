$(document).on("click", ".btn-edit-especialidad", function () {
	//me guardo el idEspecialidad (que manda el button en el atributo "data-id")
    var idEspecialidad = $(this).data('id');   

    //#especialidadId es un input de tipo hidden en el edit.blade.php de especialidades
	$("#especialidad_id").val( idEspecialidad );

	//consulto para obtener los datos del especialidad correspondiente en BD
    $.ajax({
		url:  'getEspecialidad',
        type: 'GET',
        data: 'id=' + idEspecialidad,

		success:  function (especialidad)
		{
			//especialidad es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "especialidades/"+idEspecialidad);
			$("#descripcion_e").val( especialidad[0].descripcion );
			$("#descripcion_e").focus();
		}
	});
});