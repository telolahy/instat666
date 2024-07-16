<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Division;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Groupe extends Model
{
    use HasFactory;

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    public static function getGroupeEtab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $groupe = Groupe::where('id', $etablissement->groupe_id)->first();
        return ($groupe);
    }

    public static function getGroupe1Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $groupe = Groupe::where('id', $etablissement->groupe_sec1)->first();
        return ($groupe);
    }

    public static function getGroupe2Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $groupe = Groupe::where('id', $etablissement->groupe_sec2)->first();
        return ($groupe);
    }

    
}
