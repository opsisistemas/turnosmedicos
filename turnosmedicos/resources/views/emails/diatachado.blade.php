<!DOCTYPE html>
<html lang="es">
   <head>
		<meta charset="utf-8">
   </head>
   <body>
		<h1>Inasistencia informada por el m&eacute;dico {!! $dia_tachado->medico->nombre . ' ' . $dia_tachado->medico->apellido !!} </h1>
		<div>
			<h3>Fecha: {!! (new \Carbon\Carbon($dia_tachado->fecha))->formatLocalized('%A %d %B') !!} </h3>
			<h3> {!! '(' . (new \Carbon\Carbon($dia_tachado->fecha))->diffForHumans() . ')' !!}</h3>
			<h4>Motivo: {!! $dia_tachado->motivo !!}</h4>
			<p>
				No responder. &Eacute;ste email se ha enviado de manera autom&aacute;tica por medio del sistema de turnos del consultorio.
			</p>
		</div>
   </body>
</html>