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

            @if (session('msg'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
            @elseif(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('Mresult.store') }}" method="POST">
                @csrf
                <h4> Select Session </h4>
                <div class="form-group">
                    <select class="form-control" name="session">
                        @foreach ($sessions as $session)
                            <option value="{{ $session->id }}">{{ $session->session }}</option>
                        @endforeach
                    </select>
                </div>
                <h4> Select Term </h4>
                <div class="form-group">
                    <select class="form-control" name="term">
                        @foreach ($terms as $term)
                            <option value="{{ $term->id }}">{{ $term->Term }}</option>
                        @endforeach
                    </select>
                </div>

                <h4> Select Class </h4>
                <div class="form-group">
                    <select class="form-control" name="class_id">
                        @foreach ($klasses as $klass)
                            <option value="{{ $klass->id }}">{{ $klass->class_name }}</option>
                        @endforeach
                    </select>
                </div>
                <h4> Select Student </h4>
                <div class="form-group">
                    <select class="form-control" name="student_id">
                        @foreach ($klasses as $klass)
                            <option value="{{ $klass->id }}">{{ $klass->class_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pb-3">
                    <button type="submit" class="btn btn-primary mt-3">Print</button>

                </div>
            </form>
        </div>
    </div>
@endsection
