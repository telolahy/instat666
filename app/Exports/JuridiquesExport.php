<?php

namespace App\Exports;

use App\Models\Juridique;
use Maatwebsite\Excel\Concerns\FromCollection;

class JuridiquesExport implements FromCollection
{

    public function collection()
    {
        return Juridique::all();
    }
}
