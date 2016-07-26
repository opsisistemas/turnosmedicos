$(document).ready(function(){
	nombre = document.getElementsByClassName('enfocar')[0].getAttribute('name');
	tipo = document.getElementsByClassName('enfocar')[0].nodeName;

	$(tipo.toLowerCase() + "[name="+nombre+"]").focus();
});