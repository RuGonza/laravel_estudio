<?php

namespace App\Forms\rol;

use Kris\LaravelFormBuilder\Form;
use Collective\Html\FormBuilder;
use App\Models\roles\Permission;
use App\Models\roles\Role;
use PHPUnit\Framework\Constraint\Count;

class RolEdit extends Form
{
    public function buildForm()
    {
        // Add fields here...
        //variable para los permisos
          
           
          //traer todos los permisos
          $todos_permisos  = Permission::all()->pluck('name','id');
           //pasar el modelo
      
           $datosModels = $this->getData('Model');
           //varibles
            $permisos_roles = [];
            $checked = false;
            $obj_che = [];
           
            //forech  para la relacion
            foreach($datosModels->permissions as $permisos){
               $permisos_roles[] = $permisos->id;
            }           
          
         $this->add('name', 'text',[
              'value'=> $datosModels->name
         ]);
        $this->add('slug','text',[
            'value' => $datosModels->slug
        ]);
        $this->add('descripcion','textarea',[
            'value' => $datosModels->descripcion
        ]);
        $this->add('full-access','select',[
                'choices' => ['yes' => 'yes', 'no' => 'no'],
                'selected' => $datosModels['full-access'],
                'empty_value' => '=== Select Accesss===',
         ]);
        for ($j=1; $j<= count($todos_permisos); $j++): 
            $this->add( "permisos[$todos_permisos[$j]]" ,'checkbox',[
              'label' => $todos_permisos[$j],
              'value' => $j,
              'checked' => is_array($permisos_roles) && in_array($j,$permisos_roles)
          ]);
                 
         endfor;        
        $this->add('submit','submit',[
              'attr' => ['class' => ' btn btn-info m-4 justify-content-center '],
              'label'=> 'Enviar'
            ]);
        

    }
}
