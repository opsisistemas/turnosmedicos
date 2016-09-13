{!! csrf_field() !!}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="control-label">Nombre</label>
    <input type="text" class="form-control enfocar" name="name" value="{{ old('name') }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
</div>

<div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
    <label class="control-label">Apellido</label>
    <input type="text" class="form-control" name="surname" value="{{ old('surname') }}">

        @if ($errors->has('surname'))
            <span class="help-block">
                <strong>{{ $errors->first('surname') }}</strong>
            </span>
        @endif
</div>

<div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
    <label class="control-label">DNI</label>
    <input type="text" class="form-control" name="dni" value="{{ old('dni') }}">

        @if ($errors->has('dni'))
            <span class="help-block">
                <strong>{{ $errors->first('dni') }}</strong>
            </span>
        @endif
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="control-label">E-Mail</label>
    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
</div>