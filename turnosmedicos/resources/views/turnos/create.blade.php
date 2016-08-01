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

                <div class="form-group">
                    {!! Form::label('especialidad_id', 'Especialidad:', ['class' => 'control-label']) !!}
                    {!! Form::select('especialidad_id', ['0' => '--Seleccionar--'], null, ['class' => 'form-control enfocar', 'id' => 'especialidad_id']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('medico_id', 'M&eacute;dico:', ['class' => 'control-label']) !!}
                    {!! Form::select('medico_id', ['0' => '--Seleccionar--'], null, ['class' => 'form-control', 'id' => 'medico_id']) !!}
                </div>

                <div class="form-group" id="dias">
                </div>

                <div id='buttons'>
                    {!! Form::submit('Accept', ['class' => 'btn btn-success', 'id' => 'btn-submit']) !!}

                    <div class="pull-right">
                        <a href="{{ route('turnos.index') }}" class="btn btn-danger"></i>Cancel</a>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>    
        </div>    
    </div>    
@endsection

@section('scripts')
    {!!Html::script('js/turnos/create.js')!!}
    {!!Html::script('js/funciones/datepicker.js')!!}
@endsection