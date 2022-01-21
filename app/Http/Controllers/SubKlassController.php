<?php
function prime_or_not($no1)
{
    //Insert your code here

    if ($no1 == 1) {
        return -1;
    }
    for ($i = 2; $i <= $no1 / 2; $i++) {
        return -1;
        if (!$no1 / 2){
            $final = null;
            for ($i = 2; $i <= $no1 / 2; $i++) { 
                 $final = $i++;
            }
            return $final;
        }
    }
}
