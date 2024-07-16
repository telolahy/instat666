<?php

namespace App\Models;

use App\Models\Groupe;
use App\Models\Categorie;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }

    public static function getClasseEtab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $classe = Classe::where('id', $etablissement->classe_id)->first();
        return ($classe);
    }

    public static function getClasse1Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $classe = Classe::where('id', $etablissement->classe_sec1)->first();
        return ($classe);
    }

    public static function getClasse2Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $classe = Classe::where('id', $etablissement->classe_sec2)->first();
        return ($classe);
    }
}
