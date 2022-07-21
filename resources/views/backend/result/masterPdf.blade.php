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
                {{-- speccifiy the number of times the submenu will loop
                         to get the submenu no of times to iterate, we get the value of 
                         count or total number of items in the submenu array and assign it to a varibale and sa
                         if the submenuNoItems is less or equall to the number, so stuff 
                         if i is equal to submenu count, set submenu count back to zero and lets continue looping through again --}}


                <?php
                $submenIterator = 0;
                $submenuSubCount = count($result['submenu']);
                $subs = array_keys($subjects);
                ?>

                <?php
                for ($i = 1; $i < 11; $i++) {
                    if ($result['submenu'][$submenIterator]['subject_id'] == $subs[$i]) {
                        echo '<td>' . $subjects[$i] . '</td>';
                        if ($i <= $submenuSubCount) {
                            $submenIterator++;
                        } else {
                            $submenIterator = 0;
                        }
                    } else {
                        echo '<td> -- </td>';
                    }
                }
                
                ?>

            </tr>
        @endforeach

    </table>

</body>

</html>
