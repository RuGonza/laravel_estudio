@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>Crear roles</h1>
                    @include('custom.message')
                </div class="w-75 container-r">
                     <br>
                        {!! form($formGuardar) !!}

                      
                    <br>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection