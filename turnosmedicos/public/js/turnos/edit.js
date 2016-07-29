$(document).on("click", ".btn-edit-provincia", function () {
	//me guardo el idProvincia (que manda el button en el atributo "data-id")
    var idProvincia = $(this).data('id');   

    //#provincia_id es un input de tipo hidden en el edit.blade.php de provincias
	$("#provincia_id").val( idProvincia );

	//consulto para obtener los datos del provincia correspondiente en BD
    $.ajax({
		url:  'getProvincia',
        type: 'GET',
        data: 'id=' + idProvincia,

		success:  function (provincia)
		{
			//provincia es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "provincias/"+idProvincia);
			$("#nombre_e").val( provincia[0].nombre );
			$("#nombre_e").focus();
			$("#pais_e").val(provincia[0].pais_id);
		}
	});
});