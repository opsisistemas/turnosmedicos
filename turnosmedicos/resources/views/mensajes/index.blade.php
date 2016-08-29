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
         <!-- Current mensaje -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h1>Mensajes</h1>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['mensajes.index'],
                            'class' => 'navbar-form',
                            'role' => 'search'                                
                        ]) !!}

                        {!! Form::label('vistos', 'Vistos / No Vistos', ['class' => 'control-label']) !!}
                        {!! Form::select('vistos', ['0' => 'No Vistos', '1' => 'Vistos'], $vistos, ['class' => 'form-control']) !!}

                        {!! Form::label('desde', 'Desde:', ['class' => 'control-label']) !!}
                        {!! Form::text('desde', $desde->format('d-m-Y'), ['class' => 'form-control datepicker']) !!}

                        {!! Form::label('hasta', 'hasta:', ['class' => 'control-label']) !!}
                        {!! Form::text('hasta', $hasta->format('d-m-Y'), ['class' => 'form-control datepicker']) !!}

                        {!! Form::label('medico_id', 'Para:', ['class' => 'control-label']) !!}
                        {!! Form::select('medico_id', $medicos_list, $medico_id, ['class' => 'form-control']) !!}

                        {!! Form::label('paciente_id', 'Paciente:', ['class' => 'control-label']) !!}
                        {!! Form::select('paciente_id', $pacientes_list, $paciente_id, ['class' => 'form-control']) !!}

                        {!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Fecha</th>
                            <th>De</th>
                            <th>Para</th>
                            <th>Asunto</th>
                            <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($mensajes as $mensaje)
                                <tr>
                                    <td><div>{{ (new \Carbon\Carbon($mensaje->created_at))->diffForHumans() }}</div></td>
                                    <td><div>{{ $mensaje->paciente->nombre . ', ' . $mensaje->paciente->apellido}}</div></td>
                                    <td><div>{{ $mensaje->medico->nombre . ', ' . $mensaje->medico->apellido}}</div></td>
                                    <td>{{ $mensaje->asunto->nombre }}</td>
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        {!! Form::button('Ver <i class="fa fa-eye"></i>', ['class' => 'btn btn-success btn-show-mensaje', 'type' => 'submit', 'data-id' => $mensaje->id,  'data-toggle' => 'modal', 'data-target' => '#showModal']) !!}                                            
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>                
            </div>
        </div>    
    </div>
    @include('mensajes.show')
@endsection

@section('scripts')
    {!! Html::script('js/mensajes/show.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
@endsection