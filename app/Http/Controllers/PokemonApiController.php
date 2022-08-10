<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonApiController extends Controller
{
    //
    public function mostrar(){
        $pokemon = Http::get('https://jsonplaceholder.typicode.com/photos');
        $pokemosJson = $pokemon->json();
       return View('api.ability', compact('pokemosJson'));
    }
}
