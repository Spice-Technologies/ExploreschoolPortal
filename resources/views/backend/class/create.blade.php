@extends('layouts.app')
@section('content')
    <div class="col-xl-10 order-xl-1 mx-auto">
        @if (session('msg'))
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text">{{ session('msg') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                        @endif

                        <h3 class="mb-0">Create Student Details </h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="#!" class="btn btn-sm btn-primary">Upload Excel File</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('class.store') }}" method="POST">
                    @csrf
                    <h6 class="heading-small text-muted mb-4">User information</h6>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="exampleFormControlSelect1">Select Class</label>
                            <select name="class_id" value="0" class="form-control" id="exampleFormControlSelect1">
                                @foreach ($classes as $class)
                                    <option value="{{$class->id}}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Sub-Class</label>
                                <input type="text" name="subclass" class="form-control" placeholder="e.g, 1A...">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Form Teacher Name</label>
                                <input type="text" name="f_teacher_name" class="form-control"
                                    placeholder="e.g, Mrs. Agnes">
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="exampleFormControlTextarea1">Class Description</label>
                            <textarea class="form-control" name="class_desc" id="exampleFormControlTextarea1" rows="2"></textarea>
                            {{-- <div class="form-group col-lg-4">
                                <label for="exampleFormControlSelect1">Asign Teacher</label>
                                <select name="class_id" value="1" class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>Primary Two</option>
                                    <option>Primary Three</option>
                                    <option>Primary Four</option>
                                    <option>Primary Five</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                    <hr class="my-4" />
                    <div class="">
                        <button class="btn btn-primary" type="submit">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
