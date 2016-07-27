$(document).on("click", ".btn-edit-obra_social", function () {
	//me guardo el idobra_social (que manda el button en el atributo "data-id")
    var idobra_social = $(this).data('id');   

    //#obra_socialId es un input de tipo hidden en el edit.blade.php de obra_sociales
	$("#obra_social_id").val( idobra_social );

	//consulto para obtener los datos del obra_social correspondiente en BD
    $.ajax({
		url:  'getObraSocial',
        type: 'GET',
        data: 'id=' + idobra_social,

		success:  function (obra_social)
		{
			//obra_social es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "obras_sociales/"+idobra_social);
			$("#nombre_e").val( obra_social[0].nombre );
			$("#pagina_web_e").val( obra_social[0].pagina_web );
			$("#email_e").val( obra_social[0].email);
			$("#telefono_e").val( obra_social[0].telefono);
			$("#nombre_e").focus();
		}
	});
});