@extends('layouts.app')
@section('content')
    The upload functionality is not yet implemented.
    <form action="{{route('dashboard.admin.importPost')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="custom-file">
            <input type="file" name="file" class="custom-file-input" id="customFileLang" lang="en">
            <label class="custom-file-label" for="customFileLang">Select file</label>
        </div>
        <div class="text-left mt-4">
            <button type="submit" class="btn  btn-primary">Import</button>
        </div>
    </form>
@endsection
