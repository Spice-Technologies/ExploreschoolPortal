@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <div class="col-sm-6 mb-4 p-0">
            <h1>View Pin Stats</h1>
        </div>
        <div>
            <table id="myTable" class="table align-items-center table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="sort" data-sort="name"> School Name</th>
                        <th scope="col" class="sort" data-sort="budget">Session</th>
                        <th scope="col" class="sort" data-sort="status">Status</th>
                        <th scope="col">Download</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($pins as $pin)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <a href="#" class="avatar rounded-circle mr-3">
                                        <img alt="Image placeholder" src="../../assets/img/theme/bootstrap.jpg">
                                    </a>
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">{{ $pin->school->school }}</span>
                                    </div>
                                </div>
                            </th>
                            <td class="budget">
                                {{ $pin->session->session }}
                            </td>
                            <td>
                                <span class="name mb-0 text-sm">{{ $pin->generated == 1 ? 'Genereated' : 'Not Generated' }}</span>
                            </td>
                            <td>
                                <a href="{{route('pinDownload', $pin->id )}}">
                                    <button class="btn btn-secondary"> Download</button>
                                </a>
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
