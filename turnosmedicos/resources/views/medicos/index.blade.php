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
                            {!! Form::open([
                                'method' => 'GET',
                                'route' => ['medicos.create'],
                                'class' => 'navbar-form navbar-left pull-left'                                                         
                            ]) !!}
                            {!! Form::submit('Nuevo M&eacute;dico', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!} 
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
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        {!! Form::button('Horarios <i class="fa fa-clock-o"></i>', ['class' => 'btn btn-info btn-show-horario', 'type' => 'submit', 'data-id' => $medico->id,  'data-toggle' => 'modal', 'data-target' => '#horariosModal   ']) !!}
                                    </td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'GET',
                                            'route' => ['medicos.edit', $medico->id]                                
                                        ]) !!}
                                        {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}                                         
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
    @include('medicos.horarios')
@endsection

@section('scripts')
    {!! Html::script('js/medicos/horarios.js') !!}
@endsection