<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public static function getCategorieEtab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $categorie = Categorie::where('id', $etablissement->categorie_id)->first();
        return ($categorie);
    }

    public static function getCategorie1Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $categorie = Categorie::where('id', $etablissement->categorie_sec1)->first();
        return ($categorie);
    }

    public static function getCategorie2Etab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $categorie = Categorie::where('id', $etablissement->categorie_sec2)->first();
        return ($categorie);
    }
}
