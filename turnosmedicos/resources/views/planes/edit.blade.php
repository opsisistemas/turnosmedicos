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
                 <h4 class="modal-title">Editar Plan</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['planes.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('idplan', null, ['class' => 'form-control', 'id' => 'plan_id']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre_e']) !!}  
                </div>

                <div class="form-group">
                    {!! Form::label('obra_social_id', 'Obra Social:', ['class' => 'control-label']) !!}
                    {!! Form::select('obra_social_id', $obras_sociales, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'obra_social_e']) !!}
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('planes.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>