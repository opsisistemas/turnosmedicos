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
     <!-- Current Clients -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Mis Mensajes</h1>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    {!! Form::open([
                        'method' => 'GET',
                        'url' => ['medicos.mismensajes'],
                        'class' => 'navbar-form',                                                                        
                    ]) !!}
                    {!! Form::label('Estado', 'Visto:', ['class' => 'control-label']) !!}                                    
                    {!! Form::select('visto', [
                        '1' => 'Visto',
                        '2' => 'No Vistos',
                        '3' => 'Todos'], $visto, ['class' => 'form-control']
                    ) !!}
                    {!! Form::submit('Filtrar', ['class' => 'btn btn-default', 'id' => 'filtrar']) !!}
                    {!! Form::close() !!} 
                </div>
            </div>
            <div class="panel-body">                       
                <table class="table table-striped task-table">
                    <thead>
                        <th>Fecha</th>
                        <th>De</th>
                        <th>Mensaje</th> 
                        <th>Visto</th>
                     <!-- <th>&nbsp;</th>-->
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($mensajes as $mensaje)
                            <tr>
                                <td class="table-text"><div>{{ (new \Carbon\Carbon($mensaje->fecha))->diffForHumans() }}</div></td>
                                <td class="table-text"><div>{{ $mensaje->paciente->nombre . ' ' . $mensaje->paciente->apellido }}</div></td>
                                <td class="table-text"><div>{{ $mensaje->cuerpo }}</div></td>                                       
                                <td class="table/text"> {{ Form::checkbox('visto', $mensaje->id, $mensaje->visto, ['class' => 'form-control checkVisto', 'id' => $mensaje->id]) }} </td>
                                <!--Ver Mensaje-->
                                <td>
                                    <!-- TRIGGER THE MODAL WITH A BUTTON -->
                                    {!! Form::button('Ver <i class="fa fa-eye"></i>', ['class' => 'btn btn-success btn-show-mensaje', 'type' => 'submit', 'data-id' => $mensaje->id,  'data-toggle' => 'modal', 'data-target' => '#showModal']) !!}                                            
                                </td>
                                <!-- Task Delete Button -->
                                <td>
                                    {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['mensajes.destroy', $mensaje->id],
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
                    {!! $mensajes->render() !!}
                </div>
            </div>                
        </div>         
    </div>    
@include('mensajes.show')
@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
    {!! Html::script('js/mensajes/show.js') !!}
    {!!Html::script('js/mensajes/setVisto.js')!!}
@endsection