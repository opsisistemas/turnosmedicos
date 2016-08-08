<!--*****************************************************************************************-->
<!--*****************************************************************************************-->

<!-- MODAL -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Editar M&eacute;dico</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['medicos.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('idmedico', null, ['class' => 'form-control', 'id' => 'medico_id']) !!}
                </div>

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
                    {!! Form::label('categoria_id', 'Categor&iacute;a:', ['class' => 'control-label']) !!}
                    {!! Form::select('categoria_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'categoria_id_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('tipo_matricula', 'Tipo de Matr&iacute;cula:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipo_matricula', ['P' => 'Provincial', 'N' => 'Nacional'], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'tipo_matricula_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nro_matricula', 'Nro. Matricula:', ['class' => 'control-label']) !!}
                    {!! Form::text('nro_matricula', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'nro_matricula_e']) !!}
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
                    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                    {!! Form::text('email', null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'email_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('especialidad_id', 'Especialidad:', ['class' => 'control-label']) !!}
                    {!! Form::select('especialidad_id', [], null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'especialidad_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('duracionTurno', 'Duraci&oacute;n del Turno:', ['class' => 'control-label']) !!}
                    {!! Form::text('duracionTurno', '', ['id' => 'debe', 'class' => 'cantHoras form-control', 'id' => 'duracionTurno_e']) !!}                     
                </div>

                <div class="form-group">
                <table class="table table-striped table-responsive task-table">
                <thead>
                        <th>D&iacute;a</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                    </thead>
                    <tbody>
                       @foreach ($dias as $dia)                       
                            <tr>
                                <td class="table-text">
                                    <div>
                                        {!! Form::checkbox(ucwords($dia->nombre), null, false) !!}
                                        {!! Form::label('dia', ucwords($dia->nombre), ['class' => 'control-label']) !!}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {!! Form::text(ucwords($dia->nombre).'desde', '08:00', ['id' => 'desde', 'class' => 'desdeHasta']) !!}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {!! Form::text( ucwords($dia->nombre).'hasta', '14:00', ['id' => 'hasta', 'class' => 'desdeHasta']) !!} 
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div> 

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('medicos.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>