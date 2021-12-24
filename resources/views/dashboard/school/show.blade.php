@extends('layouts.app')
@section('content')

    <div class="col-xl-10 order-xl-1 mx-auto">
        <div class="card">

            <div class="card-body">
                <div class="col-sm-6 mb-5 p-0">
                    <h1>View School Details</h1>
                </div>
                <form method="POST" action="{{ route('school.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">School Name</label>
                                <input type="text" value="{{ $school->school }}" name="school" class="form-control"
                                    placeholder="e.g example Academy ..." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Manager's Name</label>
                                <input type="name" id="input-email" value="{{ $school->owner }}" name="owner"
                                    class="form-control" placeholder="Input owners's name." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Email</label>
                                <input type="email" id="input-email" value="{{ $school->email }}" name="email"
                                    class="form-control" placeholder="Email..." disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Contact Address</label>
                                <input type="text" id="input-email" value="{{ $school->contact_addr }}" name="contact_addr"
                                    class="form-control" placeholder="e.g so so so street ..." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ $school->phone }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">LGA</label>
                                <input type="text" name="lga" value="{{ $school->lga }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">State</label>
                                <input type="text" id="input-email" value="{{ $school->state }}" name="state"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">School Website</label>
                                <input type="url" id="input-email" value="{{ $school->website ?? 'null' }}" name="website"
                                    class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </form>
                
                <div class="col-sm-6 mb-2 mt-3 p-0">
                    <h1><span class="text-warning">{{$school->school}}</span> admin Details </h1>
                </div>
                <form method="POST" action="{{ route('school.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">Admin</label>
                                <input type="text" value="{{ $admin->user->name }}" name="school" class="form-control"
                                    placeholder="e.g example Academy ..." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Email</label>
                                <input type="name" id="input-email" value="{{ $admin->user->email }}" name="owner"
                                    class="form-control" placeholder="Input owners's name." disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Phone Number</label>
                                <input type="email" id="input-email" value="{{ $admin->phone }}" name="email"
                                    class="form-control" placeholder="Email..." disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Contact Address</label>
                                <input type="text" id="input-email" value="{{$Adminpass}}" name="contact_addr"
                                    class="form-control" placeholder="e.g so so so street ..." disabled>
                            </div>
                        </div> --}}
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ $school->phone }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">LGA</label>
                                <input type="text" name="lga" value="{{ $school->lga }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>

                </form>
        </div>
    </div>
@endsection
