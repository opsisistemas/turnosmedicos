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
                 <h4 class="modal-title">Editar Tipo de Pago</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['tipopago.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('idtipopago', null, ['class' => 'form-control', 'id' => 'tipopago_id']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('codigo', 'C&oacute;digo:', ['class' => 'control-label']) !!}
                    {!! Form::text('codigo', null, ['class' => 'form-control', 'id' => 'codigo_e']) !!}  
                </div>

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripci&oacute;n:', ['class' => 'control-label']) !!}
                    {!! Form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion_e']) !!}  
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('tipopago.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>