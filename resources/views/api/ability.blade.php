@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>Mostrar APi</h1>
                    
                    @foreach($pokemosJson as $poken)
                      <nav>
                         <ul>
                            <li>{{$poken["id"]}}</li>
                            <li>{{$poken["title"]}}</li>
                            <li>
                                <img src="{{ $poken['url'] }}" alt="">
                            </li>
                         </ul>
                      </nav>
                    @endforeach
                
                



            </div>

        </div>
    </div>
</div>
</div>
@endsection