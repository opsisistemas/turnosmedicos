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
            <h1>Listado de Turnos de {{ ucwords(Auth::user()->name) . ' ' . ucwords(Auth::user()->surname) }}</h1>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <tr>
                        <th>D&iacute;a</th>
                        <th>Hora</th>
                        <th>Especiliadad</th>
                        <th>M&eacute;dico</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turnos as $turno)
                        <tr>
                            <td> {{ (new \Carbon\Carbon($turno->fecha))->format('d-m-Y') }} </td>
                            <td> {{ (new \Carbon\Carbon($turno->hora))->format('H:i') }} </td>
                            <td> {{ $turno->especialidad->descripcion }} </td>
                            <td> {{ $turno->medico->apellido . ' ' . $turno->medico->nombre }} </td>
                            <td>
                                <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                {!! Form::button('Anular Turno <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger btn-cancel-turno', 'type' => 'submit', 'data-id' => $turno->id,  'data-toggle' => 'modal', 'data-target' => '#cancelModal']) !!}   
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>                
    </div>
</div>

@include('turnos.modalcancel')

@endsection

@section('scripts')
    {!! Html::script('js/turnos/misturnos.js') !!}
@endsection