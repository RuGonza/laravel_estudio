<?php

namespace App\Forms\rol;

use Kris\LaravelFormBuilder\Form;
use Collective\Html\FormBuilder;
use App\Models\roles\Permission;
use App\Models\roles\Role;
use PHPUnit\Framework\Constraint\Count;

class RolViewForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
          //traer todos los permisos
          $PermisosCompletos  = Permission::all()->pluck('name','id');
          //pasar el modelo
          $datosModel = $this->getData('Model');
          //varibles
           $permisos_roles = [];
           $checked = false;
           $obj_che = [];
          
           //forech  para la relacion
           foreach($datosModel->permissions as $permisos){
              $permisos_roles[] = $permisos->id;
           }           
        
        $this->add('name', 'text',[
             'value'=> $datosModel->name,
        ]);
        $this->add('slug','text',[
            'value' => $datosModel->slug
        ]);
        $this->add('descripcion','textarea',[
            'value' => $datosModel->descripcion
        ]);
        $this->add('full-access','select',[
                'choices' => ['yes' => 'yes', 'no' => 'no'],
                'selected' => $datosModel['full-access'],
                'empty_value' => '=== Select Accesss===',
         ]);
         for ($j=1; $j<= Count($PermisosCompletos); $j++): 
                $this->add( "permisos[$PermisosCompletos[$j]]" ,'checkbox',[
                  'label' => $PermisosCompletos[$j],
                  'value' => $j,
                  'checked' => is_array($permisos_roles) && in_array($j,$permisos_roles)
               ]);
               
         endfor;        

    }
}
