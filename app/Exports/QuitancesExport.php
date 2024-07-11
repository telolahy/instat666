<?php

namespace App\Exports;

use App\Models\Quitance;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuitancesExport implements FromCollection
{

    public function collection()
    {
        return Quitance::all();
    }
}
