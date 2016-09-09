$(".checkVisto").on('change', function (){
	var id = this.value;
	var checked = document.getElementById(id).checked;

    $.ajax({
		url:  'setVisto/'+id+'&'+checked,
        type: 'GET',

		success:  function (data)
		{
			$("#filtrar").click();
		}
	});
});