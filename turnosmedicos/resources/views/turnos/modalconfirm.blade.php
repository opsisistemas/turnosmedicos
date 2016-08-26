<!--*****************************************************************************************-->
<!--*****************************************************************************************-->

<!-- MODAL -->
<div class="modal fade" id="modalconfirm" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Verificaci&oacute;n de Datos del Turno</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                <table class="table table-hover table-responsive">
                    <thead>
                        <!-- <th>&nbsp;</th>-->
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                            <tr>
                                <td class="table-text"><h3>M&eacute;dico: </h3></td>
                                <td class="table-text"><h3 class="strong-and-italic" id="medico"></h3></td>
                            </tr>
                            <tr>
                                <td class="table-text"><h3>D&iacute;a: </h3></td>
                                <td class="table-text"><h3 class="strong-and-italic" id="dia"></h3></td>
                            </tr>
                            <tr>
                                <td class="table-text"><h3>Hora: </h3></td>
                                <td class="table-text"><h3 class="strong-and-italic" id="hora"></h3></td>
                            </tr>
                    </tbody>
                </table>

                {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}
                <div class="pull-right">
                    <a href="{{ route('localidades.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>