@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text">{{ session('msg') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card p-4">
            <form action="{{ route('student.add.csv') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <span class="text-danger font-italic ">Very Important. Click here to see CSV format you will be importing.
                </span>
                write code to activate import button once the user has clicked on it 
                <div class="custom-file mt-5">
                    <input type="file" name="file" class="custom-file-input" id="customFileLang" lang="en"
                        required>
                    <label class="custom-file-label" for="customFileLang">Select file</label>
                </div>
                <div class="text-left mt-4">
                    <button type="submit" class="btn btn-primary">Import Result</button>
                </div>
            </form>
        </div>
    </div>
@endsection
