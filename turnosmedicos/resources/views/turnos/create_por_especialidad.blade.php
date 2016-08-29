@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Nuevo Turno</h1>                       
            </div>

            <div class="panel-body">                
                @include('partials.alerts.errors')
                <!-- success messages -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                         {{ Session::get('flash_message') }}
                    </div>
                @endif
                <!-- -->
                {!! Form::open(['url' => 'turnos']) !!}

                <div class="form-group">
                    {!! Form::label('especialidad_id', 'Especialidad:', ['class' => 'control-label']) !!}
                    {!! Form::select('especialidad_id', $especialidades, null, ['class' => 'form-control', 'id' => 'especialidad_id']) !!}
                </div>

                <div class="hidden" id="calendar-picker">
                    {!! Form::label('datepicker-container', 'Seleccione fecha:', ['class' => 'control-label']) !!}
                    <p class="comment">(Seleccionando una d&iacute;a del calendario, usted podr&aacute; ver los d&iacute;as de atenci&oacute;n correspondientes a la especialidad seleccionada)</p>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div id="datepicker-container">
                                <div id="datepicker-center"></div>
                            </div>
                            {!! Form::hidden('fecha', '', ['id' => 'fecha_dp']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group hidden" id="medicos">
                    {!! Form::label('medico_id', 'M&eacute;dico:', ['class' => 'control-label']) !!}
                    <p class="comment">(Uste puede seleccionar un m&eacute;dico de &eacute;sta lista conforme a la especialidad y el d&iacute;a seleccionados)</p>
                    {!! Form::select('medico_id', [-1 => '--Selecccionar--'], null, ['class' => 'form-control', 'id' => 'medico_id']) !!}
                </div>

                <div class="hidden" id="hour-picker">
                    {!! Form::label('datepicker-container', 'Seleccione hora:', ['class' => 'control-label']) !!}
                    <p class="comment">(Los horarios en rojo no est&aacute;n disponibles)</p>
                    <div class="panel panel-default">
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

                <div id='buttons' class="hidden">
                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                    {!! Form::button('Aceptar', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#modalconfirm', 'id' => 'btn-modalconfirm']) !!}

                    <div class="pull-right">
                        <a href="{{ url ('/') }}" class="btn btn-danger"></i>Cancel</a>
                    </div>
                </div>
                @include('turnos.modalconfirm_esp')

                {!! Form::close() !!}
            </div>    
        </div>    
    </div>    
@endsection

@section('scripts')
    {!!Html::script('js/funciones/toTitleCase.js')!!}
    {!!Html::script('js/turnos/create_por_especialidad.js')!!}
    <link rel="stylesheet" href="{{ asset('css/aditionals.css') }}">
@endsection