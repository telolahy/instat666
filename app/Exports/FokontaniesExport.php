<?php

namespace App\Exports;

use App\Models\Fokontany;
use Maatwebsite\Excel\Concerns\FromCollection;

class FokontaniesExport implements FromCollection
{

    public function collection()
    {
        return Fokontany::all();
    }
}
