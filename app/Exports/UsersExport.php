<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (Auth()->user()->role == "admin_par_region") {
            return User::where('region_user', '=', Auth()->user()->region_user)->get();
        } else {
            return User::all();
        }
    }
}
