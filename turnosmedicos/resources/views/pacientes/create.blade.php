@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Nuevo Paciente</h1>                       
            </div>

            <div class="panel-body">                
                <!-- success messages -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                         {{ Session::get('flash_message') }}
                    </div>
                @endif
                <!-- -->
                {!! Form::open(['url' => 'pacientes']) !!}

                <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                    {!! Form::label('apellido', 'Apellido:', ['class' => 'control-label enfocar']) !!}
                    {!! Form::text('apellido', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'apellido_c']) !!}
                    @if ($errors->has('apellido'))
                        <span class="help-block">
                            <strong>{{ $errors->first('apellido') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nombre_c']) !!}
                    @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('tipoDocumento', 'Tipo Documento:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipoDocumento', ['1' => 'DNI', '2' => 'LE'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'tipoDocumento_c']) !!}
                </div>

                <div class="form-group{{ $errors->has('nroDocumento') ? ' has-error' : '' }}">
                    {!! Form::label('nroDocumento', 'Nro Documento:', ['class' => 'control-label']) !!}
                    {!! Form::text('nroDocumento', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nroDocumento_c']) !!}
                    @if ($errors->has('nroDocumento'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nroDocumento') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('sexo', 'Sexo:', ['class' => 'control-label']) !!}
                    {!! Form::select('sexo', ['F' => 'Femenino', 'M' => 'Masculino'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'sexo_c']) !!}
                </div>

                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                    {!! Form::label('telefono', 'Tel&eacute;fono:', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'telefono_c']) !!}
                    @if ($errors->has('telefono'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('celular', 'Celular:', ['class' => 'control-label']) !!}
                    {!! Form::text('celular', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'celular_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'E-Mail', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['method' => 'GET', 'class' => 'form-control']) !!}

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Clave de Usuario:', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('fechaNacimiento', 'Fecha de Nacimiento: (usar formato -> dd-mm-aaaa)', ['class' => 'control-label']) !!}
                    {!! Form::text('fechaNacimiento', \Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'form-control datepicker', 'id' => 'fechaNacimiento_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('pais_id', 'Pa&iacute;s:', ['class' => 'control-label']) !!}
                    {!! Form::select('pais_id', $paises, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'pais_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('provincia_id', 'Provincia:', ['class' => 'control-label']) !!}
                    {!! Form::select('provincia_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'provincia_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('localidad_id', 'Localidad:', ['class' => 'control-label']) !!}
                    {!! Form::select('localidad_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'localidad_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('obra_social_id', 'Obra Social:', ['class' => 'control-label']) !!}
                    {!! Form::select('obra_social_id', $obras_sociales, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'obra_social_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('plan_id', 'Plan:', ['class' => 'control-label']) !!}
                    {!! Form::select('plan_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'plan_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nro_afiliado', 'Nro Afiliado:', ['class' => 'control-label']) !!}
                    {!! Form::text('nro_afiliado', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nro_afiliado_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('tipo_pago_id', 'Tipo de Pago:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipo_pago_id', $tipospago, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'tipo_pago_id_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('factura', 'Factura (Si - No):', ['class' => 'control-label']) !!}
                    {!! Form::checkbox('factura', null, false, ['method' => 'GET', 'class' => 'form-control', 'id' => 'factura_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('observaciones', 'Observaciones:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('observaciones', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'observaciones_c']) !!}
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
    {!! Html::script('js/pacientes/create.js') !!}
@endsection