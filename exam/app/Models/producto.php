<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\detalle;
class producto extends Model
{
    public function producto()
    {
        return $this->hasMany(detalle::class);
    }
}
