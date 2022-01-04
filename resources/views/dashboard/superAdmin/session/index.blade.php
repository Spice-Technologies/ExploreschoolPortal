@extends('layouts.app')

@section('content')
<div style="width: 18rem;">
    <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Session</h5>
                    <span class="h2 font-weight-bold mb-0">{{$session->session ?? 'There are no session yet. Pls add'}}</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                    </div>
                </div>
            </div>
            <p class="mt-3 mb-0 text-sm">
               <a href="{{route('session.create')}}"> <span class="text-primary mr-2">Is this the current session <i class="fa fa-question text-danger"></i>  </span>
                <span class="text-nowrap"></span>
            </p>

        </div>
    </div>
</div>
@endsection