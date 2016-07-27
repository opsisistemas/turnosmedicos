$(document).on("click", ".btn-edit-localidad", function () {
	//me guardo el idLocalidad (que manda el button en el atributo "data-id")
    var idLocalidad = $(this).data('id');   

    //#localidadId es un input de tipo hidden en el edit.blade.php de localidades
	$("#localidad_id").val( idLocalidad );

	//consulto para obtener los datos del localidad correspondiente en BD
    $.ajax({
		url:  'getLocalidad',
        type: 'GET',
        data: 'id=' + idLocalidad,

		success:  function (localidad)
		{
			//localidad es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "localidades/"+idLocalidad);
			$("#nombre_e").val( localidad[0].nombre );
			setearPais(localidad[0].provincia_id);
			$("#provincia_e").val(localidad[0].provincia_id);
			$("#nombre_e").focus();
		}
	});

	function setearPais(idProvincia){
		$.ajax({
			url:  'getProvincia',
	        type: 'GET',
	        data: 'id=' + idProvincia,

			success:  function (provincia)
			{
				//provincia es un arreglo con un sólo elemento (accedemos con [0])
				$("#pais_e").val(provincia[0].pais_id).change();
			}
		});
	}
});

$("#pais_e").on('change', function (){
	var id = $("#pais_e").val();

    $.ajax({
		url:  'provinciasPais',
        type: 'GET',
        data: 'id=' + id,

		success:  function (data)
		{
			var opciones = "";
			$.each(data, function(key,value) {
				opciones = opciones + ("<option value="+value.id+">"+value.nombre+"</option>");
			});

			$("#provincia_e").html(opciones);
		}
	});
});