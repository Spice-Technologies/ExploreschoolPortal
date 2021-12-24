@extends('layouts.app')
@section('content')

    <div class="col-xl-10 order-xl-1 mx-auto">
        <div class="card">

            <div class="card-body">
                <div class="col-sm-6 mb-5 p-0">
                    <h1>Register a School</h1>
                </div>

                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                <form method="POST" action="{{ route('school.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">School Name</label>
                                <input type="text" value="{{ old('name') }}"  name="school" class="form-control"
                                    placeholder="e.g example Academy ..." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Manager's Name</label>
                                <input type="name" id="input-email" value="{{ old('owner') }}" name="owner"
                                    class="form-control" placeholder="Input owners's name." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Email</label>
                                <input type="email" id="input-email" value="{{ old('email') }}" name="email"
                                    class="form-control" placeholder="Email..." disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Contact Address</label>
                                <input type="text" id="input-email" value="{{ old('address') }}" name="contact_addr"
                                    class="form-control" placeholder="e.g so so so street ..." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Phone Number</label>
                                <input type="text" name="phone" class="form-control"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    placeholder="Enter phone number ..." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">LGA</label>
                                <input type="text" name="lga" {{ old('lga') }} class="form-control" placeholder="Enter LGA..." disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">State</label>
                                <input type="text" id="input-email" value="{{ old('state') }}" name="state"
                                    class="form-control" placeholder="State...">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">School Website</label>
                                <input type="url" id="input-email" value="{{ old('website') }}" name="website"
                                    class="form-control" placeholder="optional..." disabled>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-primary" type="submit">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
