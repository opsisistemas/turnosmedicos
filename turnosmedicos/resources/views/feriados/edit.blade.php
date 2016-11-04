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
                 <h4 class="modal-title">Editar Feriado</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['feriados.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripci&oacute;n:', ['class' => 'control-label']) !!}
                    {!! Form::text('descripcion_id', null, ['class' => 'form-control', 'id' => 'descripcion_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fecha', 'Fecha: (usar formato -> dd-mm-aaaa)', ['class' => 'control-label']) !!}
                    {!! Form::text('fecha', null, ['class' => 'form-control datepicker', 'id' => 'fecha_e']) !!}
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('feriados.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>