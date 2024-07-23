<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;

class saisie_EtablissementController extends Controller
{
   
    public function ft_search(Request $request)
    {
        if ($request->search == "")
         {
             return redirect()->back();
         }

        
        $etablissements = Etablissement::with('proprietaires')
                        ->where('num_entreprise', 'like', "%$request->search%")
                        ->orWhere('sigle', 'like', "%$request->search%")
                        ->orWhereHas('proprietaires', function ($query) use ($request) {
                            $query->where('nom', 'like', "%{$request->search}%")    
                                  ->orWhere('cin', 'like', "%{$request->search}%");
                        })
                        ->get();
        return view('saisisseur.liste_etab.search_index')->with('etablissements', $etablissements);
    }
    public function index()
    {
        $region_user =Region::getRegionsUser(); 
       
        
        $etablissements = Etablissement::with('proprietaires')
                                        ->where('status', '!=', 'En attente')
                                        ->where(function($query) use ($region_user) {
                                            $query->where('region_id', $region_user->id);
                                        })
                                        ->paginate(8);
        return view('saisisseur.liste_etab.index')->with('etablissements', $etablissements);
    }
}
