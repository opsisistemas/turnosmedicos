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
            <div class="form-group">
                {!! Form::hidden('dias_tachados', 0, ['class' => 'form-control', 'id' => 'dias_tachados']) !!}
                {!! Form::hidden('feriados', 0, ['class' => 'form-control', 'id' => 'feriados']) !!}
            </div>
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
                            <!-- Task Delete Button -->
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['diastachados.destroy', $diatachado->id],
                                    'onsubmit' => 'return ConfirmDelete()'                  
                                ]) !!}

                                {!! Form::button('Eliminar <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

                                {!! Form::close() !!}                                           
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>                
    </div>
</div>
@include('medicos.diatachado-create')
@endsection

@section('scripts')
    {!!Html::script('js/funciones/datepicker.js')!!}
    {!!Html::script('js/medicos/diastachados.js')!!}
    <link rel="stylesheet" href="{{ asset('css/aditionals.css') }}">
@endsection