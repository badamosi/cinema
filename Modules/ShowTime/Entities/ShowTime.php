<?php

namespace Modules\ShowTime\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cinema\Entities\Cinema;
use Modules\Movie\Entities\Movie;

class ShowTime extends Model
{
    use HasFactory;

    protected $fillable = ["cinema_id", "movie_id", "show_time"];
    
    protected static function newFactory()
    {
        return \Modules\ShowTime\Database\factories\ShowTimeFactory::new();
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'cinema_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
