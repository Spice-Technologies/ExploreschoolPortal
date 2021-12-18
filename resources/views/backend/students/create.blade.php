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
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Firstname</label>
                                    <input type="text" id="lname" value="{{ old('name') }}" name="name"
                                        class="form-control" placeholder="firstname">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Last Name</label>
                                    <input type="text" id="input-email" value="{{ old('lname') }}" name="lname"
                                        class="form-control" placeholder="last name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Other Name</label>
                                    <input type="text" id="input-email" value="{{ old('lname') }}" name="lname"
                                        class="form-control" placeholder="last name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Date Of Birth</label>
                                    <input type="date" id="dateofbirth" value="{{ old('dateofbirth') }}"
                                        name="dateofbirth" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mt-lg-5">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="Male"> Male
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="Female">Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!--Class details -->
                        <h6 class="heading-small text-muted mb-4">Class details</h6>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="exampleFormControlSelect1">Asign Class</label>
                                <select name="class_id" value="1" class="form-control" id="exampleFormControlSelect1">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="exampleFormControlSelect1">Asign Sub Class</label>
                                <select name="Sub_Class_id" value="1" class="form-control" id="exampleFormControlSelect1">
                                    @foreach ($subclasses as $subclass)
                                        <option value="{{ $subclass->id }}">{{ $subclass->subKlass_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Contact information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Current Address</label>
                                        <input id="input-address" name="current_address" class="form-control"
                                            placeholder="Home Address"
                                            value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Permanent Address</label>
                                        <input id="input-address" name="permanent_address" class="form-control"
                                            placeholder="Home Address" value="amaudara umualumkau " type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">State of Origin </label>
                                        <input type="text" name="state" value="{{ old('state') }}" class="form-control"
                                            placeholder="Country">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">LGA</label>
                                        <input type="text" name="lga" value="{{ old('lga') }}" class="form-control"
                                            placeholder="LGA">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Country</label>
                                        <input type="text" name="country" value="{{ old('country') }}"
                                            class="form-control" placeholder="Postal code">
                                    </div>
                                </div>
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
