@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <div>
            <table id="myTable" class="table align-items-center table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Name</th>
                        <th scope="col" class="sort" data-sort="budget">Reg Number</th>
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
                                    <span class="name mb-0 text-sm">fjjg</span>
                                </div>
                            </div>
                        </th>
                        <td class="budget">
                            bugehe
                        </td>
                        <td>
                            <span class="badge badge-dot mr-4">
                                <i class="bg-warning"></i>
                                <a href=""> <span class="status">edit</span> </a>
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
                                    <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-4.jpg') }}">
                                </a>
                            </div>

                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="completio mr-2">fkfkkf</span>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
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
@endsection


{{-- things to do for the admin 
    --the sidebar menu will be different and it is included.
    -- so we differentiate students and admins base on their roles to accertain what they see but they all access the same page.
    -- for the superAdmin, the pages are seperated --}}
