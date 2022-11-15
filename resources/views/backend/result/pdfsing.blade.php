<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Single PDf</title>
    <style>
        

    </style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="row">
                    <div class="col-12 text-center">
                        <span class=" ">
                            <img alt="Image placeholder" src="">
                        </span>
                        <h4 class="box-title text-bold ">SCHOOL NAME </h4>
                        <h6> Address: no 2 gwalameji road, opp, fedral poly </h6>
                        <h6> Phone: 08203845153 </h6>
                        <h6> Email: jovialcore@gmail.com </h6>
                        <h5 class="box-title text-bold">ACADEMIC PERFORMANCE REPORT SHEET</h5>
                    </div>
                    <div class="col-12 justify-content-between mt-3">
                        <div class="row">
                            <div class="col-4">
                                <div><span class="text-bold">Name: </span> Chidiebere </div>

                            </div>
                            <div class="col-4">
                                <div><span class="text-bold">Admission No: </span> {{$student_info->reg_num}}  </div>

                            </div>
                            <div class="col-4">
                                <div><span style="font-weight: bold "> Other Stuff: </span> {{$student_info->user->name}}  </div>

                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4">
                                <div><span class="text-bold">Age: </span> 26 </div>

                            </div>
                            <div class="col-4">
                                <div><span class="text-bold">House: </span> house </div>

                            </div>
                            <div class="col-4">
                                <div><span style="font-weight: bold "> Class: </span> {{$student_info->class->class_name}}  </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <div><span class="text-bold">No In Class: </span> 25 </div>

                            </div>
                            <div class="col-4">
                                <div><span class="text-bold">Term: </span> {{$finaleSingleCourseResult[0]['term']['Term']}} </div>

                            </div>
                            <div class="col-4">
                                <div><span style="font-weight: bold "> Session: {{$finaleSingleCourseResult[0]['session']['session']}} </span>  </div>

                            </div>
                        </div>
                    </div>

                </div>

                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">Subjects</th>
                            <th scope="col">Total Assess.</th>
                            <th scope="col">Exam Score</th>
                            <th scope="col">Total Score</th>
                            <th scope="col">Class Average</th>
                            <th scope="col"> Position </th>
                            <th scope="col"> Grade </th>
                            <th scope="col"> Teacher Remark </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($finaleSingleCourseResult as $key => $singleClassResult)
                            {{-- @foreach ($singleClasses as $singleClasses)
                            @endforeach --}}
                            <tr>
                                <th scope="row">{{ $singleClassResult['subject'] }}</th>


                                {{-- @dump($wholeClass[0]['id']) --}}
                                <?php array_pop($finaleSingleCourseResult); //remove the last position ther ?>
                                <td> {{ $singleClassResult['assessment_total'] }}</td>
                                <td> {{ $singleClassResult['exam_score'] }}</td>
                                <td> {{ $singleClassResult['total_score'] }}</td>
                                <td> {{ $singleClassResult['avg'] }}</td>
                                <td> {{ $singleClassResult['position'] }}</td>
                                <td> {{ $singleClassResult['grade'] }}</td>
                                <td> {{ $singleClassResult['gradeRemark'] }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="box-footer text-sm my-3">
                    <ul class="list-unstyled">
                        <li><b>Form Teacher's Comment</b> &nbsp; A good performance and quite sastisfactory
                        </li>
                        <li><b>Name & Signature</b>
                            {{$student_info->class->teacher[0]->name}}</li><br>
                        <li><b>Remarks by Principal/Head</b> &nbsp; Satisfactory</li>
                        <li><b>Name & Signature</b> ENGR. PETER CHUKWUNEMEMMA </li><br>
                        <li><b>Resumption Date for 2nd Term:</b> 7th January 2021</li>
                        <li><b>Termly School Fees:</b>#10,000</li>
                    </ul>
                </div>
                <h6 class="pull-right">Date Printed:
                    <?php echo date('Y/m/d'); ?>
                </h6>
            </div>
        </div>
    </div>
</body>

</html>
