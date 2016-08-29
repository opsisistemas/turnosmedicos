@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Nuevo Mensaje</h1>                       
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
                {!! Form::open(['url' => 'mensajes']) !!}

                <div class="form-group">
                    {!! Form::label('asunto', 'Asunto:', ['class' => 'control-label enfocar']) !!}
                    {!! Form::select('asunto', $asuntos, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('destinatario', 'Para:', ['class' => 'control-label']) !!}
                    {!! Form::select('medico_id', $medicos, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('cuerpo', 'Mensaje:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('cuerpo', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ url('/') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
@endsection