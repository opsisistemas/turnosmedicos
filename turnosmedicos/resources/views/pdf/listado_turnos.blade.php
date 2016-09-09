<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Listado de Turnos</title>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="jquery/3.1.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">        
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Listado de Turnos por M&eacute;dico</h1>
            <h5>M&eacute;dico: {{ ($medico_id != 0)? ($medico->apellido . ' ' . $medico->nombre) : 'Todos'}} </h5>
            <div class="pull-right">
                <h5> D&iacute;a: {{ (new \Carbon\Carbon($fecha))->format('d-m-Y') }} </h5>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Tel&eacute;fono</th>
                        <th>Obra Social</th>
                        <th>Nro Afiliado</th>
                        <th>Especialidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turnos as $turno)
                        <tr>
                            <td>{{ (new \Carbon\Carbon($turno->hora))->format('H:i') }}</td>
                            <td> {{ $turno->paciente->nombre }} </td>
                            <td> {{ $turno->paciente->telefono }} </td>
                            <td> {{ $turno->paciente->obra_social['nombre'] }} </td>
                            <td> {{ $turno->paciente->nro_afiliado }} </td>
                            <td> {{ $turno->especialidad->descripcion }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>                
    </div>
</div>
</body>
</html>