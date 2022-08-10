<?php

namespace App\Models\motocicletas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class motos extends Model
{
    use HasFactory;

    protected $table = "motos";

    protected $fillable = [
         'name',
         'descripcion',
         'foto'
    ];
}
