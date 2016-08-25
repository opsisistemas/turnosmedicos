@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Perfil de {{ ucwords(Auth::user()->name) . ' ' . ucwords(Auth::user()->surname) }}</h1>                       
            </div>

            <div class="panel-body">
                {!! Form::model($paciente, [
                    'method' => 'PATCH',
                    'route' => ['pacientes.update', $paciente->id]
                ]) !!}

                <div class="form-group">
                    {!! Form::label('apellido', 'Apellido:', ['class' => 'control-label']) !!}
                    {!! Form::text('apellido', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'apellido_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nombre_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('tipoDocumento', 'Tipo Documento:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipoDocumento', ['1' => 'DNI', '2' => 'LE'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'tipoDocumento_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nroDocumento', 'Nro Documento:', ['class' => 'control-label']) !!}
                    {!! Form::text('nroDocumento', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nroDocumento_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sexo', 'Sexo:', ['class' => 'control-label']) !!}
                    {!! Form::select('sexo', ['F' => 'Femenino', 'M' => 'Masculino'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'sexo_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('telefono', 'Tel&eacute;fono:', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'telefono_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fechaNacimiento', 'Fecha de Nacimiento:', ['class' => 'control-label']) !!}
                    {!! Form::text('fechaNacimiento', \Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'form-control datepicker', 'id' => 'fechaNacimiento_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('pais_id', 'Pa&iacute;s:', ['class' => 'control-label']) !!}
                    {!! Form::select('pais_id', $paises, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'pais_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('provincia_id', 'Provincia:', ['class' => 'control-label']) !!}
                    {!! Form::select('provincia_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'provincia_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('localidad_id', 'Localidad:', ['class' => 'control-label']) !!}
                    {!! Form::select('localidad_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'localidad_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('obra_social_id', 'Obra Social:', ['class' => 'control-label']) !!}
                    {!! Form::select('obra_social_id', $obras_sociales, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'obra_social_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('plan_id', 'Plan:', ['class' => 'control-label']) !!}
                    {!! Form::select('plan_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'plan_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nro_afiliado', 'Nro Afiliado:', ['class' => 'control-label']) !!}
                    {!! Form::text('nro_afiliado', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nro_afiliado_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'EMail:', ['class' => 'control-label']) !!}
                    {!! Form::text('email', $email, ['method' => 'GET', 'class' => 'form-control', 'id' => 'email_e']) !!}
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! Html::script('js/pacientes/edit_completo.js') !!}
@endsection