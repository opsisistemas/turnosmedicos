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
                            {!! Form::open([
                                'method' => 'GET',
                                'route' => ['pacientes.create'],
                                'class' => 'navbar-form navbar-left pull-left'                                                         
                            ]) !!}
                            {!! Form::submit('Nuevo Paciente', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!} 
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
                            <th>Celular</th>
                            <th>Localidad</th>
                            <th>Obra Social</th>
                            <th>Plan</th>
                            <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($pacientes as $paciente)
                                @if (!(($paciente->user()->first()->hasRole('admin')) || ($paciente->user()->first()->hasRole('owner'))))
                                <tr>
                                    <td class="table-text"><div>{{ $paciente->apellido }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->nombre }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->telefono }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->celular }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->localidad? $paciente->localidad->nombre : '' }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->obra_social? $paciente->obra_social->nombre : '' }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->plan? $paciente->plan->nombre : '' }}</div></td>
                                    @if ((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('owner')))
                                        <td>
                                            @if(! $paciente->confirmado)
                                                <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                                {!! Form::button('Confirmar <i class="fa fa-check"></i>', ['class' => 'btn btn-default btn-confirm-paciente', 'type' => 'submit', 'data-id' => $paciente->id,  'data-toggle' => 'modal', 'data-target' => '#confirmModal']) !!}
                                            @endif
                                        </td>
                                        <td>
                                            <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                            {!! Form::button('Editar <i class="fa fa-pencil"></i>', ['class' => 'btn btn-success btn-edit-paciente', 'type' => 'submit', 'data-id' => $paciente->id,  'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}                                            
                                        </td>
                                        <!-- Task Delete Button -->
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['pacientes.destroy', $paciente->id],
                                                'onsubmit' => 'return ConfirmDelete()'                  
                                            ]) !!}

                                            {!! Form::button('Eliminar <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

                                            {!! Form::close() !!}                                           
                                        </td>
                                    @else
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    @endif
                                </tr>
                                @endif
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
    @include('pacientes.edit')
    @include('pacientes.confirm')
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/pacientes/edit.js') !!}
    {!! Html::script('js/pacientes/confirm.js') !!}
    {!! Html::script('js/pacientes/create.js') !!}
    {!! Html::script('js/funciones/datepicker.js') !!}
@endsection