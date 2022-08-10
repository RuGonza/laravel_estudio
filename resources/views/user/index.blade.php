@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Lista Usuarios</h1>
                </div>
                     @include('custom.message')
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">email</th>
                                <th scope="col">Roles</th>
                                <th colspan="3"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $usuario) 
                           
                            <tr>
                           
                                    <th scope="row">{{$usuario->id}}</th>
                                    <td>{{$usuario->name}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td>
                                       @isset($usuario->roles[0]->name)
                                         {{$usuario->roles[0]->name}}
                                       @endisset
                                  
                                    </td>
                                    <td>
                                    @can('view',[$usuario, ['user.show','userown.show'] ])
                                        <a class="btn btn-info" href="{{route('user.show',$usuario->id)}}">Mostrar</a>
                                      @endcan
                                    </td>
                                    <td>
                                    @can('view', [$usuario, ['user.edit','userown.edit'] ])
                                        <a class="btn btn-success" href="{{route('user.edit',$usuario->id)}}">Editar</a>
                                     @endcan
                                    </td>
                                    <td>
                                    @can('todosAccesos','user.destroy')
                                        <form action="{{route('user.destroy',$usuario->id)}}" method="POST">
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
                    {{ $user->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



