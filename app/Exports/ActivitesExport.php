<?php

namespace App\Exports;

use App\Models\Activite;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;    

class ActivitesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Activite::all();
    }
    // public function headings(): array
    // {
    //     return [
    //         '#',
    //         'User',
    //         'Date',
    //     ];
    // }
}

// class InvoicesExport implements FromQuery, WithHeadings
// {   
    
// }
