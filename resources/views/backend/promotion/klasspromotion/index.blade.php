@extends('layouts.app')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text">{{ session('msg') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card-body">
        <form action="{{ route('promote.klass.promote') }}" method="POST" role="search">
            @csrf

            <h6 class="heading-small text-muted mb-4">User information</h6>

            <div class="row">
                <div class="form-group col-lg-5">
                    <label for="exampleFormControlSelect1">Select Class</label>
                    <select name="class_id" value="1" class="form-control" id="exampleFormControlSelect1">
                        @foreach ($classes as $key => $class)
                            @if ($key == 'promoted')
                                @foreach ($class as $k => $cla)
                                    <option value="{{ $cla }}" disabled> {{ $k }} <i>-- Promoted </i></option>
                                @endforeach
                            @else
                                <option value="{{ $class }}"> {{ $key }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-5">
                    <label for="exampleFormControlSelect1">Promte to ...</label>
                    <select name="sub_class_id" value="0" class="form-control" id="exampleFormControlSelect1">
                        {{-- @foreach ($classes as $key => $class)
                            <option value="{{ $class }}"> {{ $key }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-2 ">
                    <button type="submit" class="btn btn-primary mt-md-4">Promote</button>
                </div>
            </div>
        </form>
    </div>
@endsection
