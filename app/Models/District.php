<?php

namespace App\Models;

use App\Models\Region;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function communes()
    {
        return $this->hasMany(Commune::class);
    }

    public static function getDistrictsUser()
    {
        $region_user = Auth()->user()->region_id;

        $districts_user = District::where('region_id', $region_user)->get();

        return($districts_user);
    }
}
