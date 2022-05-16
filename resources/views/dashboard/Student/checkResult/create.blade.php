@extends('layouts.app')
@section('content')
    {{ \Session::get('pdfDown') }}

    <div class="col-sm-6 p-0">
        <h1>Check Result</h1>
    </div>
    <div class="card col-6 mx-auto">
        <div class="card-body ">
            <h2> Select School </h2>
            {{-- validation errors --}}
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif

            @if (session('msg'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
            @elseif(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('result.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <select class="form-control" name="term">
                        @foreach ($terms as $term)
                            <option value="{{ $term->id ?? '' }}">{{ $term->Term }}</option>
                        @endforeach
                    </select>
                </div>
                <h2> Enter Pin </h2>
                <div class="pb-3">
                    <input type="text" name="pin" class="form-control form-control-alternative p-4"
                        placeholder="e.g 123456789">
                    <button type="submit" class="btn btn-primary mt-3">Check</button>

                </div>
            </form>


            <!-- Button trigger modal -->

            @if (!empty(Session::get('results')))
                <script>
                    $(document).ready(function() {
                        $('#exampleModalCenter').modal('show');
                    });
                </script>
            @endif
            {{-- <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Launch demo modal
            </button> --}}

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Print Result</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
