<?php

namespace App\Exports;

use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class EtablissementsExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        if (Auth()->user()->role == "admin_par_region") {
            return DB::table('communes')
                ->join('etablissements', 'etablissements.commune_id', '=', 'communes.id')
                ->select('*')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else {
            return Etablissement::all();
        }
    }
     public function headings(): array
     {
         return [
             'id',
             'num_entreprise',
             'identification_stat',
             'sigle',
             'adresse_etab',
             'num_patente',
             'comptabilite',
             'fond',
             'duplicata',
             'bp',
             'status',
             'tel_etab',
             'type',
             'fokontany_id',
             'activite_id',
             'activite_sec1',
             'activite_sec2',
             'lchef_id',
             'juridique_id',
             'user_id',
             'proprietaire_id',
             'commune_id',
             'malagasy_m',
             'malagasy_f',
             'etranger_m',
             'etranger_f',
             'created_at',
             'updated_at',
         ];
     }
}
