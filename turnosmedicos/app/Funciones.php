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

    public static function getObrasSocialesSel(){
        $obras_sociales = DB::table('obras_sociales')->select('nombre', 'id')->orderBy('nombre')->get();                        
        $obras_sociales_sel = array();
        foreach($obras_sociales as $obra_social){
            $obras_sociales_sel[$obra_social->id] = $obra_social->nombre;
        }

        return $obras_sociales_sel;
    }

    public static function getCategoriasSel()
    {
        $categorias = DB::table('categoria_medico')->select('descripcion', 'id')->orderBy('id')->get();                        
        $categorias_sel = array();
        foreach($categorias as $categoria){
            $categorias_sel[$categoria->id] = $categoria->descripcion;
        }

        return $categorias_sel;
    }
}
