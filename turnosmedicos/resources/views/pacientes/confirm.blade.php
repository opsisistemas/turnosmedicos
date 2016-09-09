<!--*****************************************************************************************-->
<!--*****************************************************************************************-->

<!-- MODAL -->
<div class="modal fade" id="confirmModal" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Confirmar Paciente</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formConfirm',
                    'url' => ['pacientes.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::hidden('idpaciente', null, ['class' => 'form-control paciente_id']) !!}
                    {!! Form::hidden('confirmado', true, ['class' => 'form-control']) !!}
                </div>

                <div>
                    <h4>¿Confirma al paciente <strong id="paciente_a_confirmar"></strong>?</h4>
                </div>

                <p>
                    &Eacute;sto har&aacute; que el paciente puede sacar turno normalmente. Las operaciones que el paciente haga a partir de ahora, se verán normalmente en los listados.
                </p><br>

                <button type="submit" class="btn btn-success" name="aceptar" value="confirmar">Aceptar</button>
                <div class="pull-right">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>