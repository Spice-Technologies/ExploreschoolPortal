@extends('layouts.app')
@section('content')
    {{-- <div class="col-lg-8 mx-auto"> 
        <form>
            <div class="form-group">
                <label for="exampleFormControlInput1">First Name</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Last Name</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Middle name</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </form>
    </div> --}}

    <div class="col-xl-10 order-xl-1 mx-auto">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Class</label>
                                <input type="text" name="class" class="form-control" placeholder="e.g JSS...">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Sub-Class</label>
                                <input type="text" name="subclass" class="form-control" placeholder="e.g, 1A...">
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
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
