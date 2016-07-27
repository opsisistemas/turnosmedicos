$(document).on("click", ".btn-edit-plan", function () {
	//me guardo el idPlan (que manda el button en el atributo "data-id")
    var idPlan = $(this).data('id');   

    //#plan_id es un input de tipo hidden en el edit.blade.php de plans
	$("#plan_id").val( idPlan );

	//consulto para obtener los datos del plan correspondiente en BD
    $.ajax({
		url:  'getPlan',
        type: 'GET',
        data: 'id=' + idPlan,

		success:  function (plan)
		{
			//plan es un arreglo con un sólo elemento (accedemos con [0])
			$("#formEdit").attr("action", "plans/"+idPlan);
			$("#nombre_e").val( plan[0].nombre );
			$("#nombre_e").focus();
			$("#obra_social_e").val(plan[0].obra_social_id);
		}
	});
});