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
                 <h4 class="modal-title">Editar Localidad</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['localidades.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('idlocalidad', null, ['class' => 'form-control', 'id' => 'localidad_id']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('pais_id', 'Pa&iacute;s:', ['class' => 'control-label']) !!}
                    {!! Form::select('pais_id', $paises, null, ['class' => 'form-control', 'id' => 'pais_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('provincia_id', 'Provincias', ['class' => 'control-label']) !!}
                    {!! Form::select('provincia_id', $provincias, null, ['method' => 'GET', 'class' => 'form-control', 'id' => 'provincia_e']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre_e']) !!}  
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