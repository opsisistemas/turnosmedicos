<div class="form-group">
    {!! Form::hidden('sobre_turno', 0, ['class' => 'form-control', 'id' => 'sobreturno']) !!}
</div>

<div class="form-group">
    {!! Form::hidden('feriados', 0, ['class' => 'form-control', 'id' => 'feriados']) !!}
</div>

<div class="form-group">
    {!! Form::hidden('dias_tachados', 0, ['class' => 'form-control', 'id' => 'dias_tachados']) !!}
</div>

<div class="form-group">
    {!! Form::label('medico_id', 'M&eacute;dico:', ['class' => 'control-label']) !!}
    {!! Form::select('medico_id', $medicos, null, ['class' => 'form-control', 'id' => 'medico_id']) !!}
</div>

<div class="hidden" id="calendar-picker">
    {!! Form::label('datepicker-container', 'Seleccione fecha:', ['class' => 'control-label']) !!}
    <p class="comment">(Seleccionando una d&iacute;a del calendario, usted podr&aacute; ver los horarios del m&eacute;dico actual)</p>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div id="datepicker-container">
                <div id="datepicker-center"></div>
            </div>
            {!! Form::hidden('fecha', '', ['id' => 'fecha_dp']) !!}
        </div>
    </div>
</div>

<div class="form-group hidden" id="especialidad">
    {!! Form::label('especialidad_id', 'Especialidad:', ['class' => 'control-label']) !!}
    <p class="comment">(Usted puede seleccionar una de las especiliadades por las que &eacute;ste m&eacute;dico atiende)</p>
    {!! Form::select('especialidad_id', [], null, ['class' => 'form-control', 'id' => 'especialidad_id']) !!}
</div>

<div class="hidden" id="hour-picker">
    {!! Form::label('datepicker-container', 'Seleccione hora:', ['class' => 'control-label']) !!}
    <p class="comment">(Los horarios en rojo no est&aacute;n disponibles)</p>
    <div class="panel panel-default" >
        <div class="panel-heading hidden"></div>
        <div class="panel-body">
            <div id="datepicker-container">
                <div id="datepicker-center">
                    <div id="horarios"></div>
                </div>
            </div>
        </div>
    </div>
</div>