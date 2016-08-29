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
         <!-- Current asunto -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h1>
                        Asuntos
                        <div class="pull-right">
                            <!-- TRIGGER THE MODAL WITH A BUTTON -->
                            {!! Form::button('Nuevo asunto <i class="fa fa-bolt"></i>', ['class' => 'btn btn-success btn-create-asunto', 'type' => 'submit', 'data-toggle' => 'modal', 'data-target' => '#createModal']) !!}
                        </div> 
                    </h1>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => ['asuntos.index'],
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
                            <th>Descripci&oacute;n</th>
                            <!-- <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($asuntos as $asunto)
                                <tr>
                                    <td class="table-text"><div>{{ $asunto->nombre }}</div></td>
                                    <td>
                                        <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                        {!! Form::button('Edit <i class="fa fa-pencil"></i>', ['class' => 'btn btn-success btn-edit-asunto', 'type' => 'submit', 'data-id' => $asunto->id,  'data-toggle' => 'modal', 'data-target' => '#editModal']) !!}                                            
                                    </td>
                                    <!-- Task Delete Button -->
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['asuntos.destroy', $asunto->id],
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
                        {!! $asuntos->render() !!}
                    </div>
                </div>                
            </div>
        </div>    
    </div>
    @include('asuntos.create')
    @include('asuntos.edit')
@endsection

@section('scripts')
    {!! Html::script('js/funciones/focus.js') !!}
    {!! Html::script('js/asuntos/edit.js') !!}
    {!! Html::script('js/asuntos/create.js') !!}
@endsection