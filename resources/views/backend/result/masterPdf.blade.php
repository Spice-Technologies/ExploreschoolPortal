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
                
                $subs = array_keys($subjects); // get the subjects Array keys  instead of values
                $rr = $result['submenu']; // submenu array that contains the subjects details(subject id, etc)
                
                $subsCount = count($subs);
                //reverse engineering...another way of approaching a problem
                ///why not do it the other way round
                
                /* WAAAAAAIIIIITTTTT ::: It took me roughly 5 DAYS to arrive at this code below that rightly displays the student who took a subject and the one that didn't take the subject. It's simple right ? Lol but the head turns and all ... 
                                                                                                                
                the stackoverflow answer that sparked my approach.... I helped me think of my approach in a reversed direction ....pheeeew!!!
                https://stackoverflow.com/a/40562725/14669082
                                                                                                                
                                                                                                                */
                
                $arrPicker = []; //the array holder or picker to have subjects ids so that we can use it with in_array() function to check if any Main subjects ids(subs[x]) is in it(arrPicker)
                for ($i = 0; $i < $subsCount; $i++) {
                    if (isset($rr[$i]['subject_id'])) {
                        array_push($arrPicker, $rr[$i]['subject_id']);
                    }
                }
                for ($i = 1; $i < $subsCount; $i++) {
                    if (in_array($subs[$i], $arrPicker, true)) {
                        foreach ($rr as $g) {
                            if ($g['subject_id'] == $subs[$i]) {
                                echo '<td>' . $g['subject'] . '</td>';
                                break;
                            }
                        }
                
                        //so pick the subject that matches from the list of subjects pulled from db and not the submenu array itself ..so we used the subject as the pointer
                        // $b[$i] = $j . ' same';
                    } else {
                        echo '<td> -- </td>';
                    }
                }
                
                /*What this code is simply doing is that*/
                
                ?>

            </tr>
        @endforeach

    </table>

</body>

</html>
