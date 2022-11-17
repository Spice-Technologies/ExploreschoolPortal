@extends('layouts.app')
@section('content')
    <div class="col-xl-10 order-xl-1 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                        @endif


                        @if (session('msg'))
                            <div class="alert alert-danger">{{ session('msg') }}</div>
                        @elseif(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <h3 class="mb-0">Settings: Adjust School Info </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Firstname</label>
                                    <input type="text" id="lname" value="{{ old('name') }}" name="name"
                                        class="form-control" placeholder="firstname">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Phone Number</label>
                                    <input type="text" id="input-email" value="{{ old('number') }}" name="number"
                                        class="form-control" placeholder="Enter phone number">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input"
                                                value="Female">Female
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input"
                                                value="Male">male
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!--Class details -->
                        <h3 class="heading-small text-muted mb-4">Assign Form Teacher to each class</h3>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="form-control-label" for="input-username">JSS 1</label>
                                <input type="text" id="lname" value="{{ old('jss1') }}" name="jss1"
                                    class="form-control" placeholder="jss 1 form teacher name ">
                            </div>
                            <div class="form-group col-lg-6">

                                <label class="form-control-label" for="input-username">JSS 2</label>
                                <input type="text" id="lname" value="{{ old('jss2') }}" name="jss2"
                                    class="form-control" placeholder="jss 2 form teacher name ">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="form-control-label" for="input-username">JSS 3</label>
                                <input type="text" id="lname" value="{{ old('jss3') }}" name="jss3"
                                    class="form-control" placeholder="jss 3 form teacher name ">
                            </div>
                            <div class="form-group col-lg-6">

                                <label class="form-control-label" for="input-username">SSS 1</label>
                                <input type="text" id="lname" value="{{ old('ss1') }}" name="ss1"
                                    class="form-control" placeholder="sss 1 form teacher name ">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="form-control-label" for="input-username">SSS 2</label>
                                <input type="text" id="lname" value="{{ old('ss2') }}" name="ss2"
                                    class="form-control" placeholder="sss 2 form teacher name ">
                            </div>
                            <div class="form-group col-lg-6">

                                <label class="form-control-label" for="input-username">SSS 3</label>
                                <input type="text" id="lname" value="{{ old('ss3') }}" name="ss3"
                                    class="form-control" placeholder="sss 3 form teacher name ">
                            </div>
                        </div>

                        <div class="">
                            <button class="btn btn-primary" type="submit">Submit </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
