<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

    public static function getSectionEtab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $section = Section::where('id', $etablissement->section_id)->first();
        return ($section);
    }

    public static function getSection1Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $section = Section::where('id', $etablissement->section_sec1)->first();
        return ($section);
    }

    public static function getSection2Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $section = Section::where('id', $etablissement->section_sec2)->first();
        return ($section);
    }
}
