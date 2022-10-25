<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\cliente;


class empleado extends Model
{
    public function empleado()
    {
        return $this->hasMany(cliente::class);
    }
}
