@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Nuevo Turno</h1>                       
            </div>

            <div class="panel-body">                
                @include('partials.alerts.errors')
                <!-- success messages -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                         {{ Session::get('flash_message') }}
                    </div>
                @endif
                <!-- -->
                {!! Form::open(['url' => 'turnos']) !!}

                @if ((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('owner')))
                    <div class="form-group">
                        {!! Form::select('paciente_id', $pacientes, null, ['class' => 'form-control', 'id' => 'paciente_id']) !!}
                    </div>
                @endif

                @include('turnos.controles_create_por_medico')

                <div id='buttons' class="hidden">
                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                    {!! Form::button('Aceptar', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#modalconfirm', 'id' => 'btn-modalconfirm']) !!}

                    <div class="pull-right">
                        <a href="{{ url ('/') }}" class="btn btn-danger"></i>Cancel</a>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('turnos.modalconfirm')
                {!! Form::close() !!}
            </div>    
        </div>    
    </div>
@endsection

@section('scripts')
    {!!Html::script('js/turnos/create.js')!!}
    {!!Html::script('js/funciones/toTitleCase.js')!!}
    <link rel="stylesheet" href="{{ asset('css/aditionals.css') }}">
@endsection