<?php

namespace App\Forms\motos;

use Kris\LaravelFormBuilder\Form;

class MotosFormCreate extends Form
{
    public function buildForm()
    {
        // Add fields here...
         $this->add('name','text');
         $this->add('descripcion', 'textarea');
         $this->add('foto','file',[
            'label' => 'foto de la motoclicleta'
         ]);
         $this->add('guardar','submit',[
            'attr' => ['class' => 'btn btn-info m-2']
         ]);
    }
}
