$(document).ready(function() {
    $('.desdeHasta').timepicker({'timeFormat': 'H:i', 'step': 10, 'showDuration': true, 'scrollDefault': 'now'});
	$('.duracionTurno').timepicker({'timeFormat': 'H:i', 'step': 10, 'scrollDefault': '00:00', 'minTime': '0:00am', 'maxTime': '02:00am',});
});