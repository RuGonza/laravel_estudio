<?php

namespace App\Forms\motos;

use Kris\LaravelFormBuilder\Form;

class editMotosForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        //traemos el modelo
        $datosModel = $this->getData('Model');

        $this->add('name','text',[
            'label' => 'nombre Moto',
            'value' => $datosModel->name
        ]);
        $this->add('descripcion','textarea',[
            'value'=> $datosModel->descripcion
        ]);
        $this->add('foto','file',[
            'value' => "/images/motos/".$datosModel->foto
        ]);

        $this->add('editar','submit',[
            'attr' => ['class' => 'btn btn-danger m-2']
        ]);
    }
}
