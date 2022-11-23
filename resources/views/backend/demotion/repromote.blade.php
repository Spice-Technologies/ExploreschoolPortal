@extends('layouts.app')
@section('content')
<div class="col-xl-12 border-xl-1 mx-auto">
    @if (session('msg'))
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text">{{ session('msg') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif

                    <h3 class="mb-0">Search class </h3>
                </div>

            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('demote.action') }}" method="POST" role="Demote">
                @csrf


                <div class="row mb-4">

                    <div class="col-5 mx-auto">

                        <button type="submit" class="btn btn-success mt-md-4" style="width: inherit;">Repromote Selected Students</button>
                        <input type="hidden" name="repromote" value="repromote">

                    </div>
                </div>
                <div class="table-responsive">
                    <div>
                        <table id="myTable" class="table align-items-center table-dark">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="budget">Reg Number</th>
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                 
                                    <th scope="col" class="sort" data-sort="completion">Class</th>
                                   

                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">


                                @foreach ($studentsClass as $studentClass)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <label class="custom-toggle mr-4">
                                                <input type="checkbox" name="chekId[]" value="{{ $studentClass->id }}">
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="" data-label-on=""></span>
                                            </label>
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $studentClass->user->name ?? '' }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget">
                                        {{ $studentClass->reg_num }}
                                    </td>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <i class="bg-warning"></i>
                                            <a href="{{ route('student.edit', $studentClass->id) }}"> <span class="status">edit</span> </a>
                                        </span>
                                    </td>
                                   
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="completio mr-2">{{ $studentClass->class->class_name ?? 'Graduated' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </form>
            <hr class="my-4" />
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection