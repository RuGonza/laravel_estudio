<?php

namespace App\Forms\rol;

use App\Models\roles\Permission;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;
use App\Models\roles\Role;
use Collective\Html\FormBuilder;

class RolForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
      
        $permisos  = Permission::all()->pluck('name','id');     
        
         
        $this->add('name', 'text');
        $this->add('slug','text');
        $this->add('descripcion','textarea');
        $this->add('full-access','select',[
                'choices' => ['yes' => 'yes', 'no' => 'no'],
                'selected' => 'yes',
                'empty_value' => '=== Select Accesss===',
         ]);
         for ($i=1; $i<=count($permisos); $i++):
          $this->add( "permisos[$permisos[$i]]" ,'checkbox',[
            'label' => $permisos[$i],
            'value' => $i,
          ]);
         endfor;
        
          //dd($permisosTitulo);
         
       


        $this->add('submit','submit',[
              'attr' => ['class' => ' btn btn-info m-4 justify-content-center '],
              'label'=> 'Enviar'
            ]);
           

    }
}