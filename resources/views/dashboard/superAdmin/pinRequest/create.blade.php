@extends('layouts.app')
@section('content')

    <div class="col-xl-10 order-xl-1 mx-auto">
        <div class="card">

            <div class="card-body">
                <div class="col-sm-6 mb-5 p-0">
                    <h1>Generate Pin</h1>
                </div>
                {{-- validation errors --}}
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif


                {{-- notificaitons --}}

                @if (session('msg'))
                    <div class="alert alert-danger">{{ session('msg') }}</div>
                @endif
                <form method="POST" action="{{ route('pin.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select School</label>
                                <select class="form-control" name="school">
                                    @foreach ($schools as $school)
                                        <option value="{{ $school->id  ?? ''}}">{{ $school->school }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Total Pins</label>
                                <input type="number" id="input-email" name="pins"
                                    class="form-control" placeholder="Enter the no of pins">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Session</label>
                                <input type="hidden" name="session" value="{{ $session->id ?? '' }}" id="">
                                <input type="text" value="{{ $session->session ?? ''}}" class="form-control"
                                    placeholder="Enter pin..."  disabled/>
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
