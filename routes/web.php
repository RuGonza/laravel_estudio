<?php

use App\Http\Controllers\motocicletasController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas de los roles
Route::resource('roles', RoleController::class)->names('rol');

Route::resource('permisos', PermissionsController::class)->names('permisos');

Route::resource('motos', motocicletasController::class)->names('motos')->except('view');

Route::resource('user', UserController::class)->names('user')->except('create','store');
//ruta para el buscador 
Route::get('buscador', [App\Http\Controllers\HomeController::class, 'buscador'])->name('buscador');
//ruta para mostrar la foto en ajax
Route::get('foto/{id}',[App\Http\Controllers\HomeController::class, 'foto'] )->name('foto');
//api por get para pokemon
Route::get('Api', [App\Http\Controllers\PokemonApiController::class, 'mostrar'])->name('api');
