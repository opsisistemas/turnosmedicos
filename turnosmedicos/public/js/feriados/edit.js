$(document).on("click", ".btn-edit-feriado", function () {
	//me guardo el feriado_id (que manda el button en el atributo "data-id")
    var feriado_id = $(this).data('id');   

    //#feriadoId es un input de tipo hidden en el edit.blade.php de feriados
	$("#feriado_id").val(feriado_id);

	//consulto para obtener los datos del feriado correspondiente en BD
    $.ajax({
		url:  'getFeriado',
        type: 'GET',
        data: 'id=' + feriado_id,

		success:  function (feriado)
		{
			//feriado es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "feriados/"+feriado_id);
			$("#descripcion_e").val( feriado[0].descripcion );
			$("#fecha_e").val( feriado[0].fecha );
			$("#descripcion_e").focus();
		}
	});
});