<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Commune;
use App\Models\District;
use App\Models\Fokontany;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DropdownEtabController extends Controller
{
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
