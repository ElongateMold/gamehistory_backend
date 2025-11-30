<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/juegos.json'));
        $juegos = json_decode($json, true);

        foreach ($juegos as $juegoData) {

            $game = Game::create([
                'title' => $juegoData['nombre'],
                'image_url' => $juegoData['imagen'],
                'hours_played' => $juegoData['horasJugadas'],
                'hours_total' => $juegoData['horasTotales'],
            ]);

            if (isset($juegoData['generos'])) {
                $game->genres()->attach($juegoData['generos']);
            }
        }
    }
}
