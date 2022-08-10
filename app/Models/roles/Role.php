<?php

namespace App\Models\roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //cargamos los fillabel para carga masiva
    protected $fillable  = [
        'name',
        'slug',
        'descripcion',
        'full-access',
    ];

    //relaciones porlimorficas para los usuarios
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\roles\Permission')->withTimestamps();
    }


}
