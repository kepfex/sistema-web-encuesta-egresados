<?php

namespace Database\Seeders;

use App\Models\CurrentYear;
use Illuminate\Database\Seeder;

class CurrentYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Checks if the table already has a record before creating one.
        if (CurrentYear::count() === 0) {
            CurrentYear::create([
                'denominacion' => 'Año de la recuperación y consolidación de la economía peruana',
            ]);
        }
    }
}
