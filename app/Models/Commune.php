<?php

namespace App\Models;

use App\Models\District;
use App\Models\Fokontany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commune extends Model
{
    use HasFactory;
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function fokontanies()
    {
        return $this->hasMany(Fokontany::class);
    }

    public static function getCommuneProprietaire($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $proprietaire = $etablissement->proprietaires->first();
        $commune = Commune::where('id', $proprietaire->commune_id)->first();
        return ($commune);
    }

    public static function getCommuneEtablissement($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $commune = Commune::where('id', $etablissement->commune_id)->first();
        return ($commune);
    }
}
