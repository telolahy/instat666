<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalite extends Model
{
    use HasFactory;

    public static function getNationaliteProp($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $proprietaire = $etablissement->proprietaires->first();
        $nationalite = Nationalite::where('id', $proprietaire->nationalite_id)->first();
        return ($nationalite);
    }
}
