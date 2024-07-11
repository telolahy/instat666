<?php

namespace App\Exports;

use App\Models\Nationalite;
use Maatwebsite\Excel\Concerns\FromCollection;

class NationalitesExport implements FromCollection
{

    public function collection()
    {
        return Nationalite::all();
    }
}
