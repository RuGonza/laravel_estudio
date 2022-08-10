<?php

namespace App\Forms\Permission;

use Kris\LaravelFormBuilder\Form;

class PermisosCreate extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this->add('name','text');
        $this->add('slug','text',[
          'label' => "slug (permisons.index)"  
        ]);
        $this->add('descripcion','textarea');
        $this->add('Guardar','submit',[
             'attr' => ['class'=> 'btn btn-info ']
        ]);
    }
}
