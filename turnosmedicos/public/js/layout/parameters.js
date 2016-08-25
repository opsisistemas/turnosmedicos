$(document).ready(function() {
    $.ajax({
		url:  'getEmpresa',
        type: 'GET',

		success:  function (empresa)
		{
			$(".titulo").html(empresa.nombre);
		}
	});
});