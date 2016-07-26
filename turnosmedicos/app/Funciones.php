<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Funciones extends Model
{
    public static function getPaisesSel(){
    	$paises = DB::table('pais')->select('nombre', 'id')->orderBy('nombre')->get();                        
        $paises_sel = array();
        foreach($paises as $pais){
            $paises_sel[$pais->id] = $pais->nombre;
        }

        return $paises_sel;
    }

    public static function getProvinciasSel($idPais){
    	$provincias = DB::table('provincia')->select('nombre', 'id')->where('pais_id', '=', $idPais)->orderBy('nombre')->get();                        
        $provincias_sel = array();
        foreach($provincias as $provincia){
            $provincias_sel[$provincia->id] = $provincia->nombre;
        }

        return $provincias_sel;
    }
}
