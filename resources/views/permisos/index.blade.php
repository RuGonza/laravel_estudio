@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Lista Permisos</h1>
                </div>
               
                <a  href="{{route('permisos.create')}}"class="btn btn-primary float-left w-25 m-2 p-2" >Crear</a>
               
                @include('custom.message')
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Descripcion</th>
                                <th colspan="3"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($permisos as $permiso) 
                            <tr>
                           
                                    <th scope="row">{{$permiso->id}}</th>
                                    <td>{{$permiso->name}}</td>
                                    <td>{{$permiso->slug}}</td>
                                    <td>{{$permiso->descripcion}}</td>
                                    <td>
                                 
                                        <a class="btn btn-info" href="{{route('permisos.show',$permiso->id)}}">Mostrar</a>
                                   
                                    </td>
                                    <td>
                                    
                                        <a class="btn btn-success" href="{{route('permisos.edit',$permiso->id)}}">Editar</a>
                                   
                                    </td>
                                    <td>
                                    
                                        <form action="{{route('permisos.destroy',$permiso->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Eliminar</button>
                                        </form>
                                       
                                    </td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--paginador-->
                    {{ $permisos->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection