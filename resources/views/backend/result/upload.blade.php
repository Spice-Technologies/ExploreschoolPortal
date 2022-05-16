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
            <form action="{{ route('dashboard.admin.importPost') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="custom-file ">
                    <input type="file" name="file" class="custom-file-input" id="customFileLang" lang="en">
                    <label class="custom-file-label" for="customFileLang">Select file</label>
                </div>
                <div class="text-left mt-4">
                    <button type="submit" class="btn btn-primary">Import Result</button>
                </div>
            </form>
        </div>
    </div>
@endsection
