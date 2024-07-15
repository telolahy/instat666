<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fokontany extends Model
{
    use HasFactory;
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public static function getFokontanyProprietaire($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $proprietaire = $etablissement->proprietaires->first();
        $fokontany = Fokontany::where('id', $proprietaire->fokontany_id)->first();
        return ($fokontany);
    }

    public static function getFokontanyEtablissement($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
       
        $fokontany = self::where('id', $etablissement->fokontany_id)->first();
        return ($fokontany);
    }
}
