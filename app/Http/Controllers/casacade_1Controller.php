<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Groupe;
use App\Models\Division;
use App\Models\Categorie;
use Illuminate\Http\Request;

class casacade_1Controller extends Controller
{
    public function getDivisions($section_id)
    {
        $division = Division::where('section_id', $section_id)->get();
        return response()->json($division);
    }

    public function getGroupes($division_id)
    {
        $groupe = Groupe::where('division_id', $division_id)->get();
        return response()->json($groupe);
    }

    public function getClasses($groupe_id)
    {
        $classe = Classe::where('groupe_id', $groupe_id)->get();
        return response()->json($classe);
    }
    public function getCategories($classe_id)
    {
        $categorie = Categorie::where('classe_id', $classe_id)->get();
        return response()->json($categorie);
    }
}
