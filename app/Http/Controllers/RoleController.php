<?php

namespace App\Http\Controllers;

use App\Forms\rol\RolForm;
use Illuminate\Http\Request;
use App\Models\roles\Role;
use App\Models\roles\Permission;
use Exception;
use Kris\LaravelFormBuilder\FormBuilder;
use Facade\FlareClient\View;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{

   use FormBuilderTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Gate::authorize('todosAccesos','role.index');
        $roles = Role::orderBy('id','Desc')->paginate(2);
        return  View('role.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $form)
    {
        
       
        Gate::authorize('todosAccesos','role.create');
        $forms = $form->create('App\Forms\rol\RolForm', [
            'method' => 'POST',
            'url' => route('rol.store'),
        ]);

        return view('role.create', compact('forms'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('todosAccesos','role.create');
       $request->validate([
        "name"        => 'required|max:50|unique:roles,name',
        'slug'        => 'required|max:50|unique:roles,slug',
        'full-access' => 'required|in:yes,no'
       ]);
       
       $role = Role::create($request->all());
       
            //return $request->all();
            $role->permissions()->sync($request->get('permisos'));

        
       return redirect()->route('rol.index')->with('status_succes','Role Guardado correctamente');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FormBuilder $form)
    {
        //
        $this->authorize('todosAccesos','role.show');
         //permisos 
       $role = Role::findOrFail($id);
       $permisos = Permission::get();
       $formsView = $form->create('App\Forms\rol\RolViewForm', [        
       ],['Model' => $role] );

        return view('role.View', compact('formsView'));
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FormBuilder $form)
    {  
        Gate::authorize('todosAccesos','role.edit');
       //permisos 
        $role = Role::findOrFail($id);
       $permisos = Permission::get();
       $formsEditar = $form->create('App\Forms\rol\RolEdit', [
            'method' => 'PUT',
            'url' => route('rol.update', $role->id),
            
       ],['Model' => $role] );

        return view('role.edit', compact('formsEditar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        Gate::authorize('todosAccesos','role.edit');
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->descripcion = $request->descripcion;
        $role['full-access'] = $request['full-access'];
        $role->save();
       
            //return $request->all();
            $role->permissions()->sync($request->get('permisos'));

        
       return redirect()->route('rol.index')->with('status_succes','Role Actualizado correctamente');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        Gate::authorize('todosAccesos','role.destroy');
       $role->delete();
       return redirect()->route('rol.index')->with('status_succes','Role Eliminado correctamente');
       
        
    }
}
