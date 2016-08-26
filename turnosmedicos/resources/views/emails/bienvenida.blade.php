<!DOCTYPE html>
<html lang="es">
   <head>
		<meta charset="utf-8">
   </head>
   <body>
		<h1>{!! $empresa->nombre !!}</h1>
		<div>
			<h4> Estimado {!! $user->nombre !!} </h4>
			<p>
				Hemos recibido una solicitud de registro de usuario en nuestro sistema online, con &eacute;sta direcci&oacute;n de correo electr&oacute;nico como referencia.
			</p>
			<p>
				En breve estaremos confirmando a usted el alta como usuario de nuestro sistema. Enviaremos un correo electr&oacute;nico a &eacute;sta direcci&oacute;n en cuanto se valide la informaci&oacute;n.
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