<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pedido;
use App\Models\producto;

class detalle extends Model
{
    public function detalle()
    {
        return $this->hasManyThrough(pedido::class, producto::class);
    }
}
