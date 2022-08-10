<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\roles\Role;
use App\Models\roles\Permission;
use App\Models\User;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Gate::authorize('todosAccesos','user.index');
        $user = User::with('roles')->orderBy('id','Desc')->paginate(2);  
        return  View('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    
        //return "create";
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
        $usuario = User::findOrFail($id);
        $this->authorize('view',[$usuario,['user.show','userown.show']]);
        return View('user.show', compact('usuario'));
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
        $user = User::findOrFail($id);
        $this->authorize('update',[$user,['user.edit','userown.edit']]);
        $permisos = Permission::get();
        $formsEdit = $form->create('App\Forms\user\UserForm', [
             'method' => 'PUT',
             'url' => route('user.update', $user->id),
             
        ],['Model' => $user] );
 
         return view('user.edit', compact('formsEdit'));
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
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();
        //$request->get('roles')
        $user->roles()->sync($request->get('roles'));
       
        
       return redirect()->route('user.index')->with('status_succes','Usuario Actualizado  Correctamente');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('todosAccesos','user.destroy');
        $user->delete();
       return redirect()->route('rol.index')->with('status_succes','Usuario eliminado correctamente');
    }
}
