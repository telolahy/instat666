<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Commune;
use App\Models\District;
use App\Models\Fokontany;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DropdownController extends Controller
{
    
    public function getRegions($province_id)
    {
        $regions = Region::where('province_id', $province_id)->get();
        return response()->json($regions);
    }

    public function getDistricts($region_id)
    {
        $districts = District::where('region_id', $region_id)->get();
        return response()->json($districts);
    }
    public function getCommunes($district_id)
    {
        $communes = Commune::where('district_id', $district_id)->get();
        return response()->json($communes);
    }
    public function getfokontany($commune_id)
    {
        $fokontanis = Fokontany::where('commune_id', $commune_id)->get();
        return response()->json($fokontanis);
    }
}
