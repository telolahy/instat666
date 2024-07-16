<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public static function getProvinceProprietaire($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $proprietaire = $etablissement->proprietaires->first();
        $province = Province::where('id', $proprietaire->province_id)->first();
        return ($province);
    }

    public static function getProvinceEtab($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $province = Province::where('id', $etablissement->province_id)->first();
        return ($province);
    }
}
