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
                 <h4 class="modal-title">Nueva Inasistencia Informada</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open(['url' => 'diastachados']) !!}

                <div class="form-group">
                    {!! Form::text('origen', 'medicos.misdiastachados', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::hidden('medico_id', Auth::user()->medicoAsociado()->first()->id, ['class' => 'form-control', 'id' => 'medico_id']) !!}
                </div>

                <div class="hidden" id="calendar-picker">
                    {!! Form::label('datepicker-container', 'Seleccione fecha:', ['class' => 'control-label']) !!}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div id="datepicker-container">
                                <div id="datepicker-center"></div>
                            </div>
                            {!! Form::hidden('fecha', '', ['id' => 'fecha_dp']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('motivo', 'Motivo:', ['class' => 'control-label']) !!}
                    {!! Form::text('motivo', null, ['class' => 'form-control', 'id' => 'motivo_c']) !!}
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ url('medicos.misdiastachados') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>