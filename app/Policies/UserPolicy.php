<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $usera
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $usera)
    {
        //
      
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $usera
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $usera, User $user,  $perm=null)
    {
        if ($usera->havePermissions($perm[0])){
             return true;
        }else if ($usera->havePermissions($perm[1])){
            return $usera->id === $user->id;
       }else {
         return false;
       }
         
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $usera
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $usera, User $user, $perm=null)
    {
        if ($usera->havePermissions($perm[0])){
            return true;
       }else if ($usera->havePermissions($perm[1])){
           return $usera->id === $user->id;
      }else {
        return false;
      }
    }


}
