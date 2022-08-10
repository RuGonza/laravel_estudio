<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\motocicletas\motos;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class motocicletasController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $form)
    {
        $formGuardar = $form->create('App\Forms\motos\MotosFormCreate', [
            'method' => 'POST',
            'url' => route('motos.store'),
        ]);
        return View('moto.create',compact('formGuardar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
       $request->validate([
           'name' => 'required|max:50',
           'descripcion' => 'required',
           'foto' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
       ]);
       $motos = new motos();
       $motos->name = $request->name;
       $motos->descripcion = $request->descripcion;
       //indicamos lo que queremos almacenar el el spacio del disco
        $archivo = $request-> file('foto');
        $nombre = time().'.'.$archivo->getClientOriginalExtension();
        $destino = Public_path('images/motos');
        $fotos = $request->foto->move($destino, $nombre);
        $motos->foto = $nombre;
        $motos->save();
      //return $motos;
      return redirect()->back()->with('status_succes','Motocicleta Guardada correctamente');
 
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $datos = motos::findOrFail($id);
        return View('moto.index', compact('datos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FormBuilder $form)
    {
        //
        Gate::authorize('todosAccesos','motos.edit');
        $datos = motos::findOrFail($id);
        $formEditar = $form->create('App\Forms\motos\editMotosForm', [
            'method' => 'PUT',
            'url' => route('motos.update',$datos->id),
        ],['Model' => $datos]);
        return View('moto.edit',compact('formEditar'));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|max:50',
            'descripcion' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $motos = motos::findOrFail($id);
        $motos->name = $request->name;
        $motos->descripcion = $request->descripcion;
        //indicamos lo que queremos almacenar el el spacio del disco
         $archivo = $request-> file('foto');
         $nombre = time().'.'.$archivo->getClientOriginalExtension();
         $destino = Public_path('images/motos');
         $fotos = $request->foto->move($destino, $nombre);
         $motos->foto = $nombre;
         $motos->save();
       //return $motos;
       return redirect()->route('home')->with('status_succes','Motocicleta Editada Correctamente.');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(motos $moto)
    {
        //
        Gate::authorize('todosAccesos','motos.destroy');
        $moto->delete();
        return redirect()->route('home')->with('status_succes','Motocicleta Eliminada Correctamente.');

    }


}
