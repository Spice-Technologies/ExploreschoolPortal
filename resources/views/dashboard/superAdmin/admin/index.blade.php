@extends('layouts.app')

@section('content')


    @if (session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text">{{ session('msg') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="table-responsive">
        <div>
            <table id="myTable" class="table align-items-center table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Name</th>
                        <th scope="col" class="sort" data-sort="budget">Contact</th>
                        <th scope="col" class="sort" data-sort="status">email</th>
                     
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($admins as $admin)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <a href="#" class="avatar rounded-circle mr-3">
                                        <img alt="Image placeholder" src="../../assets/img/theme/bootstrap.jpg">
                                    </a>
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">{{ $admin->user->name }}</span>
                                    </div>
                                </div>
                            </th>
                            <td class="budget">
                                {{ $admin->phone }}
                            </td>
                            <td>
                                {{ $admin->user->email }}
                            </td>
                            {{-- <td>
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-warning"></i>
                                    {{-- <a href=""> <span class="status">edit</span> </a> --}}
                              
                           
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
                    @endforeach
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
