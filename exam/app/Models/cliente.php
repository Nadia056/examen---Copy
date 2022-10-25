<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\empleado;

class cliente extends Model
{
    public function cliente()
    {
        return $this->belongsTo(empleado::class);
    }
}
