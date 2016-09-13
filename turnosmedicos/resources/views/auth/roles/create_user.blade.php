@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Nuevo Usuario Administrador</h1>
            </div>

            <div class="panel-body">                
                <!-- success messages -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                         {{ Session::get('flash_message') }}
                    </div>
                @endif
                <!-- -->
                {!! Form::open(['url' => 'users']) !!}

                @include('auth.roles.controles_user')

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ url('usersnroles') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
@endsection