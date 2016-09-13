@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Nuevo M&eacute;dico</h1>                       
            </div>

            <div class="panel-body">                
                <!-- success messages -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                         {{ Session::get('flash_message') }}
                    </div>
                @endif
                <!-- -->
                {!! Form::open(['url' => 'medicos']) !!}

                <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                    {!! Form::label('apellido', 'Apellido:', ['class' => 'control-label']) !!}
                    {!! Form::text('apellido', null, ['method' => 'GET', 'class' => 'form-control enfocar', 'id' => 'apellido_c']) !!}
                    @if ($errors->has('apellido'))
                        <span class="help-block">
                            <strong>{{ $errors->first('apellido') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nombre_c']) !!}
                    @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('tipoDocumento', 'Tipo Documento:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipoDocumento', ['1' => 'DNI', '2' => 'LE'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'tipoDocumento_c']) !!}
                </div>

                <div class="form-group{{ $errors->has('nroDocumento') ? ' has-error' : '' }}">
                    {!! Form::label('nroDocumento', 'Nro Documento:', ['class' => 'control-label']) !!}
                    {!! Form::text('nroDocumento', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nroDocumento_c']) !!}
                    @if ($errors->has('nroDocumento'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nroDocumento') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('categoria_id', 'Categor&iacute;a:', ['class' => 'control-label']) !!}
                    {!! Form::select('categoria_id', $categorias, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'categoria_id_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('tipo_matricula', 'Tipo de Matr&iacute;cula:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipo_matricula', ['P' => 'Provincial', 'N' => 'Nacional'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'tipo_matricula_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nro_matricula', 'Nro. Matricula:', ['class' => 'control-label']) !!}
                    {!! Form::text('nro_matricula', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nro_matricula_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sexo', 'Sexo:', ['class' => 'control-label']) !!}
                    {!! Form::select('sexo', ['F' => 'Femenino', 'M' => 'Masculino'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'sexo_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('telefono', 'Tel&eacute;fono:', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'telefono_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fechaNacimiento', 'Fecha de Nacimiento:', ['class' => 'control-label']) !!}
                    {!! Form::text('fechaNacimiento', \Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'form-control datepicker', 'id' => 'fechaNacimiento_c']) !!}
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                    {!! Form::text('email', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'email_c']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('duracionTurno') ? ' has-error' : '' }}">
                    {!! Form::label('duracionTurno', 'Duraci&oacute;n del Turno:', ['class' => 'control-label']) !!}
                    {!! Form::text('duracionTurno', '', ['id' => 'debe', 'class' => 'duracionTurno form-control', 'id' => 'duracionTurno_c']) !!}
                    @if ($errors->has('duracionTurno'))
                        <span class="help-block">
                            <strong>{{ $errors->first('duracionTurno') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}">
                    <table class="table table-striped table-responsive task-table">
                        <thead>
                            <th><h3>Especialidad</h3></th>
                        </thead>
                        <tbody>
                           @foreach ($especialidades as $especialidad)                       
                                <tr>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::checkbox('especialidad[]', $especialidad->id, false) !!}
                                            {!! Form::label('especialidad', ucwords($especialidad->descripcion), ['class' => 'control-label']) !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($errors->has('especialidad'))
                        <span class="help-block">
                            <strong>{{ $errors->first('especialidad') }}</strong>
                        </span>
                    @endif
                </div> 

                <div class="form-group">
                    <table class="table table-striped table-responsive task-table">
                        <thead>
                            <th><h3>Obras sociales por las que atiende</h3></th>
                        </thead>
                        <tbody>
                           @foreach ($obras_sociales as $obra_social)                       
                                <tr>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::checkbox('obras_sociales[]', $obra_social->id, false) !!}
                                            {!! Form::label('obras_sociales', ucwords($obra_social->nombre), ['class' => 'control-label']) !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 

                <div class="form-group{{ $errors->has('dia') ? ' has-error' : '' }}">
                    <h3>Horarios de Trabajo</h3>
                    <table class="table table-striped table-responsive task-table">
                        <thead>
                            <th>D&iacute;a</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                        </thead>
                        <tbody>
                           @foreach ($dias as $dia)                       
                                <tr>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::checkbox('dia[]', $dia->id, false) !!}
                                            {!! Form::label('dia', ucwords($dia->nombre), ['class' => 'control-label']) !!}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <span>
                                            {!! Form::text($dia->id.'desde', '08:00', ['class' => 'desdeHasta']) !!}
                                        </span>
                                    </td>
                                    <td class="table-text">
                                        <span>
                                            {!! Form::text($dia->id.'hasta', '14:00', ['class' => 'desdeHasta']) !!} 
                                        </span>
                                    </td>
                                    <td class="table-text">
                                        <span>
                                            {!! Form::text($dia->id.'desde1', '00:00', ['class' => 'desdeHasta']) !!}
                                        </span>
                                    </td>
                                    <td class="table-text">
                                        <span>
                                            {!! Form::text($dia->id.'hasta1', '00:00', ['class' => 'desdeHasta']) !!} 
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($errors->has('dia'))
                        <span class="help-block">
                            <strong>{{ $errors->first('dia') }}</strong>
                        </span>
                    @endif
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('medicos.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
    {!! Html::script('js/funciones/timepicker.js') !!}
@endsection