<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\detalle;

class pedido extends Model
{
    public function comments()
    {
        return $this->hasMany(detalle::class);
    }
}
