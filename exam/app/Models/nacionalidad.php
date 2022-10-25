<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nacionalidad extends Model
{
    use HasFactory;

    protected $fillable=[
        'nacionalidad'
    ];

    public function actor(){
        return $this->hasMany(actor::class); 
    }
}
