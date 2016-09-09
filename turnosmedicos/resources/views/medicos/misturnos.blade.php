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
            <h1>Listado de Turnos de {!! Auth::user()->medicoAsociado()->first()->nombre . ' ' .  Auth::user()->medicoAsociado()->first()->apellido !!}</h1>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading"> 
                {!! Form::open([
                                'method' => 'GET',
                                'class' => 'navbar-form',
                                'role' => 'search',
                                'url' => ['medicos.misturnos']
                                 ]) !!}
                 <!--selección de fecha desde filtrar,hoy por defecto-->
                {!! Form::label('fecha', 'D&iacute;a:', ['class' => 'control-label']) !!}
                {!! Form::text('fecha', $fecha->format('d-m-Y'), ['class' => 'datepicker form-control enfocar']) !!}

                <button type="submit" class="btn btn-default" name="aceptar" value="buscar"><i class="fa fa-search"></i></button>

                    <div class="pull-right">
                        <button type="submit" class="btn btn-default" name="aceptar" value="pdf"><i class="fa fa-file-pdf-o"></i></button>
                    </div>
                {!! Form::close() !!}
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
                            <td>
                                {{ (new \Carbon\Carbon($turno->hora))->format('H:i')}}
                                <span>
                                    @if($turno->sobre_turno)
                                        <strong>(S)</strong>
                                    @endif
                                </span>
                            </td>
                            <td> {{ ucwords($turno->paciente->apellido) . ', ' .  ucwords($turno->paciente->nombre) }}</td>
                            <td> {{ $turno->paciente->telefono }}</td>
                            <td> {{ $turno->paciente->obra_social['nombre'] }}</td>
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
@endsection