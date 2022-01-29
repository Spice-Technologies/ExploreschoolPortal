<?php

namespace App\Exports;

use App\Models\Pin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PinDownload implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($pin, $school)

    {
        $this->pinToFormat = $pin;
        $this->school = $school;
    }

    public function collection()
    {
        return collect([
            array_chunk($this->pinToFormat, 1)

        ]);
    }

    public function headings(): array
    {
        return [
            'Pins for School: ' . $this->school,
        ];
    }

    /*
     How I achievevd this:
     The thing I wanted to do is :
     1. Get only a column from the row (which in my case is pins. This was done in the Pincontroller)
     2. take the pins row gotten and pass it down to this classa as $pin ( Refer to https://laraveldaily.com/laravel-excel-3-0-export-custom-array-excel/ to understand better)
     3. Then decode it to convert the stored json to array, then return it as a collection
        
        if I stopped at no 3, the values will be in one row in the downloaded spreadshit, which is not what I want to achieve, so I achieve that in no 4!
     To do

     4. I want to be able to return the collection in one single row 
            Yes....I achieved that using the array_chunk,specifying the starting point from 1
    5. Finally, I added a the heading, Pins  
     */
}
