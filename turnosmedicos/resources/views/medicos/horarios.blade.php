<!--*****************************************************************************************-->
<!--*****************************************************************************************-->

<!-- MODAL -->
<div class="modal fade" id="horariosModal_c" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Horarios</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open(['url' => 'horarios']) !!}

                <div class="form-group">
                    {!! Form::hidden('idmedico', null, ['class' => 'form-control', 'id' => 'medico_id']) !!}
                </div>

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
                                        {!! Form::checkbox('dia', null, false) !!}
                                        {!! Form::label('dia', ucwords($dia->nombre), ['class' => 'control-label']) !!}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {!! Form::text('desde', '08:00', ['id' => 'desde', 'class' => 'desdeHasta']) !!}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {!! Form::text('hasta', '14:00', ['id' => 'hasta', 'class' => 'desdeHasta']) !!} 
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('medicos.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>