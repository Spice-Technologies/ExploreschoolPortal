@extends('layouts.app')
@section('content')
    <div class="card col-12 mx-auto">
        <div class="card-body ">

            {{-- <div class="row">
                <div class="col-6 mx-auto" style="font-weight: bold; border:3px solid rd;"> 
                    <span class="display-4" style="text-align: center"> {{$fetchResult->school->school}}</span> 
                    <br>
                   <span class="text-center"> Addr:   (  {{$fetchResult->school->contact_addr}} ). </span>
                  

                   <span class="text-center"> Tel: {{$fetchResult->school->phone}}. Email {{$fetchResult->school->email}} @if ($fetchResult->school->website)  :  ,website . {{$fetchResult->school->website}}  ? '' @endif   </span>
                 </div>

             </div> --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Subjects </th>
                        <th scope="col">Total Assess</th>
                        <th scope="col">Exam Score</th>
                        <th scope="col">Total Score</th>
                        <th scope="col">Class Average </th>
                        <th scope="col">Position</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Teacher's Remark</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fetchResults as $fetchResult)
                        <tr>
                            <th scope="row">{{ $fetchResult->subjectModel->subject }}</th>
                            <td>{{ $fetchResult->assessment_total }}</td>
                            <td>{{ $fetchResult->exam_score }}</td>
                            <td>{{ $fetchResult->total_score }}</td>
                            <td>{{ $fetchResult->avg('total_score') }}</td>
                            <td>@mdo</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
