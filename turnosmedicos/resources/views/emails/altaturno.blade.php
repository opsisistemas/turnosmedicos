<!DOCTYPE html>
<html lang="es">
   <head>
		<meta charset="utf-8">
   </head>
   <body>
		<h1>Aviso de Turno en Consultorio</h1>
		<div>
			<h3>Usted Tiene un turno para {!! $especialidad->descripcion !!}</h3>
			<h3>Con el m&eacute;dico {!! $medico->apellido . ', ' . $medico->nombre !!}</h3>
			<h4>El d&iacute;a {!! (new \Carbon\Carbon($turno->fecha))->format('d-m-Y') !!}</h4>
			<h4>A las {!! (new \Carbon\Carbon($turno->hora))->format('H:i') !!}</h4>

			<p>
				No responder. &Eacute;ste email se ha enviado de manera autom&aacute;tica por medio del sistema de turnos del consultorio.
			</p>
		</div>
   </body>
</html>