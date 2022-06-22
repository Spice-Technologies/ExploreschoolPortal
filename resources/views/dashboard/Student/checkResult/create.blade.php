@extends('layouts.app')
@section('content')
    {{ \Session::get('pdfDown') }}

    <div class="col-sm-6 p-0">
        <h1>Check Result</h1>
    </div>
    <div class="card col-6 mx-auto">
        <div class="card-body ">

            {{-- <h2> Select School </h2> --}}
            {{-- validation errors --}}
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif

            @if (session('msg'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
            @elseif(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('result.store') }}" method="POST">
                @csrf
                <h4> Select Session </h4>
                <div class="form-group">
                    <select class="form-control" name="session">
                        @foreach ($sessions as $session)
                            <option value="{{ $session->id }}">{{ $session->session }}</option>
                        @endforeach
                    </select>
                </div>
                <h4> Select Term </h4>
                <div class="form-group">
                    <select class="form-control" name="term">
                        @foreach ($terms as $term)
                            <option value="{{ $term->id }}">{{ $term->Term }}</option>
                        @endforeach
                    </select>
                </div>

                <h4> Select Class </h4>
                <div class="form-group">
                    <select class="form-control" name="class_id">
                        @foreach ($klasses as $klass)
                            <option value="{{ $klass->id }}">{{ $klass->class_name }}</option>
                        @endforeach
                    </select>
                </div>
                <h2> Enter Pin </h2>
                <div class="pb-3">
                    <input type="text" name="pin" class="form-control form-control-alternative p-4"
                        placeholder="e.g 123456789">
                    <button type="submit" class="btn btn-primary mt-3">Check</button>

                </div>
            </form>
            <!-- Modal -->
            <div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog  modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Print Result</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="resultStuff">
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
                                            <td>45</td>
                                            <td>123</td>
                                            <td>334</td>
                                        </tr>
                                        <tr>
                                            <td>English </td>
                                            <td> 50</td>
                                            <td>30</td>
                                            <td>90</td>
                                            <td>56</td>
                                            <td>45</td>
                                            <td>123</td>
                                            <td>334</td>
                                        </tr>
                                        <tr>
                                            <td>English </td>
                                            <td> 50</td>
                                            <td>30</td>
                                            <td>90</td>
                                            <td>56</td>
                                            <td>45</td>
                                            <td>123</td>
                                            <td>334</td>
                                        </tr>
                                        <tr>
                                            <td>English </td>
                                            <td> 50</td>
                                            <td>30</td>
                                            <td>90</td>
                                            <td>56</td>
                                            <td>45</td>
                                            <td>123</td>
                                            <td>334</td>
                                        </tr>
                                        <tr>
                                            <td>English </td>
                                            <td> 50</td>
                                            <td>30</td>
                                            <td>90</td>
                                            <td>56</td>
                                            <td>45</td>
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
                        <div class="modal-footer">
                            {{-- <button type="button" id= ""class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                            {{-- <a href="javascript:html2pdf()">Download File As PDF</a> --}}

                            <button type="button" id="downloadPdf" class="btn btn-primary">Print Result</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!empty(Session::get('results')))
        <script type="text/javascript">
            $(document).ready(function() {

                $('#exampleModalCenter').modal('show');
                $('#downloadPdf').click(function() {
                    var opt = {
                        margin: 1,
                        filename: 'TestwithImage.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        },
                        html2canvas: {
                            dpi: 192,
                            letterRendering: true,
                            useCORS: true
                        },
                        // jsPDF: {
                        //     unit: 'in',
                        //     format: 'A4',
                        //     orientation: 'portrait'
                        // }
                    };
                    var element = document.getElementById('resultStuff');
                    var worker = html2pdf().set(opt).from(element).save();
                    html2pdf(worker);
                });

            })
        </script>
    @endif
@endsection
