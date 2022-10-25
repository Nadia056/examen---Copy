<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelicula extends Model
{
    use HasFactory;

    protected $fillable=[
        'titulo',
        'genero_id',
        'director',
        'año'
    ];

    public function protagonista(){
        return $this->hasMany(protagonista::class); 
    }
    public function genero(){
        return $this->belongsTo(genero::class); 
    }
}
