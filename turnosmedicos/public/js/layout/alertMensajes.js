$(document).ready(function() {
	id = $("#desarrollador").val();
	
    $.ajax({
		url:  'cantMensajes',
        type: 'GET',
        data: 'id=' + id,

		success:  function (mensajes)
		{
			if(mensajes > 0){
				$("#mensajes").append(' <span class="badge" style="background-color:#FF4357">' + mensajes + '</span>');
			}
		}
	});
});