<?php

namespace App\Exports;

use App\Models\Proprietaire;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProprietairesExport implements FromCollection
{

    public function collection() 
    {
        return Proprietaire::all();
    }
}
