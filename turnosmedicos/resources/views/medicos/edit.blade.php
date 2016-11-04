@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Perfil de M&eacute;dico: {!! $medico->nombre . ' ' . $medico->apellido!!}</h1>
            </div>

            <div class="panel-body">
                {!! Form::model($medico, [
                    'method' => 'PATCH',
                    'route' => ['medicos.update', $medico->id]
                ]) !!}

                <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                    {!! Form::label('apellido', 'Apellido:', ['class' => 'control-label']) !!}
                    {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('apellido'))
                        <span class="help-block">
                            <strong>{{ $errors->first('apellido') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('tipoDocumento', 'Tipo Documento:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipoDocumento', ['1' => 'DNI', '2' => 'LE'], null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group{{ $errors->has('nroDocumento') ? ' has-error' : '' }}">
                    {!! Form::label('nroDocumento', 'Nro Documento:', ['class' => 'control-label']) !!}
                    {!! Form::text('nroDocumento', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('nroDocumento'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nroDocumento') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('categoria', 'Categor&iacute;a', ['class' => 'control-label']) !!}
                    {!! Form::select('categoria_id', $categorias, $medico->categoria_id, ['class' => 'form-control categoria']) !!}
                </div>

                <div id="importe" class="{{ ($medico->categoria_id == 4) ? '' : 'hidden ' }}form-group">
                    {!! Form::label('importe', 'Importe:', ['class' => 'control-label']) !!}
                    {!! Form::text('importe', 0.00, ['method' => 'GET', 'class' => 'form-control', 'id' => 'importe_c']) !!}
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
                    {!! Form::text('telefono', null, ['class' => 'form-control', 'id' => 'telefono_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('celular', 'Celular:', ['class' => 'control-label']) !!}
                    {!! Form::text('celular', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'celular_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fechaNacimiento', 'Fecha de Nacimiento: (usar formato -> dd-mm-aaaa)', ['class' => 'control-label']) !!}
                    {!! Form::text('fechaNacimiento', null, ['class' => 'form-control datepicker']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group{{ $errors->has('duracionTurno') ? ' has-error' : '' }}">
                    {!! Form::label('duracionTurno', 'Duraci&oacute;n del Turno:', ['class' => 'control-label']) !!}
                    {!! Form::text('duracionTurno', null, ['class' => 'cantHoras form-control']) !!}                     
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
                                            {!! Form::checkbox('especialidad[]', $especialidad->id, $medico->especialidades->find($especialidad->id)) !!}
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
                                            {!! Form::checkbox('obras_sociales[]', $obra_social->id, $medico->obras_sociales->find($obra_social->id)) !!}
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
                                            {!! Form::checkbox('dia[]', $dia->id, $medico->dias->find($dia->id)) !!}
                                            {!! Form::label('dia', ucwords($dia->nombre), ['class' => 'control-label']) !!}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <span>
                                            {!! Form::text($dia->id.'desde', ($medico->dias->find($dia->id))? (new \Carbon\Carbon($medico->dias->where('id', $dia->id)->first()->pivot->desde))->format('H:i'):'00:00', ['class' => 'desdeHasta']) !!}
                                        </span>
                                    </td>
                                    <td class="table-text">
                                        <span>
                                            {!! Form::text( $dia->id.'hasta', ($medico->dias->find($dia->id))? (new \Carbon\Carbon($medico->dias->where('id', $dia->id)->first()->pivot->hasta))->format('H:i'):'00:00', ['class' => 'desdeHasta']) !!} 
                                        </span>
                                    </td>
                                    <td class="table-text">
                                        <span>
                                            {!! Form::text($dia->id.'desde1', ($medico->dias->find($dia->id))? (new \Carbon\Carbon($medico->dias->where('id', $dia->id)->last()->pivot->desde))->format('H:i'):'00:00', ['class' => 'desdeHasta']) !!}
                                        </span>
                                    </td>
                                    <td class="table-text">
                                        <span>
                                            {!! Form::text( $dia->id.'hasta1', ($medico->dias->find($dia->id))? (new \Carbon\Carbon($medico->dias->where('id', $dia->id)->last()->pivot->hasta))->format('H:i'):'00:00', ['class' => 'desdeHasta']) !!} 
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
</div>
@endsection

@section('scripts')    
    {!! Html::script('js/medicos/edit.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
    {!! Html::script('js/funciones/timepicker.js') !!}
    {!! Html::script('js/medicos/importe.js') !!}   
@endsection