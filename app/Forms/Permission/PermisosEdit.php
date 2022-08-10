<?php

namespace App\Forms\Permission;

use Kris\LaravelFormBuilder\Form;

class PermisosEdit extends Form
{
    public function buildForm()
    {
        // Add fields here...

        $datosModel = $this->getData('Model');

        $this->add('name','text',[
             'value' => $datosModel->name
        ]);
        $this->add('slug','text',[
          'value' => $datosModel->slug
        ]);
        $this->add('descripcion','textarea',[
            'value' => $datosModel->descripcion
        ]);
        $this->add('Actualizar','submit',[
             'attr' => ['class'=> 'btn btn-info mt-2']
        ]);

    }
}
