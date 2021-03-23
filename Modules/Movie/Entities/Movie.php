<?php

namespace Modules\Movie\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ["title", "genre", "language", "actors", "directors", "poster", "released_date", "duration"];

  
    protected static function newFactory()
    {
        return \Modules\Movie\Database\factories\MovieFactory::new();
    }
}
