<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Facades\File;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/generos.json'));
        $genres = json_decode($json, true);

        foreach ($genres as $genre) {
            Genre::create([
                'id' => $genre['id'], 
                'name' => $genre['name']
            ]);
        }
    }
}
