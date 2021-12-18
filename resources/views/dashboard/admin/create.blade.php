@extends('layouts.app')
@section('content')

    <div class="col-xl-10 order-xl-1 mx-auto">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select School</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Rejoic Academy</option>
                            <option>Kingstone Academy</option>
                            <option>Bright Academy</option>
                            <option>Oceanic Int'l Schools</option>
                            <option>Riveere Academy</option>
                        </select>
                    </div>
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
                                <label class="form-control-label" for="input-email">Email</label>
                                <input type="email" id="input-email" value="{{ old('email') }}" name="lname"
                                    class="form-control" placeholder="Email...">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Phone Number</label>
                                <input type="Tel" id="input-email" value="{{ old('lname') }}" name="lname"
                                    class="form-control" placeholder="Enter Phone number...">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
