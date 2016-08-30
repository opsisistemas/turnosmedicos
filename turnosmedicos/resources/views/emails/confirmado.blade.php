<!DOCTYPE html>
<html lang="es">
   <head>
		<meta charset="utf-8">
   </head>
   <body>
		<h1>{!! $empresa->nombre !!}</h1>
		<div>
			<h4> Estimado paciente </h4>
			<p>
				Se ha procesado correctamente el alta de sus datos en nuestro sistema. sea usted bienvenido a nuestra empresa.
			</p>
			<p>
				Si desea contactarnos por otros medios, nuestros datos de contacto a continuaci&oacute;n:
			</p>
			<p>
				Tel&eacute;fono: <strong>{!! $empresa->telefono1 . ' / ' . $empresa->telefono2 !!}</strong>
				Direcci&oacute;n: <strong>{!! $empresa->direccion !!}</strong>
			</p>

			<p>
				Muchas gracias.
			</p>

			<p>
				No responder. &Eacute;ste email se ha enviado de manera autom&aacute;tica por medio del sistema de turnos del consultorio.
			</p>
		</div>
   </body>
</html>