<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;


    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function fokontany()
    {
        return $this->belongsTo(Fokontany::class);
    }

    public function juridique()
    {
        return $this->belongsTo(Juridique::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function lchef()
    {
        return $this->belongsTo(Lchef::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proprietaires()
    {
        return $this->belongsToMany(Proprietaire::class, 'etablissement_proprietaire');
    }

    public function get_first_25_words($string)
    {
        // Diviser la chaîne en un tableau de mots
        $words = explode(' ', $string);

        // Récupérer les 25 premiers mots
        $first_25_words = array_slice($words, 0, 25);

        // Concaténer les mots en une chaîne
        $result = implode(' ', $first_25_words);

        // Ajouter les trois points de suspension à la fin
        $result .= '...';

        return $result;
    }

    public function get_first_15_words($string)
    {
        // Diviser la chaîne en un tableau de mots
        $words = explode(' ', $string);

        // Récupérer les 25 premiers mots
        $first_25_words = array_slice($words, 0, 15);

        // Concaténer les mots en une chaîne
        $result = implode(' ', $first_25_words);

        // Ajouter les trois points de suspension à la fin
        $result .= '...';

        return $result;

        
    }

    public static function getCategorieEtab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $categorie = Categorie::where('id', $etablissement->categorie_id)->first();
        return ($categorie);
    }
}
