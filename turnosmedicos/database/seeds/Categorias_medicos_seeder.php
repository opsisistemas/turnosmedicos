<?php

use Illuminate\Database\Seeder;

class Categorias_medicos_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_medico')->insert([
            'descripcion' => 'A',
        ]);
        DB::table('categoria_medico')->insert([
            'descripcion' => 'B',
        ]);
        DB::table('categoria_medico')->insert([
            'descripcion' => 'C',
        ]);
        DB::table('categoria_medico')->insert([
            'descripcion' => 'Arancel Libre',
        ]);
    }
}
