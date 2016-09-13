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
            <h1>
                Listado de Usuarios por Rol
                <div class="pull-right">
                    {!! Form::open([
                        'method' => 'GET',
                        'route' => ['users.create'],
                        'class' => 'navbar-form navbar-left pull-left'                                                         
                    ]) !!}
                    {!! Form::submit('Nuevo Usuario Administrador', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!} 
                </div> 
            </h1>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading"> 
                {!! Form::open([
                                'method' => 'GET',
                                'class' => 'navbar-form',
                                'role' => 'search',
                                'url' => ['usersnroles']
                                 ]) !!}

                    <!--selección de rol-->
                    {!! Form::label('role_id', 'Rol:', ['class' => 'control-label']) !!}
                    {!! Form::select('role_id', $roles, $role_id, ['class' => 'form-control enfocar']) !!}

                    {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'form-control']) !!}

                {!! Form::close() !!}
            </div>
		</div>
        <div class="panel-body">
        @if($users->count() == 0)
            <h2>No se encontraron usuarios para el rol solicitado</h2>
        @else
            <table class="table table-striped task-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Fecha de Alta</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->name }}</td>
                            <td> {{ $user->surname }}</td>
                            <td> {{ $user->email }}</td>
                            <td>
                                {{
                                    (new \Carbon\Carbon($user->created_at))->formatLocalized('%A %d %B') . ' (' .
                                    (new \Carbon\Carbon($user->created_at))->diffForHumans() . ')'
                                }}
                            </td>
                                    <!-- Task Delete Button -->
                            <td>
                                @if(($user->hasRole('admin'))&&(! $user->hasRole('owner')))
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['users.destroy', $user->id],
                                        'onsubmit' => 'return ConfirmDelete()'                  
                                    ]) !!}

                                    {!! Form::button('Eliminar <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>                
    </div>
</div>
@endsection

@section('scripts')
    {!!Html::script('js/funciones/focus.js')!!}
@endsection