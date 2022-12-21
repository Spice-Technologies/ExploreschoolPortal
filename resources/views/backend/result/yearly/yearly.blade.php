@extends('layouts.app')
@section('content')
    <div class="col-sm-6 p-0">
        <h1>Check Result</h1>
    </div>
    <div class="card col-6 mx-auto">
        <div class="card-body ">

            {{-- <h2> Select School </h2> --}}
            {{-- validation errors --}}
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif

            @if (Session::has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text">{{ session('error') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('msg'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
            @elseif(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- <a href="{{ route('Sresult.index') }}"> Print Yearly Result </a> --}}
            <form action="{{ route('result.yearly.print') }}" method="POST">
                @csrf

                <h4> Select Session </h4>
                <div class="form-group">
                    <select class="form-control" name="session">
                        @foreach ($sessions as $session)
                            <option value="{{ $session->id }}">{{ $session->session }}</option>
                        @endforeach
                    </select>
                </div>

                <h4> Select Class </h4>
                <div class="form-group">
                    <select class="form-control" name="class">
                        @foreach ($klasses as $klass)
                            <option value="{{ $klass->id }}">{{ $klass->class_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="pb-3">
                    <h4> Select Student </h4>
                    <div class="form-group">
                        <select class="form-control" name="student">
                            @foreach ($students as $key => $student)
                                <option value="{{ $student->reg_num }}">
                                    ({{ $student->reg_num }})
                                    {{ $student->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Print Single Result</button>

                </div>
            </form>
        </div>
    </div>
@endsection
