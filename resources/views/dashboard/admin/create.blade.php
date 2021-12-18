@extends('layouts.app')
@section('content')

    <div class="col-xl-10 order-xl-1 mx-auto">
        <div class="card">

            <div class="card-body">
                <div class="col-sm-6 mb-5 p-0">
                    <h1>Add admin</h1>
                </div>

                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                <form method="POST" action="{{ route('dashboard.admin.post') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select School</label>
                        <select class="form-control" name="school_id">
                            @foreach ($schools as $school)
                                <option value="{{ $school->id}}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">Firstname</label>
                                <input type="text" id="lname" value="{{ old('name') }}" name="name" class="form-control"
                                    placeholder="firstname">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Email</label>
                                <input type="email" id="input-email" value="{{ old('email') }}" name="email"
                                    class="form-control" placeholder="Email...">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Phone Number</label>
                                <input type="text" name="phone" class="form-control"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    placeholder="Enter phone number ..." />
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
