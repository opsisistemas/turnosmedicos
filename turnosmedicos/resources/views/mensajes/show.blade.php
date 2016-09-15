<!--*****************************************************************************************-->
<!--*****************************************************************************************-->

<!-- MODAL -->
<div class="modal fade" id="showModal" role="dialog">
    <div class="modal-dialog">

    <!-- MODAL CONTENT-->
        <div class="modal-content">
            <!-- MODAL HEADER-->
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Mensaje</h4>
            </div>
            <!-- MODAL BODY-->
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'PATCH',
                    'id' => 'formEdit',
                    'route' => ['mensajes.update', 1]
                ]) !!}

                <div class="form-group">
                    {!! Form::label('asunto', 'Asunto:', ['class' => 'control-label enfocar']) !!}
                    {!! Form::select('asunto_id', $asuntos, null, ['class' => 'form-control', 'id' => 'asunto_id']) !!}
                </div>

                @if((null !== Auth::user())&&(Auth::user()->hasRole('admin')))
                    <div class="form-group">
                        {!! Form::label('destinatario', 'Para:', ['class' => 'control-label']) !!}
                        {!! Form::select('medico_id', $medicos, null, ['class' => 'form-control', 'id' => 'medico_id']) !!}
                    </div>
                @endif

                <div class="form-group">
                    {!! Form::label('cuerpo', 'Mensaje:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('cuerpo', null, ['class' => 'form-control', 'id' => 'cuerpo']) !!}
                </div>

                @if((null !== Auth::user())&&(Auth::user()->hasRole('admin')))
                    <div class="form-group">
                        {!! Form::label('visto', 'Visto:', ['class' => 'control-label']) !!}
                        {!! Form::checkbox('visto', null, false, ['class' => 'form-control', 'id' => 'visto_s']) !!}
                    </div>
                @endif

                {!! Form::submit('Aceptar', ['class' => 'btn btn-success'])  !!}

                <div class="pull-right">
                    <a href="{{ route('mensajes.index') }}" class="btn btn-danger"></i>Cancel</a>
                </div>

                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>