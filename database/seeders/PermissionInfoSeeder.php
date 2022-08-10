<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\roles\Role;
use App\Models\roles\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PermissionInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //desativar los foreing key
        DB::statement('SET foreign_key_checks=0');
        //trunked vacior la base de datos
       
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
       
        //trunquedt con eloquent
        Permission::truncate();
        Role::truncate();

        //habilitar los foreing
        DB::statement('SET foreign_key_checks=1');

        //user admin
        $userAdmin = User::where('email','admin@admin.com')->first();
        if ($userAdmin){
            $userAdmin->delete();
        }
        $userAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
         ]);  
            $rolAdmin =  Role::create([
                'name' => 'admin',
                'slug' => 'admin',
                'descripcion' => 'Administrador',
                'full-access' => 'yes'
             ]);
             //relacion table_role_user
            $userAdmin->roles()->sync([$rolAdmin->id]);

            //permisos
            $permision_all = [];
            //permisos de los roles
            $permission = Permission::create([
                'name' => 'list role',
                'slug' => 'role.index',
                'descripcion' => 'A user can list role'
            ]);
            $permision_all[] = $permission->id;
            //
            $permission =  Permission::create([
                'name' => 'Show role',
                'slug' => 'role.show',
                'descripcion' => 'A user can see role'
            ]);
            $permision_all[] = $permission->id;
            //
            $permission =  Permission::create([
                'name' => 'create role',
                'slug' => 'role.create',
                'descripcion' => 'A user can create role'
            ]);
            $permision_all[] = $permission->id;
            //
            $permission =  Permission::create([
                'name' => 'edit role',
                'slug' => 'role.edit',
                'descripcion' => 'A user can edit role'
            ]);
            $permision_all[] = $permission->id;
            //
            $permission =  Permission::create([
                'name' => 'Destroy role',
                'slug' => 'role.destroy',
                'descripcion' => 'A user can destroy role'
            ]);
            $permision_all[] = $permission->id;

        //usuarios
          //permisos
            //permisos de los users
            $permission = Permission::create([
                'name' => 'list user',
                'slug' => 'user.index',
                'descripcion' => 'A user can list user'
            ]);
            $permision_all[] = $permission->id;
            //
            $permission =  Permission::create([
                'name' => 'Show user',
                'slug' => 'user.show',
                'descripcion' => 'A user can see user'
            ]);
            $permision_all[] = $permission->id;
            
            //
            $permission =  Permission::create([
                'name' => 'edit user',
                'slug' => 'user.edit',
                'descripcion' => 'A user can edit user'
            ]);
            $permision_all[] = $permission->id;
            //
            $permission =  Permission::create([
                'name' => 'Destroy user',
                'slug' => 'user.destroy',
                'descripcion' => 'A user can destroy user'
            ]);
            $permision_all[] = $permission->id;
        
           // new
           $permission =  Permission::create([
            'name' => 'Show own user',
            'slug' => 'userown.show',
            'descripcion' => 'A user can see own user'
        ]);
        $permision_all[] = $permission->id;
        
        //
        $permission =  Permission::create([
            'name' => 'edit own user',
            'slug' => 'userown.edit',
            'descripcion' => 'A user can edit own user'
        ]);
        $permision_all[] = $permission->id;
        //
    }
}

