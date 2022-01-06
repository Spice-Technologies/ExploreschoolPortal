@extends('layouts.app')

@section('content')
@role('Student')
 @include('dashboard.student')
@endrole
@endsection
//the sidebar you get to see depends on your role but you will always be redirected to the particulra view  that represents your role
