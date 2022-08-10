<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\motocicletas\motos;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Gate::authorize('todosAccesos','motos.view');
        $motos = motos::orderBy('id','desc')->paginate(4);
        return View('home',compact('motos'));
        
    }
    
    //methodo para el buscador
    public function buscador(Request $request){
        $nombre = motos::where('nombre','LIKE',$request->texto."%")->take(10)->get();
        return  View("Buscador.buscar",compact('nombre'));
   }
   //metodo para mostrar la foto
   public function foto($id){
      $foto = motos::findOrFail($id);
      return View('modal.modalMotos', compact('foto'));
   }
}
