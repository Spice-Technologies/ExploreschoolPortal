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
                <td> <?= $serialNo++ ?> </td>
                <td>{{ $result['RegNum'] }} </td>

                <?php
                // dd($results[1]['submenu']);
                $subs = array_keys($subjects);
                $p = 0;
                
                $rr = $result['submenu'];
                // dd($rr);
                ?>

                <?php
                
                $array1 = [1, 3, 4, 6, 8];
                $array2 = [1, 2, 3, 4, 8, 6, 7, 8, 9];
                
                // $a = [];
                
                // for ($i = 0; $i < count($array2); $i++) {
                //     if (isset($array1[$i]) && $array1[$i] == $array2[$i]) {
                //         $a[$i] = $i + 1 . ' same';
                //     } else {
                //         $a[$i] = $i + 1 . ' not the same';
                //     }
                // }
                
                // dd($a);
                
                //reverse engineering...another way of approaching a problem
                ///why not do it the other way round
                
                $a = [];
                $an = count($a);
                $rn = count($result['submenu']);
                $b = [];
                
                for ($i = 0; $i < count($subs); $i++) {
                    if (isset($rr[$i]['subject_id'])) {
                        array_push($a, $rr[$i]['subject_id']);
                    }
                }
                for ($i = 1; $i < count($subs); $i++) {
                    if (in_array($subs[$i], $a, true)) {
                        echo '<td>' . $subjects[$i] . '</td>';
                        //so pick the subject that matches from the list of subjects pulled from db and not the submenu array itself ..so we used the subject as the pointer
                        // $b[$i] = $j . ' same';
                    } else {
                        echo '<td> -- </td>';
                    }
                }
                
                // dd($b);
                
                // $subs = [1,2,3,4,5,6,7,8,9,10,11];
                // // dd($subs);
                
                // for ($i = 0; $i < 11; $i++) {
                //     if ($rr[$p]['subject_id'] == $subs[$i]) {
                //         echo '<td>' . $result['submenu'][$p]['subject'] . '</td>';
                //         $p++;
                //     } else {
                //         echo '<td> -- </td>';
                //     }
                // }
                
                //first i need to make sure that p starts from zero after completing its loop.
                
                // for ($i = 1; $i < 12; $i++) {
                //     // dd($result['submenu'][$p]['subject_id'] == $subs[$p]);
                //     if (dd(!isset($result['submenu'][2]['subject_id']) === true)) {
                //         echo '<td> -- </td>';
                //     }
                // if ($result['submenu'][$i]['subject_id'] ?? null === $subs[$i]) {
                //     //     if ($p <= $i) {
                //     echo '<td>' . $result['submenu'][$p]['subject'] . '</td>';
                //     $p++; //add to your checker
                //     // }
                // } else {
                //     echo '<td> -- </td>';
                //     $p++;
                //     // $p = $p + 0; //maintain your checker
                // }
                // }
                
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
