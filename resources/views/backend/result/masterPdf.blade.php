<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h2>Bordered Table</h2>
        <p>The .table-bordered class adds borders to a table:</p>
        <div width="100%">
            <div class="modal-body">
                {{-- @if (Session::get('results'))
                    @foreach (Session::get('results') as $result)
                        {{ $result->subjectModel->subject }}
                    @endforeach
                @endif --}}
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center">
                            <span class="avatar avatar-lg rounded-circle ">
                                <img alt="Image placeholder"
                                    src="{{ asset('/assets/img/theme/team-4.jpg') }}">
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
                <div class="box-body no-padding">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Subjects </th>
                                <th>Total Assess.</th>
                                <th>Exam Score</th>
                                <th>Total Score</th>
                                <th>Class Average</th>
                                <th>Position</th>
                                <td>
                                    <b>Grade</b>
                                </td>
                                <th>Teacher's Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>English </td>
                                <td> 50</td>
                                <td>30</td>
                                <td>90</td>
                                <td>56</td>
                                <td>45<sup>chevkSup</sup></td>
                                <td>123</td>
                                <td>334</td>
                            </tr>
                            <tr>
                                <td>English </td>
                                <td> 50</td>
                                <td>30</td>
                                <td>90</td>
                                <td>56</td>
                                <td>45<sup>chevkSup</sup></td>
                                <td>123</td>
                                <td>334</td>
                            </tr>
                            <tr>
                                <td>English </td>
                                <td> 50</td>
                                <td>30</td>
                                <td>90</td>
                                <td>56</td>
                                <td>45<sup>chevkSup</sup></td>
                                <td>123</td>
                                <td>334</td>
                            </tr>
                            <tr>
                                <td>English </td>
                                <td> 50</td>
                                <td>30</td>
                                <td>90</td>
                                <td>56</td>
                                <td>45<sup>chevkSup</sup></td>
                                <td>123</td>
                                <td>334</td>
                            </tr>
                            <tr>
                                <td>English </td>
                                <td> 50</td>
                                <td>30</td>
                                <td>90</td>
                                <td>56</td>
                                <td>45<sup>chevkSup</sup></td>
                                <td>123</td>
                                <td>334</td>
                            </tr>
                        
                            <?php
                            
                            ?>
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
</body>

</html>
