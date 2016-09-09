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
                 <h4 class="modal-title">Editar Inasistencia</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['diastachados.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('feriados', 0, ['class' => 'form-control', 'id' => 'feriados']) !!}
                </div>

                <div class="form-group">
                    {!! Form::hidden('origen', 'medicos.misdiastachados', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::hidden('medico_id', Auth::user()->medicoAsociado()->first()->id, ['class' => 'form-control', 'id' => 'medico_id']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fecha_lb', 'Fecha:', ['class' => 'control-label']) !!}
                    {!! Form::text('fecha_lb', null, ['class' => 'form-control', 'id' => 'fecha_lb', 'disabled' => 'disabled']) !!}
                    <div class="pull-right">
                        {!! Form::button('Cambiar <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success', 'id' =>  'btn-cambiar']) !!}
                    </div> 
                </div>

                <div class="hidden" id="calendar-picker_e">
                    {!! Form::label('datepicker-container', 'Seleccione fecha:', ['class' => 'control-label']) !!}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div id="datepicker-container">
                                <div id="datepicker-center_e"></div>
                            </div>
                            {!! Form::hidden('fecha', '', ['id' => 'fecha_dp_e']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('motivo', 'Motivo:', ['class' => 'control-label']) !!}
                    {!! Form::text('motivo', null, ['class' => 'form-control', 'id' => 'motivo_c']) !!}
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('localidades.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>