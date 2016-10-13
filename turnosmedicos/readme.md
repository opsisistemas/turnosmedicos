# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

/******************************************************************************************/
/******************************************set up******************************************/
/******************************************************************************************/

#Set Up

1. Crear BD con nombre "turnos"
2. desde consola, hacr "composer update"
3. desde consola, hacer "php artisan migrate" (dos veces si es necesario).
4. Para login por dni (y no por email), modificar el archivo AuthenticatesUsers.php que, en la versión 5.2 de Laravel, se encuentra con la siguiente ruta (relativa al proyecto):

\vendor\laravel\framework\src\Illuminate\Foundation\Auth\AuthenticatesUsers.php

*las líneas a modificar, con sus cambios correspondientes, son:*

**línea 94**
```
protected function validateLogin(Request $request)
{
    $this->validate($request, [
        /*$this->loginUsername()*/'dni' => 'required', 'password' => 'required',
    ]);
}
```

**línea 196**
```
public function loginUsername()
{
    return 'dni';//property_exists($this, 'username') ? $this->username : 'email';
}
```

5. En consola correr elsiguiente comando>

```
sudo git config core.fileMode false
```

*si quisiéramos hacerlo global:*
```
git config --global core.fileMode false
```
/******************************************************************************************/
/****************************************fin set up****************************************/
/******************************************************************************************/