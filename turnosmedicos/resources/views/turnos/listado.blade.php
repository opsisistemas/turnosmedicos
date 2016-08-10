@extends('layouts.app')

@section('content')

<div class="container">        
    
    @include('partials.alerts.js_confirm')  
    <!-- success messages -->
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif 
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Listado de Turnos por M&eacute;dico</h1>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading"> 
                {!! Form::open([
                                'class' => 'navbar-form',
                                'role' => 'search',
                                'onsubmit' => 'return false'
                                 ]) !!}
                 <!--selección de fecha desde filtrar,hoy por defecto-->
                {!! Form::label('dia', 'D&iacute;a:', ['class' => 'control-label']) !!}
                {!! Form::text('dia', Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'datepicker form-control', 'id' => 'dia']) !!}

                 <!--selección de especialidad-->
                {!! Form::label('especialidad', 'Especialidad:', ['class' => 'control-label']) !!}
                {!! Form::select('especialidad', ['0' => '--Selccionar--'], null, ['class' => 'form-control enfocar', 'id' => 'especialidad']) !!}

                 <!--selección de médico-->
                {!! Form::label('medico', 'M&eacute;dico:', ['class' => 'control-label']) !!}
                {!! Form::select('medico', ['0' => '--Selccionar--'], null, ['class' => 'form-control enfocar', 'id' => 'medico']) !!}

                {!! Form::submit('Buscar', ['class' => 'btn btn-default', 'id' => 'btn-search'])  !!}
                    <div class="pull-right">
                        {!! Form::button('<i class="fa fa-file-pdf-o"></i>', ['class' => 'btn btn-default', 'id' => 'btn-pdf']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
		</div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Tel&eacute;fono</th>
                    <th>Obra Social</th>
                    <th>Nro Afiliado</th>
                </thead>
                <tbody id="listado">
                </tbody>
            </table>
            <div>
            </div>
        </div>                
    </div>
</div>

@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
    {!!Html::script('js/funciones/datepicker.js')!!}
    {!!Html::script('js/turnos/listado.js')!!}
@endsection