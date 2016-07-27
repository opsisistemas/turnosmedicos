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
         <!-- Current obra_social -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h1>
                        Obras Sociales
                        <div class="pull-right">
                            <!-- TRIGGER THE MODAL WITH A BUTTON -->
                            {!! Form::button('Nueva Obra Social <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success btn-create-obra_social', 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#createModal']) !!}
                        </div> 
                    </h1>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['obras_sociales.index'],
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
                            <th>P&aacute;gina Web</th>
                            <th>Email</th>
                            <th>Tel&eacute;fono</th>
                            <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($obras_sociales as $obra_social)
                                <tr>
                                    <td class="table-text"><div>{{ $obra_social->nombre }}</div></td>
                                    <td class="table-text"><div>{{ $obra_social->pagina_web }}</div></td>
                                    <td class="table-text"><div>{{ $obra_social->email }}</div></td>
                                    <td class="table-text"><div>{{ $obra_social->telefono }}</div></td>
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-success btn-edit-obra_social', 'type' => 'submit', 'data-id' => $obra_social->id,  'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}                                            
                                    </td>
                                    <!-- Task Delete Button -->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['obras_sociales.destroy', $obra_social->id],
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
                        {!! $obras_sociales->render() !!}
                    </div>
                </div>                
            </div>
        </div>    
    </div>
    @include('obras_sociales.create')
    @include('obras_sociales.edit')
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/obras_sociales/edit.js') !!}
    {!! Html::script('js/obras_sociales/create.js') !!}
@endsection