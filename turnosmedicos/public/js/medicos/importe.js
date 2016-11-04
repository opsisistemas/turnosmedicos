$('.categoria').on('change', function(){
	if($('.categoria').val() == 4){
		$('#importe').attr('class', 'form-group');
	}else{
		$('#importe').attr('class', 'hidden form-group');
	}
});