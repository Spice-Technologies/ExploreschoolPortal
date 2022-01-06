@extends('layouts.app')
@section('content')

    <div class="col-xl-10 order-xl-1 mx-auto">
        <div class="card">

            <div class="card-body">
                <div class="col-sm-6 mb-2 p-0">
                    <h1>Enter Session </h1>
                </div>
                {{-- validation errors --}}
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif


                {{-- notificaitons --}}

                @if (session('msg'))
                    <div class="alert alert-danger">{{ session('msg') }}</div>
                @endif
                <form method="POST" action="{{ route('session.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Session</label>
                            
                                <input type="text" name="session" value="" class="form-control"
                                    placeholder="Enter session..." />
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
