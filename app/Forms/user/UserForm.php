<?php

namespace App\Forms\user;

use Kris\LaravelFormBuilder\Form;
use Collective\Html\FormBuilder;
use App\Models\roles\Role;

use PHPUnit\Framework\Constraint\Count;

class UserForm extends Form
{
    public function buildForm()
    {
        
          //traer todos los permisos
          $roles  = Role::all()->pluck('name','id');
          //pasar el modelo
          $datosModel = $this->getData('Model');
            //varibles
            $permisos_roles = [];
          foreach($datosModel->roles as $permisos){
            $permisos_roles[] = $permisos->id;
         }  
           
          $this->add('name', 'text',[
                'value'=> $datosModel->name
            ]);
            $this->add('email', 'text',[
              'value'=> $datosModel->email
          ]);
            
            for ($j=1; $j<= Count($roles); $j++): 
                $this->add( "roles[$roles[$j]]" ,'checkbox',[
                  'label' => $roles[$j],
                  'value' => $j,
                  'checked' => is_array($permisos_roles) && in_array($j,$permisos_roles),
                  
               ]);               
         endfor;
         $this->add('submit','submit',[
            'attr' => ['class' => ' btn btn-info m-4 justify-content-center '],
            'label'=> 'Enviar'
          ]);
        
            
       
    }
}
