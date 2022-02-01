@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text">{{ session('msg') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card  ">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                        @endif

                        <h3 class="mb-0">Print Master Result </h3>
                    </div>

                </div>
            </div>
            <form action="{{ route('result.masterPdfGen') }}" method="GET" role="search">
                <div class="row mx-auto p-4">
                    <div class="form-group col-lg-6">
                        <label for="exampleFormControlSelect1">Select Class</label>
                        <select name="klass_id" value="0" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="exampleFormControlSelect1">Select SubClass</label>
                        <select name="sub_id" value="0" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($classes as $class)
                                <option value="1">A</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="exampleFormControlSelect1">Select term</label>
                        <select name="term_id" value="0" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($terms as $term)
                                <option value="{{ $term->id }}">{{ $term->Term }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="exampleFormControlSelect1">Select Session</label>
                        <select name="session_id" value="0" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($sessions as $session)
                                <option value="{{ $session->id }}">{{ $session->session }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 ">
                        <button type="submit" class="btn btn-primary mt-md-4">Fetch Result</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Download Master sheet </h3>
            </div>
            <div class="row p-4 d-flex justify-content-between w-100">
                <div class="col-md-10   col-4">
                    <button class="btn btn-light  ">exploreJssOneClass.pdf </button>
                </div>
            </div>
        </div>
    </div>
@endsection
