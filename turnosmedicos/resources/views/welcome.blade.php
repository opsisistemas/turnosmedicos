@extends('layouts.app')

@section('content')
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <img src="img\medicina.jpg" class="img-responsive center-block">
        </div>
        @include('partials.alerts.js_confirm')  
        <!-- success messages -->
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif 
    </div>

    <footer class="footer">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h3>Contacto</h3>
            </div>
            <div class="panel-body">
                <ul class="contact-details">
                    <li><p><i class="fa fa-map-marker"></i> {{ $empresa->direccion }} </p></li>
                    <li><p><i class="fa fa-phone"></i> {{ $empresa->telefono1 . ' / ' . $empresa->telefono2 }} </p></li>
                    <li><p><i class="fa fa-envelope"></i> <a href=">openfg.soft@gmail.com"> {{ $empresa->email }} </a></p></li>
                </ul>
            </div>
        </div>
    </footer>
@endsection