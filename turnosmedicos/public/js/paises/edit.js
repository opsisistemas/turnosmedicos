$(document).on("click", ".btn-edit-pais", function () {
	//me guardo el idPais (que manda el button en el atributo "data-id")
    var idPais = $(this).data('id');   

    //#paisId es un input de tipo hidden en el edit.blade.php de paises
	$("#pais_id").val( idPais );

	//consulto para obtener los datos del pais correspondiente en BD
    $.ajax({
		url:  'getPais',
        type: 'GET',
        data: 'id=' + idPais,

		success:  function (pais)
		{
			//pais es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "paises/"+idPais);
			$("#nombre_pais").val( pais[0].nombre );
			$("#nombre_pais").focus();
		}
	});
});