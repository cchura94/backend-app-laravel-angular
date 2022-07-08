<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot("cantidad")->withTimestamps();
    }
    // Pedido::find(1)->productos()->attach(2, ["cantidad" => 2])

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
