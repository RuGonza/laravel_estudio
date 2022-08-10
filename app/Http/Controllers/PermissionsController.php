<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\roles\Permission;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\Gate;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Gate::authorize('todosAccesos','permision.view');
        $permisos = Permission::orderBy('id','desc')->paginate(8);
        return View('permisos.index',compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $form)
    {
        //
        Gate::authorize('todosAccesos','permisions.create');
        $forms = $form->create('App\Forms\Permission\PermisosCreate', [
            'method' => 'POST',
            'url' => route('permisos.store'),
        ]);

        return view('permisos.create', compact('forms'));
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
            'name' => 'required|max:50|unique:permissions,name',
            'name' => 'required|max:50|unique:permissions,slug',
            'descripcion' => 'required'
        ]);

        $permiso = Permission::create($request->all());
        return redirect()->route('permisos.index')->with('status_succes','Permisos Guardado correctamente');

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
        Gate::authorize('todosAccesos','permisions.edit');
        $permisos = Permission::findOrFail($id);
        $formsEdit = $form->create('App\Forms\Permission\PermisosEdit', [
             'method' => 'PUT',
             'url' => route('permisos.update', $permisos->id),
             
        ],['Model' => $permisos] );
 
         return view('permisos.edit', compact('formsEdit'));
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
        $permisos = Permission::findOrFail($id);
        $permisos->name = $request->name;
        $permisos->slug = $request->slug;
        $permisos->descripcion = $request->descripcion;
        //$request->get('roles')
        $permisos->save();
       
        
       return redirect()->route('permisos.index')->with('status_succes','Permisos Actualizado  Correctamente');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permiso)
    {
        //
        Gate::authorize('todosAccesos','permisions.delete');
        $permiso->delete();
        return redirect()->route('permisos.index')->with('status_succes','Permiso Eliminado correctamente');
    }
}
