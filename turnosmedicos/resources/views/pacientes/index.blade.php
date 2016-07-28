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
         <!-- Current Paciente -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h1>
                        Pacientes
                        <div class="pull-right">
                            <!-- TRIGGER THE MODAL WITH A BUTTON -->
                            {!! Form::button('Nuevo Paciente <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success btn-create-paciente', 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#createModal']) !!}
                        </div> 
                    </h1>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['pacientes.index'],
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
                            <th>Localidad</th>
                            <th>Obra Social</th>
                            <th>Plan</th>
                            <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td class="table-text"><div>{{ $paciente->apellido }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->nombre }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->telefono }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->localidad->nombre }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->obra_social->nombre }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->plan->nombre }}</div></td>
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-success btn-edit-paciente', 'type' => 'submit', 'data-id' => $paciente->id,  'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}                                            
                                    </td>
                                    <!-- Task Delete Button -->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['pacientes.destroy', $paciente->id],
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
                        {!! $pacientes->render() !!}
                    </div>
                </div>                
            </div>
        </div>    
    </div>
    @include('pacientes.create')
    @include('pacientes.edit')
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/pacientes/edit.js') !!}
    {!! Html::script('js/pacientes/create.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
@endsection