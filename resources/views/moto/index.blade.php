@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>Mostrar Motocicleta</h1>
                    </div class="w-75 container-r">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="email" class="form-control"   value="{{$datos->name}}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label><br>
                        <textarea name="" id="" cols="130" rows="10">{{$datos->descripcion}}</textarea>
                    </div>
                    <br>
                    <img src="/images/motos/{{$datos->foto}}"  alt="foto" class="img-fluid w-100 h-50"  >

                     <div class="form-group">
                         <a href="{{ route('home') 
                        }}" class="btn btn-danger">Volver</a>
                     </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection