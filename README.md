
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

5)En consola correr elsiguiente comando>

```
sudo git config core.fileMode false
```

*si quisiéramos hacerlo global:*
```
git config --global core.fileMode false
```
