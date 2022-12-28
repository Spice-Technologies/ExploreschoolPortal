<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Yearly Student Report Card </title>
    <h2> Student Report Card </h2>

    <style>
        html {
            font-family: arial;
            font-size: 18px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #2e2e2e;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th colspan="2">Name:  {{$name}}</th>
            <th>Age: --</th>
            <th>Class: {{$class}}</th>
        </tr>
        <tr>
            <th colspan="2">Number In Class: {{$result['__totalNoInClass']}}</th>

            <th>Admission No: {{$studentReg}} </th>
            
            <th>Session: {{$session}}</th>
        </tr>
        <tr>
            <th>Total Marks Obtainable: 3,600 </th>

            <th>Total Marks Obtained :  {{ $result['__totalmain']}}</th>
            <th>Average:  {{ $result['__totalAvg']}} </th>
            <th>Percentage: {{$result['__position']}} </th>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <td colspan="4"> Subject </td>
                <td colspan=""> First Term Score </td>
                <td colspan=""> 2nd Term Score </td>
                <td colspan=""> 3rd term Score </td>
                <td colspan=""> Total Score </td>
                <td colspan=""> Average Score </td>
                <td colspan=""> Grade </td>
                <td colspan=""> Teacher's Remark </td>
            </tr>
        </thead>
        <tbody>

            <?php
            $tableRow = [1, 2, 3];
            ?>
            @foreach ($subs as $skey => $sub)
                <tr>
                    <td colspan="4"> {{ $sub }}</td>

                    @foreach ($tableRow as $f => $v)
                        @if (isset($result[$v][$sub]))
                            <td> {{ $result[$v][$sub]['total'] }}</td>
                        @else
                            <td> {{ '--' }}</td>
                        @endif
                    @endforeach

                    <td> {{ $result['__subjectTotals'][$sub]['total'] }}</td>
                    <td> {{ $result['__subjectTotals'][$sub]['avg'] }}</td>
                    <td> {{ $result['__subjectTotals'][$sub]['grade'] }}</td>
                    <td> {{ $result['__subjectTotals'][$sub]['gradeRemark'] }}</td>
            @endforeach

            </tr>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="footer">Form Teacher's Comment: </td>
                <td colspan="5" class="footer">Name and Signature: </td>
            </tr>
            <tr>
                <td colspan="7" class="footer">Principal: </td>
                <td colspan="5" class="footer">Name and Signature: </td>
            </tr>
            <tr>
                <td colspan="12" class="footer">Resumption Date:</td>
            </tr>
    </table>
</body>
