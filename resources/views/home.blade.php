@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todas las Motocicletas</div>

                <div class="card-body">
                    @include('custom.message')
                    <div class="input-group mb-3 w-50">
                        <input type="text" class="form-control" id="texto" placeholder="Ingrese nombre">
                    </div>
                    @include('modal.modalMotos')
                    <a href="{{ route('motos.create') }}" class="btn btn-info agregar" >Agregar</a>
                    <table class="table table-hover" id="resultado">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">descripcion</th>
                                <th scope="col">foto</th>
                                <th colspan="3"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($motos as $m)
                            <tr>
                               
                                    <th scope="row">{{$m->id}}</th>
                                    <td>{{$m->name}}</td>
                                    <td>{{$m->descripcion}}</td>
                                    <td>
                                         <a href="{{ route('foto',$m->id) }}">
                                             <img src="images/motos/{{$m->foto}}" class="w-50 h-50" alt="imagen">
                                         </a>
                                    </td>
                                    <td>

                                        <a class="btn btn-info" href="{{route('motos.show',$m->id)}}">Mostrar</a>
                             
                                    </td>
                                    <td>
                                
                                        <a class="btn btn-success" href="{{ route('motos.edit',$m->id) }}">Editar</a>
                                 
                                    </td>
                                    <td>
                                   
                                        <form action="{{ route('motos.destroy',$m->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Eliminar</button>
                                        </form>
                                      
                                    </td>
                                    
                                
                            </tr>
                            <tr class="noSearch hide">
                                 <td colspan="5"></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $motos->links('vendor.pagination.default') }}
             
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection