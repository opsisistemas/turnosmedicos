$(document).ready(function(){
	$(".cantHoras").val($(".cantHoras").val().substring(11, 16));
	$(".datepicker").val($(".datepicker").val().substring(8, 10)+$(".datepicker").val().substring(4, 8)+$(".datepicker").val().substring(0, 4));
});