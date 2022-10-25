<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actor extends Model
{
    use HasFactory;

    protected $fillable=[
        'Nombre',
        'Apellido',
        'nacionalidad_id'
    ];

    public function protagonista(){
        return $this->hasMany(protagonista::class); 
    }
    public function nacionalidad(){
        return $this->belongsTo(nacionalidad::class);
    }
}
