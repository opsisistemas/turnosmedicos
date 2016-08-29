$(document).on("click", ".btn-edit-asunto", function () {
	//me guardo el asunto_id (que manda el button en el atributo "data-id")
    var asunto_id = $(this).data('id');   

    //#asuntoId es un input de tipo hidden en el edit.blade.php de asuntos
	$("#asunto_id").val( asunto_id );

	//consulto para obtener los datos del asunto correspondiente en BD
    $.ajax({
		url:  'getAsunto',
        type: 'GET',
        data: 'id=' + asunto_id,

		success:  function (asunto)
		{
			//asunto es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "asuntos/"+asunto_id);
			$("#nombre_e").val( asunto[0].nombre );
			$("#descripcion_e").val( asunto[0].descripcion );
			$("#descripcion_e").focus();
		}
	});
});