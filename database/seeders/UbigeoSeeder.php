<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UbigeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactiva la revisión de llaves foráneas para evitar errores de orden
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Desactiva la revisión de llaves foráneas para evitar errores de orden
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpia las tablas antes de insertar para evitar duplicados
        DB::table('districts')->truncate();
        DB::table('provinces')->truncate();
        DB::table('departments')->truncate();
        DB::table('countries')->truncate();

        // Ejecuta el script SQL que SÓLO contiene los INSERTS
        $sql = File::get(database_path('data/ubigeoperu.sql'));
        DB::unprepared($sql);
        
        // Reactiva la revisión de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
