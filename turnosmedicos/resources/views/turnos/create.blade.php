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

                <div id='buttons' class="hidden">
                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                    {!! Form::button('Aceptar', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#modalconfirm', 'id' => 'btn-modalconfirm']) !!}

                    <div class="pull-right">
                        <a href="{{ url ('/') }}" class="btn btn-danger"></i>Cancel</a>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('turnos.modalconfirm')
                {!! Form::close() !!}
            </div>    
        </div>    
    </div>
@endsection

@section('scripts')
    {!!Html::script('js/turnos/create.js')!!}
    {!!Html::script('js/funciones/toTitleCase.js')!!}
    <link rel="stylesheet" href="{{ asset('css/aditionals.css') }}">
@endsection