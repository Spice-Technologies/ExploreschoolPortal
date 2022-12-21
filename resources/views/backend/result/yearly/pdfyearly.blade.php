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
            <th colspan="2">Name: Chidiebere Chukwudi</th>
            <th>Age: 23</th>
            <th>Class: SS 1</th>
        </tr>
        <tr>
            <th>Number In Class: 34</th>

            <th>Admission No: 45 </th>
            <th>Term: 2nd Term</th>
            <th>Session: 2021/2022 </th>
        </tr>
        <tr>
            <th>Total Marks Obtainable: 3,600 </th>

            <th>Total Marks Obtained : 779</th>
            <th>Average: 33.5 </th>
            <th>Percentage: 47th </th>
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

            <?php $tableRow = [1, 2, 3]; ?>
            @foreach ($tableRow as $term => $value)
                <tr>
                    @foreach ($result as $term => $r)
                        @if (!str_starts_with($term, '__'))
                            @if (in_array($k, $tableRow))
                                <td colspan="4"> {{ $r[$k] }} </td>
                                <td> {{ 'hghgh' }} </td>
                            @else
                                <td> -- </td>
                            @endif
                        @endif

                    @endif
                    <?php dd($r); ?>
            @endforeach
            {{-- @if (!str_starts_with($term, '__'))
                        @foreach ($result as $k => $r)
                            @if (in_array($k, $tableRow))
                                <td colspan="4"> {{ $r[$k] }} </td>
                                <td> {{ 'hghgh' }} </td>
                            @else
                                <td> -- </td>
                            @endif
                        @endforeach
                    @endif --}}

            </tr>
            @endforeach
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
