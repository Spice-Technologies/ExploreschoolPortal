<?php function letterCounterCheck($string)
{
    return LetterCounter::CountLettersAsString($string);
}
// DO NOT MODIFY THE CODE ABOVE

class LetterCounter
{
    // Write your code here
    public static function CountLettersAsString($data)
    {
        $result = [];
        $data = strtolower($data);
        $data = preg_replace('/[^a-z]/', '', $data);
        $data = str_split($data);
        foreach ($data as $letter) {
            if (array_key_exists($letter, $result)) {
                $result[$letter]++;
            } else {
                $result[$letter] = 1;
            }
        }
        return $result;
    
        $textWithDup = str_split(strtolower($data));

        $unique = array_unique(str_split(strtolower($data)));

        // I want to return the duplictes only
        //lets add a something to all
        $dupes = array_values(array_diff_key($textWithDup, $unique));
        // now loop through the unique arrays, if anything in the dupes is same, add double start
        $result = [];
        $result =  array_map(function ($incoming) use ($dupes) {
            if (in_array($incoming, $dupes)) {
                return $incoming . ":**";
            } else {
                return  $incoming . ":*";
            }
        },  array_values($unique));
        return implode(',', $result);
    }

    //before you remove the duplicates, get the values that have duplicate first.
    //have another array with the unique values

    //then while you are converting the arrays to string using explode, if one of the matching items from the unduplicated array is matching the uniquvalues, add extra star to it 

    //

    // remove duplicate array 
}
