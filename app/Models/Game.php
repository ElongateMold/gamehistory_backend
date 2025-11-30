<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'hours_played',
        'hours_total',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genre');
    }
}
