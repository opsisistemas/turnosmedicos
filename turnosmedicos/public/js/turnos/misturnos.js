$(document).on("click", ".btn-cancel-turno", function () {
	//me guardo el turno_id (que manda el button en el atributo "data-id")
    var turno_id = $(this).data('id');   
	$("#formCancel").attr("action", "turnos.cancel/"+turno_id);
});