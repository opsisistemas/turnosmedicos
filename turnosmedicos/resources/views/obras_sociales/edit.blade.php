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
                 <h4 class="modal-title">Editar Obra Social</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['obras_sociales.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('idObra_social', null, ['class' => 'form-control', 'id' => 'obra_social_id']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre_e']) !!}  
                </div>

                <div class="form-group">
                    {!! Form::label('pagina_web', 'P&aacute;gina Web:', ['class' => 'control-label']) !!}
                    {!! Form::text('pagina_web', null, ['class' => 'form-control', 'id' => 'pagina_web_e']) !!}  
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email_e']) !!}  
                </div>

                <div class="form-group">
                    {!! Form::label('telefono', 'Tel&eacute;fono:', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', null, ['class' => 'form-control', 'id' => 'telefono_e']) !!}  
                </div>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('obras_sociales.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>