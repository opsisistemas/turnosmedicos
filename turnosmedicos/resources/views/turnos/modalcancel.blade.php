<!--*****************************************************************************************-->
<!--*****************************************************************************************-->

<!-- MODAL -->
<div class="modal fade" id="cancelModal" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Anular turno</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'POST',
                    'id' => 'formCancel',
                    'url' => ['turnos.cancel', 1]
                ]) !!}

                <h4>Confirma que desea anular el turno seleccionado?</h4>

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ url('turnos.misturnos') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>