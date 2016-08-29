$(document).on("click", ".btn-edit-obra_social", function () {
	//me guardo el obra_social_id (que manda el button en el atributo "data-id")
    var obra_social_id = $(this).data('id');   

    //#obra_socialId es un input de tipo hidden en el edit.blade.php de obra_sociales
	$("#obra_social_id").val( obra_social_id );

	//consulto para obtener los datos del obra_social correspondiente en BD
    $.ajax({
		url:  'getObraSocial',
        type: 'GET',
        data: 'id=' + obra_social_id,

		success:  function (obra_social)
		{
			//obra_social es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "obras_sociales/"+obra_social_id);
			$("#codigo_e").val( obra_social[0].codigo);
			$("#nombre_e").val( obra_social[0].nombre );
			$("#pagina_web_e").val( obra_social[0].pagina_web );
			$("#email_e").val( obra_social[0].email);
			$("#telefono_e").val( obra_social[0].telefono);
			$("#nombre_e").focus();
		}
	});
});