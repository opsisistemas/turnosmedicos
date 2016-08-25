$(document).on("click", ".btn-show-mensaje", function () {
	//me guardo el idmensaje (que manda el button en el atributo "data-id")
    var idmensaje = $(this).data('id');   

    //#mensajeId es un input de tipo hidden en el edit.blade.php de mensajes
	$("#mensaje_id").val( idmensaje );

	//consulto para obtener los datos del mensaje correspondiente en BD
    $.ajax({
		url:  'getMensaje',
        type: 'GET',
        data: 'id=' + idmensaje,

		success:  function (mensaje)
		{
			//mensaje es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "mensajes/"+idmensaje);
			$("#asunto").val( mensaje[0].asunto);
			$("#destinatario").val( mensaje[0].destinatario);
			$("#cuerpo").val( mensaje[0].cuerpo);
			if(mensaje[0].visto == 0){
				$("#visto_s").checked = false;
			}else{
				$("#visto_s").checked = true;
			}
		}
	});
});