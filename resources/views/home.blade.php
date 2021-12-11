@extends('layouts.app')

@section('content')
{{env('SITE_URL')}}
@role('Student')
 @include('dashboard.student')
@endrole
@endsection
