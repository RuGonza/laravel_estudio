@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Usuario</h1>
                   
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" value="{{$usuario->name}}">
                    </div>
                    <div class="form-group">
                        <label for="Nombre">email</label>
                        <input type="email" class="form-control" id="nombre" value="{{$usuario->email}}">
                    </div>
                </div>
                <a href="{{route('user.index')}}" class="btn btn-danger" >devolver</a> 

            </div>
        </div>
    </div>
</div>
@endsection