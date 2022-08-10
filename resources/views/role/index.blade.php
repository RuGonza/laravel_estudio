@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Lista roles</h1>
                </div>
                @can('todosAccesos','role.create')
                <a  href="{{route('rol.create')}}"class="btn btn-primary float-left w-25 m-2 p-2" >Crear</a>
                @endcan
                @include('custom.message')
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Full Access</th>
                                <th colspan="3"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $rol) 
                            <tr>
                           
                                    <th scope="row">{{$rol->id}}</th>
                                    <td>{{$rol->name}}</td>
                                    <td>{{$rol->slug}}</td>
                                    <td>{{$rol->descripcion}}</td>
                                    <td>{{$rol['full-access']}}</td>
                                    <td>
                                    @can('todosAccesos','role.show')
                                        <a class="btn btn-info" href="{{route('rol.show',$rol->id)}}">Mostrar</a>
                                    @endcan
                                    </td>
                                    <td>
                                    @can('todosAccesos','role.edit')
                                        <a class="btn btn-success" href="{{route('rol.edit',$rol->id)}}">Editar</a>
                                    @endcan
                                    </td>
                                    <td>
                                    @can('todosAccesos','role.destroy')
                                        <form action="{{route('rol.destroy',$rol->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Eliminar</button>
                                        </form>
                                        @endcan
                                    </td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--paginador-->
                    {{ $roles->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



