<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = ['Nivel básico', 'Nivel intermedio', 'Nivel avanzado'];

        foreach($levels as $level){
            Level::create([
                'name' => $level
            ]);
        }
    }
}
