@extends('layouts.app')

@section('content')

<div class="container">        
    
    @include('partials.alerts.js_confirm')  
    <!-- success messages -->
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif 
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Listado de Turnos por M&eacute;dico</h1>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading"> 
                {!! Form::open([
                                'method' => 'GET',
                                'class' => 'navbar-form',
                                'role' => 'search',
                                'url' => ['turnos.listado']
                                 ]) !!}
                 <!--selección de fecha desde filtrar,hoy por defecto-->
                {!! Form::label('fecha', 'D&iacute;a:', ['class' => 'control-label']) !!}
                {!! Form::text('fecha', $fecha->format('d-m-Y'), ['class' => 'datepicker form-control', 'id' => 'fecha']) !!}

                 <!--selección de médico-->
                {!! Form::label('medico_id', 'M&eacute;dico:', ['class' => 'control-label']) !!}
                {!! Form::select('medico_id', $medicos, $medico_id, ['class' => 'form-control enfocar', 'id' => 'medico']) !!}

                {!! Form::submit('Buscar', ['class' => 'btn btn-default', 'id' => 'btn-search'])  !!}
                    <div class="pull-right">
                        {!! Form::button('<i class="fa fa-file-pdf-o"></i>', ['class' => 'btn btn-default', 'id' => 'btn-pdf']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
		</div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Tel&eacute;fono</th>
                    <th>Obra Social</th>
                    <th>Nro Afiliado</th>
                    <th>Especialidad</th>
                </thead>
                <tbody id="listado">
                    @foreach ($turnos as $turno)
                        <tr>
                            <td> {{ (new \Carbon\Carbon($turno->hora))->format('H:i') }}</td>
                            <td> {{ $turno->paciente->nombre }}</td>
                            <td> {{ $turno->paciente->telefono }}</td>
                            <td> {{ $turno->paciente->obra_social->nombre }}</td>
                            <td> {{ $turno->paciente->nro_afiliado }}</td>
                            <td> {{ $turno->especialidad->descripcion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
            </div>
        </div>                
    </div>
</div>

@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
    {!!Html::script('js/funciones/datepicker.js')!!}
    {!!Html::script('js/turnos/listado.js')!!}
@endsection