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
            <h1>
                Inasistencias informadas de {!! Auth::user()->medicoAsociado()->first()->nombre . ' ' .  Auth::user()->medicoAsociado()->first()->apellido !!}
                <div class="pull-right">
                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                    {!! Form::button('Informar Inasistencia <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success btn-create-dia_tachado', 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#createModal']) !!}
                </div> 
            </h1>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Motivo</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dias_tachados as $diatachado)
                        <tr>
                            <td>
                                {{
                                    (new \Carbon\Carbon($diatachado->fecha))->formatLocalized('%A %d %B') . ' (' .
                                    (new \Carbon\Carbon($diatachado->fecha))->diffForHumans() . ')'
                                }}
                            </td>
                            <td> {{ $diatachado->motivo }}</td>
                            <td>
                                <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                {!! Form::button('Editar <i class="fa fa-pencil"></i>', ['class' => 'btn btn-info btn-edit-dia-tachado', 'type' => 'submit', 'data-id' => $diatachado->id,  'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}                                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>                
    </div>
</div>
@include('medicos.diatachado-create')
@include('medicos.diatachado-edit')
@endsection

@section('scripts')
    {!!Html::script('js/funciones/datepicker.js')!!}
    {!!Html::script('js/medicos/diastachados.js')!!}
    <link rel="stylesheet" href="{{ asset('css/aditionals.css') }}">
@endsection