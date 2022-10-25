@extends('layouts.app')
@section('content')
    <form action="{{ route('student.index') }}" method="GET" role="search">
        <h6 class="heading-small text-muted mb-4">User information</h6>

        <div class="row">
            <div class="form-group col-lg-5">
                <label for="exampleFormControlSelect1">Select Class</label>
                <select name="class_id" value="1" class="form-control" id="exampleFormControlSelect1">
                    {{-- @foreach ($classes as $class) --}}
                    <option value=""> </option>
                    {{-- @endforeach --}}
                </select>
            </div>
            <div class="form-group col-lg-5">
                <label for="exampleFormControlSelect1">Select Sub Class</label>
                <select name="sub_class_id" value="0" class="form-control" id="exampleFormControlSelect1">
                    {{-- @foreach ($classes as $class) --}}
                    <option value="1">A</option>
                    {{-- @endforeach --}}
                </select>
            </div>
            <div class="col-2 ">
                <button type="submit" class="btn btn-primary mt-md-4">Fetch Result</button>
            </div>
        </div>
    </form>
@endsection
