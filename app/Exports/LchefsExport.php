<?php

namespace App\Exports;

use App\Models\Lchef;
use Maatwebsite\Excel\Concerns\FromCollection;

class LchefsExport implements FromCollection
{

    public function collection()
    {
        return Lchef::all();
    }
}
