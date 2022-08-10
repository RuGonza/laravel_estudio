<?php

namespace App\Models\roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    //ingreso masivo
    protected $fillable  = [
        'name',
        'slug',
        'descripcion',
    ];

    //relacion polimorfica
    public function roles()
    {
        return $this->belongsToMany('App\Models\roles\Role')->withTimestamps();
    }

}
