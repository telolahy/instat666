<?php

namespace App\Models;

use App\Models\Groupe;
use App\Models\Section;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function groupes()
    {
        return $this->hasMany(Groupe::class);
    }

    public static function getDivisionEtab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $division = Division::where('id', $etablissement->division_id)->first();
        return ($division);
    }

    public static function getDivision1Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $division = Division::where('id', $etablissement->division_sec1)->first();
        return ($division);
    }

    public static function getDivision2Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $division = Division::where('id', $etablissement->division_sec2)->first();
        return ($division);
    }
}
