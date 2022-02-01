@extends('layouts.app')
@section('content')
    <div class="col-sm-6 p-0">
        <h1>Check Result</h1>
    </div>
    <div class="card col-6 mx-auto">
        <div class="card-body ">
            <h2> Enter Pin </h2>
            <form action="{{ route('result.store') }}" method="POST">
                @csrf
                <div class="pb-3">
                    <input type="text" name="pin" class="form-control form-control-alternative p-4"
                        placeholder="e.g 123456789">
                        <button type="submit" class="btn btn-primary mt-3">Check</button>
                </div>
            </form>
        </div>
    </div>
@endsection
