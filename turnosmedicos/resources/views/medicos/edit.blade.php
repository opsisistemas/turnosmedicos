@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Editar M&eacute;dico</h1>                       
            </div>

            <div class="panel-body">
                {!! Form::model($medico, [
                    'method' => 'PATCH',
                    'route' => ['medicos.update', $medico->id]
                ]) !!}

                <div class="form-group">
                    {!! Form::label('apellido', 'Apellido:', ['class' => 'control-label']) !!}
                    {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('tipoDocumento', 'Tipo Documento:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipoDocumento', ['1' => 'DNI', '2' => 'LE'], null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nroDocumento', 'Nro Documento:', ['class' => 'control-label']) !!}
                    {!! Form::text('nroDocumento', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('categoria', 'Categor&iacute;a', ['class' => 'control-label']) !!}
                    {!! Form::select('categoria', $categorias, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('tipo_matricula', 'Tipo de Matr&iacute;cula:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipo_matricula', ['P' => 'Provincial', 'N' => 'Nacional'], null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nro_matricula', 'Nro. Matricula:', ['class' => 'control-label']) !!}
                    {!! Form::text('nro_matricula', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sexo', 'Sexo:', ['class' => 'control-label']) !!}
                    {!! Form::select('sexo', ['F' => 'Femenino', 'M' => 'Masculino'], null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('telefono', 'Tel&eacute;fono:', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fechaNacimiento', 'Fecha de Nacimiento:', ['class' => 'control-label']) !!}
                    {!! Form::text('fechaNacimiento', null, ['class' => 'form-control datepicker']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('duracionTurno', 'Duraci&oacute;n del Turno:', ['class' => 'control-label']) !!}
                    {!! Form::text('duracionTurno', null, ['class' => 'cantHoras form-control']) !!}                     
                </div>

                <div class="form-group">
                    <table class="table table-striped table-responsive task-table">
                        <thead>
                            <th>Especialidad</th>
                        </thead>
                        <tbody>
                           @foreach ($especialidades as $especialidad)                       
                                <tr>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::checkbox('especialidad[]', $especialidad->id, $medico->especialidades->find($especialidad->id)) !!}
                                            {!! Form::label('especialidad', ucwords($especialidad->descripcion), ['class' => 'control-label']) !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 

                <div class="form-group">
                    <table class="table table-striped table-responsive task-table">
                        <thead>
                            <th>D&iacute;a</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                        </thead>
                        <tbody>
                           @foreach ($dias as $dia)                       
                                <tr>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::checkbox(ucwords($dia->nombre), null, false) !!}
                                            {!! Form::label('dia', ucwords($dia->nombre), ['class' => 'control-label']) !!}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::text(ucwords($dia->nombre).'desde', '08:00', ['id' => 'desde', 'class' => 'desdeHasta']) !!}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::text( ucwords($dia->nombre).'hasta', '14:00', ['id' => 'hasta', 'class' => 'desdeHasta']) !!} 
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('medicos.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')    
    {!! Html::script('js/medicos/edit.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
    {!! Html::script('js/funciones/timepicker.js') !!}
@endsection