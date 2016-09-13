<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
    <table class="table table-striped table-responsive task-table">
        <thead>
            <th><h3>Rol/es</h3></th>
        </thead>
        <tbody>
           @foreach ($roles as $role)                       
                <tr>
                    <td class="table-text">
                        <div>
                            {!! Form::checkbox('role[]', $role->id, false) !!}
                            {!! Form::label('role', ucwords($role->display_name), ['class' => 'control-label']) !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($errors->has('role'))
        <span class="help-block">
            <strong>{{ $errors->first('role') }}</strong>
        </span>
    @endif
</div>