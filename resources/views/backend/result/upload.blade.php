@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card p-4">
            <form action="{{ route('dashboard.admin.importPost') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="custom-file ">
                    <input type="file" name="file" class="custom-file-input" id="customFileLang" lang="en">
                    <label class="custom-file-label" for="customFileLang">Select file</label>
                </div>
                <div class="text-left mt-4">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
@endsection
