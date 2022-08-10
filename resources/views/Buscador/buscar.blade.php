@if(count($nombre))
    @foreach($nombre as $item)
      <p class="p-2 border-bottom">{{$item->id.'.'.$item->nombre}}</p>
    @endforeach
@endif