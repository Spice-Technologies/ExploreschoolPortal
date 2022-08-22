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
        <div class="card p-4">
            <form action="{{ route('dashboard.admin.importPost') }}" method="POST" enctype="multipart/form-data">
                @csrf
              
                    <span class="text-danger font-italic ">kindly note that you will need to <span
                            class="font-bold">select</span> the <span class="font-bold"> right class</span> and term for
                        this </span>

                    <br>
                    <br>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="exampleFormControlSelect1" class="font-weight-bold"><span
                                    class="text-danger">*</span> Select Class</label>
                            <select name="class_id"  class="form-control" id="exampleFormControlSelect1">
                                @foreach ($klasses as $klass)
                                    <option value="{{ $klass->id }}">{{ $klass->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleFormControlSelect1" class="font-weight-bold"> <span
                                    class="text-danger">*</span> Select Term</label>
                            <select name="term_id"  class="form-control" id="exampleFormControlSelect1">
                                @foreach ($terms as $term)
                                    <option value=" {{$term->id}}"> {{ $term->Term }} </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleFormControlSelect1" class="font-weight-bold"> <span
                                    class="text-danger">*</span> Select Session</label>
                            <select name="session_id" class="form-control" id="exampleFormControlSelect1">
                                @foreach ($sessions as $session)
                                    <option value="{{ $session->id }}"> {{ $session->session }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
            
                <div class="custom-file ">
                    <input type="file" name="file" class="custom-file-input" id="customFileLang" lang="en">
                    <label class="custom-file-label" for="customFileLang">Select file</label>
                </div>
                <div class="text-left mt-4">
                    <button type="submit" class="btn btn-primary">Import Result</button>
                </div>
            </form>
        </div>
    </div>
@endsection
