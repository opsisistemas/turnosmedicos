@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Perfil de la Empresa</h1>                       
            </div>

            <div class="panel-body">
                {!! Form::model($empresa, [
                    'method' => 'PATCH',
                    'route' => ['empresa.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('direccion', 'Direcci&oacute;n:', ['class' => 'control-label']) !!}
                    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'EMail:', ['class' => 'control-label']) !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('telefono1', 'Tel&eacute;fono 1:', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono1', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('telefono2', 'Tel&eacute;fono 2:', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono2', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
                    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Cuit', 'CUIT:', ['class' => 'control-label']) !!}
                    {!! Form::text('Cuit', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('inicio_actividades', 'Fecha de Inicio de Actividades:', ['class' => 'control-label']) !!}
                    {!! Form::text('inicio_actividades', null, ['class' => 'form-control datepicker']) !!}
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ url('/') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! Html::script('js/funciones/datepicker.js') !!}
    {!! Html::script('js/empresa/perfil.js') !!}
@endsection