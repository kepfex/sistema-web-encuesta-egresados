<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpia la tabla para evitar duplicados si se ejecuta varias veces
        Program::query()->delete();

        $programas = [
            'Asistencia Administrativa',
            'Enfermería Técnica',
            'Construcción Civil',
            'Arquitectura de Plataformas y Servicios de TI',
        ];

        foreach ($programas as $programa) {
            Program::create(['nombre' => $programa]);
        }
    }
}
