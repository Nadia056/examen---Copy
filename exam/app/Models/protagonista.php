<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class protagonista extends Model
{
    use HasFactory;

    protected $fillable=[
        'actor_id',
        'pelicula'
    ];

    public function pelicula(){
        return $this->belongsTo(pelicula::class); 
    }

    public function actor(){
        return $this->belongsTo(actor::class); 
    }
}
