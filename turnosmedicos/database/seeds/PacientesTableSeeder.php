<?php

use Illuminate\Database\Seeder;

class PacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pacientes')->insert([
            'apellido' => str_random(50),
            'nombre' => str_random(50),
            'sexo' => 'F',
            'telefono' => str_random(25),
        ]);
    }
}
