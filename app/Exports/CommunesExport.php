<?php

namespace App\Exports;

use App\Models\Commune;
use Maatwebsite\Excel\Concerns\FromCollection;

class CommunesExport implements FromCollection
{

    public function collection()
    {
        // if (Auth()->user()->role == "admin_par_region") {
        //     return Commune::where('region', '=', Auth()->user()->region_user)->get();
        // } else {
        return Commune::all();
        // }
    }
}
