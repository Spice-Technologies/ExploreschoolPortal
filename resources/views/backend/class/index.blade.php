@extends('layouts.app')
@section('content')
    <ul class="list-group">


        <li class="list-group-item active">Classes</li>

        @foreach ($classes  as $classe )
            <li class="list-group-item">- {{$classe->class_name}}</li>
            
        @endforeach
        {{-- <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Morbi leo risus</li>
        <li class="list-group-item">Porta ac consectetur ac</li>
        <li class="list-group-item">Vestibulum at eros</li> --}}
    </ul>
@endsection
