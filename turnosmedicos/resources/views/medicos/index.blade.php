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
         <!-- Current médico -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h1>
                        M&eacute;dicos
                        <div class="pull-right">
                            <!-- TRIGGER THE MODAL WITH A BUTTON -->
                            {!! Form::button('Nuevo M&eacute;dico <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success btn-create-medico', 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#createModal']) !!}
                        </div> 
                    </h1>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['medicos.index'],
                            'class' => 'navbar-form',
                            'role' => 'search'                                
                        ]) !!}
                        {!! Form::text('name', '', ['class' => 'form-control enfocar', 'placeholder' => 'Nombre']) !!}                        
                        {!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Tel&eacute;fono</th>
                            <th>Email</th>
                            <th>Especialidad</th>
                            <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($medicos as $medico)
                                <tr>
                                    <td class="table-text"><div>{{ $medico->apellido }}</div></td>
                                    <td class="table-text"><div>{{ $medico->nombre }}</div></td>
                                    <td class="table-text"><div>{{ $medico->telefono }}</div></td>
                                    <td class="table-text"><div>{{ $medico->email }}</div></td>
                                    <td class="table-text"><div>{{ $medico->especialidad->descripcion }}</div></td>
                                    <td>
                                        
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        {!! Form::button('Horarios <i class="fa fa-clock-o"></i>', ['class' => 'btn btn-info btn-create-horario', 'type' => 'submit', 'data-id' => $medico->id,  'data-toggle' => 'modal', 'data-target' => '#horariosModal_c']) !!}
                                    </td>
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-success btn-edit-medico', 'type' => 'submit', 'data-id' => $medico->id,  'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}                                            
                                    </td>
                                    <!-- Task Delete Button -->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['medicos.destroy', $medico->id],
                                            'onsubmit' => 'return ConfirmDelete()'                  
                                        ]) !!}

                                        {!! Form::button('Delete <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

                                        {!! Form::close() !!}                                           
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {!! $medicos->render() !!}
                    </div>
                </div>                
            </div>
        </div>    
    </div>
    @include('medicos.create')
    @include('medicos.edit')
    @include('medicos.horarios')
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/medicos/edit.js') !!}
    {!! Html::script('js/medicos/create.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
    {!! Html::script('js/funciones/timepicker.js') !!}
@endsection