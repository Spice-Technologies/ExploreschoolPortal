@extends('layouts.app')
@section('content')

    <div class="col-xl-12 border-xl-1 mx-auto">
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
                <form action="{{ route('class.show') }}" method="GET" role="search">
                   
                    <h6 class="heading-small text-muted mb-4">User information</h6>

                    <div class="row">
                        <div class="form-group col-lg-5">
                            <label for="exampleFormControlSelect1">Select Class</label>
                            <select name="class_id" value="1" class="form-control" id="exampleFormControlSelect1">
                                {{-- @foreach ($classes as $class) --}}
                                <option value="2">2</option>
                                {{-- @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="exampleFormControlSelect1">Select Sub Class</label>
                            <select name="class_id" value="1" class="form-control" id="exampleFormControlSelect1">
                                {{-- @foreach ($classes as $class) --}}
                                <option value="2">2</option>
                                {{-- @endforeach --}}
                            </select>
                        </div>
                        <div class="col-2 ">
                            <button type="submit" class="btn btn-primary mt-md-4">Fetch Result</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div>
                            <table id="myTable" class="table align-items-center table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Project</th>
                                        <th scope="col" class="sort" data-sort="budget">Budget</th>
                                        <th scope="col" class="sort" data-sort="status">Status</th>
                                        <th scope="col">Users</th>
                                        <th scope="col" class="sort" data-sort="completion">Completion</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">

                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder" src="../../assets/img/theme/bootstrap.jpg">
                                                </a>
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">Argon Design System</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="budget">
                                            $2500 USD
                                        </td>
                                        <td>
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span class="status">pending</span>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                                                    data-original-title="Ryan Tompson">
                                                    <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg">
                                                </a>
                                                <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                                                    data-original-title="Romina Hadid">
                                                    <img alt="Image placeholder" src="../../assets/img/theme/team-2.jpg">
                                                </a>
                                                <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                                                    data-original-title="Alexander Smith">
                                                    <img alt="Image placeholder" src="../../assets/img/theme/team-3.jpg">
                                                </a>
                                                <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                                                    data-original-title="Jessica Doe">
                                                    <img alt="Image placeholder" src="../../assets/img/theme/team-4.jpg">
                                                </a>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="completion mr-2">60%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 60%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <hr class="my-4" />
                    <div class="">
                        <button class="btn btn-primary" type="submit">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
