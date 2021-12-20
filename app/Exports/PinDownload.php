<?php

namespace App\Exports;

use App\Models\Pin;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class PinDownload implements FromQuery
{
    use Exportable;

    public function __construct($school,  $session,  $generated)
    {
        $this->school_id = $school;
        $this->session_id = $session;
        $this->generated = $generated;
    }

    public function query()
    {
        return Pin::query()->where('school_id', $this->school_id)
                            ->where('session_id', $this->session_id)
                            ->where('generated', $this->generated)
                            ->first();
    }
}