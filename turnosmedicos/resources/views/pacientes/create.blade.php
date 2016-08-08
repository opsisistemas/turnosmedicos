<!--*****************************************************************************************-->
<!--*****************************************************************************************-->

<!-- MODAL -->
<div class="modal fade" id="createModal" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Nuevo Paciente</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open(['url' => 'pacientes']) !!}

                <div class="form-group">
                    {!! Form::label('apellido', 'Apellido:', ['class' => 'control-label']) !!}
                    {!! Form::text('apellido', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'apellido_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nombre_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('tipoDocumento', 'Tipo Documento:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipoDocumento', ['1' => 'DNI', '2' => 'LE'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'tipoDocumento_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nroDocumento', 'Nro Documento:', ['class' => 'control-label']) !!}
                    {!! Form::text('nroDocumento', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nroDocumento_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sexo', 'Sexo:', ['class' => 'control-label']) !!}
                    {!! Form::select('sexo', ['F' => 'Femenino', 'M' => 'Masculino'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'sexo_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('telefono', 'Tel&eacute;fono:', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'telefono_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fechaNacimiento', 'Fecha de Nacimiento:', ['class' => 'control-label']) !!}
                    {!! Form::text('fechaNacimiento', \Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'form-control datepicker', 'id' => 'fechaNacimiento_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('pais_id', 'Pa&iacute;s:', ['class' => 'control-label']) !!}
                    {!! Form::select('pais_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'pais_c']) !!}
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
                    {!! Form::select('obra_social_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'obra_social_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('plan_id', 'Plan:', ['class' => 'control-label']) !!}
                    {!! Form::select('plan_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'plan_c']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nro_afiliado', 'Nro Afiliado:', ['class' => 'control-label']) !!}
                    {!! Form::text('nro_afiliado', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nro_afiliado_c']) !!}
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