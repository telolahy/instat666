<?php

namespace App\Models;

use App\Models\User;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
 
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function getRegionsUser()
    {
        $region_user = DB::table('regions')
                        // ->select('id','region')
                        ->where('id',Auth()->user()->region_id)->first();
        return ($region_user);
    }
    
    public static function getRegionProprietaire($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $proprietaire = $etablissement->proprietaires->first();
        $region = Region::where('id', $proprietaire->region_id)->first();
        return ($region);
    }

    public static function getRegionEtablissement($id)
    {
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $region = Region::where('id', $etablissement->region_id)->first();
        return ($region);
    }
}
