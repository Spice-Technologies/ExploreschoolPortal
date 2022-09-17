<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Single PDf</title>
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
                                <div><span class="text-bold">Admission No: </span> Chidiebere </div>

                            </div>
                            <div class="col-4">
                                <div><span style="font-weight: bold "> Other Stuff: </span> Chidiebere </div>

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
                                <div><span style="font-weight: bold "> Class: </span> JSS1A </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <div><span class="text-bold">No In Class: </span> 25 </div>

                            </div>
                            <div class="col-4">
                                <div><span class="text-bold">Term: </span> 1st Term </div>

                            </div>
                            <div class="col-4">
                                <div><span style="font-weight: bold "> Session: </span> 2021 </div>

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

                        @foreach ($fetchStudents as $studentResult)
                            <tr>
                                {{-- there is a bug here/ fix --}}
                                <th scope="row">{{ $studentResult->subject }}</th>
                                <td> {{ $studentResult->assessment_total }}</td>
                                <td> {{ $studentResult->exam_score }}</td>
                                <td> {{ $studentResult->total_score }}</td>
                                <td> {{ $studentResult->total_score / count($fetchStudents) }} </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="box-footer text-sm my-3">
                    <ul class="list-unstyled">
                        <li><b>Form Teacher's Comment</b> &nbsp; A good performance and quite sastisfactory
                        </li>
                        <li><b>Name & Signature</b>
                            TEacher name </li><br>
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





    <!-- <div class="col p-0">
        <h1>Check Result</h1>
    </div>
    <div class="card col-6 mx-auto">
        <div class="card-body ">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center">
                        <span class="avatar avatar-lg rounded-circle ">
                            <img alt="Image placeholder"
                                src="https://cdn.pixabay.com/photo/2013/10/31/14/09/phone-booth-203492_960_720.jpg">
                        </span>
                        <h3 class="box-title text-bold ">SCHOOL NAME </h3>
                        <h5> Address: no 2 gwalameji road, opp, fedral poly </h5>
                        <h5> Phone: 08203845153 </h5>
                        <h5> Email: jovialcore@gmail.com </h5>
                        <h3 class="box-title text-bold">ACADEMIC PERFORMANCE REPORT SHEET</h3>
                    </div>
                </div>
            </div>
            <table class="table">

                <thead>
                    <tr class="thead">
                        <th>NAME: </th>
                        <td class="pull-lef">Chidiebere</td>
                        <th>ADMISSION NO.</th>
                        <td class="pull-left"> mob/14/23256 </td>
                    </tr>
                    <tr class="thead">
                        <th>Age: </th>
                        <td class="text-bold">40 years</td>
                        <th>House</th>
                        <td class="text-bold"> <?php echo ''; ?></td>
                        <th>Class</th>
                        <td class="text-bold">Jss 1A</td>
                    </tr>
                    <tr class="thead">
                        <th>No. in Class </th>
                        <td class="text-bold">124</td>
                        <th>Term</th>
                        <td class="text-bold"> First</td>
                        <th>Session</th>
                        <td>2020/2021</td>
                    </tr>
                </thead>

            </table>

            <div class='text-center text-sm my-3'>
                A(Distinction)70% & above &nbsp;
                C(Credit)55-69% &nbsp;
                P(Pass)45-54% &nbsp;
                F(Fail)Below 45% &nbsp;
            </div>
            <div class="">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
                <div class="box-footer text-sm my-3">
                    <ul class="list-unstyled">
                        <li><b>Form Teacher's Comment</b> &nbsp; A good performance and quite sastisfactory
                        </li>
                        <li><b>Name & Signature</b>
                            TEacher name </li><br>
                        <li><b>Remarks by Principal/Head</b> &nbsp; Satisfactory</li>
                        <li><b>Name & Signature</b> ENGR. PETER CHUKWUNEMEMMA </li><br>
                        <li><b>Resumption Date for 2nd Term:</b> 7th January 2021</li>
                        <li><b>Termly School Fees:</b>#10,000</li>
                    </ul>
                </div>
                <h6 class="pull-right">Date Printed: <?php echo date('Y/m/d'); ?></h6>
            </div>

        </div>
    </div>
</body> -->
</body>

</html>
