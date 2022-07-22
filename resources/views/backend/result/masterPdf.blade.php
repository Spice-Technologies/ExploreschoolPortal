<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <h1>A Fancy Table</h1>

    <table id="customers">


        <?php
        
        $listOfSubjects = $subjects;
        ?>

        <tr>
            <th>S/N</th>
            <th>RegNum</th>
            {{-- array splice is removing 'Dont start counting @ zero' so subjects listed here can be only subjects --}}
            @foreach (array_splice($listOfSubjects, 1) as $subject)
                <th>{{ $subject }}</th>
            @endforeach
        </tr>
        <?php $serialNo = 1; ?>

        @foreach ($results as $key => $result)
            <tr>
                <td><?= $serialNo++ ?> </td>
                <td>{{ $result['RegNum'] }} </td>

                <?php
                $submenIterator = 0;
                $submenuSubCount = 7;
                $subs = array_keys($subjects);
                $p = 0;
                ?>

                <?php
                for ($i = 1; $i < 12; $i++) {
                    if ($result['submenu'][$p]['subject_id'] == $subs[$i]) {
                        if ($p <= $i) {
                            echo '<td>' . $result['submenu'][$p]['subject']  . '</td>';
                            $p++;
                        }
                    } else {
                        echo '<td> -- </td>';
                    }
                }
                
                // if ($result['submenu'][$submenIterator]['subject_id'] == $subs[$i]) {
                //     echo '<td>' . $result['submenu'][$submenIterator]['subject']  . '</td>';
                //     if ($i <= $submenuSubCount) {
                //         $submenIterator++;
                //     } else {
                //         $submenIterator = 0;
                //     }
                // } else {
                //     echo '<td> -- </td>';
                // }
                
                ?>

            </tr>
        @endforeach

    </table>

</body>

</html>
