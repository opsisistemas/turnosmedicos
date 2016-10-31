$(document).on("click", ".btn-edit-tipopago", function () {
	//me guardo el tipopago_id (que manda el button en el atributo "data-id")
    var tipopago_id = $(this).data('id');   

    //#tipopagoId es un input de tipo hidden en el edit.blade.php de tipopagos
	$("#tipopago_id").val( tipopago_id );

	//consulto para obtener los datos del tipopago correspondiente en BD
    $.ajax({
		url:  'getTipoPago',
        type: 'GET',
        data: 'id=' + tipopago_id,

		success:  function (tipopago)
		{
			//tipopago es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "tipopago/"+tipopago_id);
			$("#codigo_e").val( tipopago[0].codigo);
			$("#descripcion_e").val( tipopago[0].descripcion);
			$("#descripcion_e").focus();
		}
	});
});