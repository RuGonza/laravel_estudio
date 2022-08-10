<?php

namespace App\Models\Traits;

 trait UserTraits{

     //relaciones porlimorficas para roles 
    public function roles()
    {
        return $this->belongsToMany('App\Models\roles\Role')->withTimestamps();
    }
    public function havePermissions($permisions){
          foreach($this->roles as $role){
                if($role['full-access'] == 'yes'){
                    return true;
                }
                foreach($role->permissions as $perm){
                    if($perm->slug == $permisions ){
                        return true;
                    }
                }
          }
          return false;
    }

 }
