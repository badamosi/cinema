<?php

namespace Modules\Cinema\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = ["name", "address"];
    
    protected static function newFactory()
    {
        return \Modules\Cinema\Database\factories\CinemaFactory::new();
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
