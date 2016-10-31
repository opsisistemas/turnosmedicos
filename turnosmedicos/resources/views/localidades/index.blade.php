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
         <!-- Current localidad -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h1>
                        Localidades
                        <div class="pull-right">
                            <!-- TRIGGER THE MODAL WITH A BUTTON -->
                            {!! Form::button('Nueva Localidad <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success btn-create-localidad', 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#createModal']) !!}
                        </div> 
                    </h1>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['localidades.index'],
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
                            <th>Nombre</th>
                            <th>Provincia</th>
                            <th>Pa&iacute;s</th>
                            <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($localidades as $localidad)
                                <tr>
                                    <td class="table-text"><div>{{ $localidad->nombre }}</div></td>
                                    <td class="table-text"><div>{{ $localidad->provincia->nombre }}</div></td>
                                    <td class="table-text"><div>{{ $localidad->provincia->pais->nombre }}</div></td>
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        {!! Form::button('Editar <i class="fa fa-pencil"></i>', ['class' => 'btn btn-success btn-edit-localidad', 'type' => 'submit', 'data-id' => $localidad->id,  'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}                                            
                                    </td>
                                    <!-- Task Delete Button -->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['localidades.destroy', $localidad->id],
                                            'onsubmit' => 'return ConfirmDelete()'                  
                                        ]) !!}

                                        {!! Form::button('Eliminar <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

                                        {!! Form::close() !!}                                           
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {!! $localidades->render() !!}
                    </div>
                </div>                
            </div>
        </div>    
    </div>
    @include('localidades.create')
    @include('localidades.edit')
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/localidades/edit.js') !!}
    {!! Html::script('js/localidades/create.js') !!}
@endsection