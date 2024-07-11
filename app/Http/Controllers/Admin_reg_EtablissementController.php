<?php

namespace App\Http\Controllers;

use App\Models\Lchef;
use App\Models\Commune;
use App\Models\Activite;
use App\Models\Fokontany;
use App\Models\Juridique;
use App\Models\Nationalite;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Admin_reg_EtablissementController extends Controller
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
        return view('admin_reg.liste_etab.search_index')->with('etablissements', $etablissements);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissements = Etablissement::with('proprietaires')
            ->join('communes', 'etablissements.commune_id', '=', 'communes.id')
            ->join('users', 'users.region_user', '=', 'communes.region')
            ->select('etablissements.*', 'communes.commune as nom_commune', 'users.region_user', 'communes.id as id_commune')
            ->distinct()
            ->paginate(8);
        return view('admin_reg.liste_etab.index')->with('etablissements', $etablissements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd('coucou');
        $etablissement = Etablissement::with('proprietaires')->find($id);
        // dd($etablissement);
        return view('admin_reg.liste_etab.show')->with('etablissement', $etablissement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd('edit');
        $etablissement = Etablissement::with('proprietaires')->find($id);
        // dd($etablissement);
        $commune = Commune::find($id);
        $nationalite = Nationalite::All();
        $fokontany = Fokontany::All();
        $fokontany_etab = Fokontany::All();
        $activite_etab = Activite::All();
        $lchefs = Lchef::All();
        $juridiques = Juridique::All();

        
            // $communes = DB::table('communes')
            //     ->select('commune')
            //     ->where('region', '=', Auth()->user()->region_user)->get();
            $communes = Commune::groupBy('commune')
                        ->get();
            // dd($communes);

        return view('admin_reg.liste_etab.edit')
            ->with('commune', $commune)
            ->with('nationalites', $nationalite)
            ->with('fokontanys', $fokontany)
            ->with('fokontany_etab', $fokontany_etab)
            ->with('activites', $activite_etab)
            ->with('lchefs', $lchefs)
            ->with('communes', $communes)
            ->with('juridiques', $juridiques)->with('etablissement', $etablissement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        //  dd($request->input('activite_id'));
        $etablissement = Etablissement::findOrFail($id);
        $etablissement->fokontany_id = $request->input('fokotany_etab');
        $etablissement->sigle = $request->input('sigle');
        $etablissement->adresse_etab = $request->input('adresse_etab');
        $etablissement->fond = $request->input('fond');
        $etablissement->comptabilite = $request->input('comptabilite');
        $etablissement->duplicata = $request->input('duplicata');
        $etablissement->juridique_id = $request->input('juridique_id');
        $etablissement->commune_id = $request->input('commune_id');
        $etablissement->lchef_id = $request->input('lchef_id');
        $etablissement->activite_id = $request->input('activite_id');
        $etablissement->activite_sec1 = $request->input('activite_sec1');
        $etablissement->activite_sec2 = $request->input('activite_sec2'); 
        $etablissement->tel_etab = $request->input('tel_etab');
        $etablissement->num_patente = $request->input('num_patente');
        $etablissement->bp = $request->input('bp');
        $etablissement->malagasy_f = $request->input('malagasy_f');
        $etablissement->malagasy_m = $request->input('malagasy_m');
        $etablissement->etranger_m = $request->input('etranger_m');
        $etablissement->etranger_f = $request->input('etranger_f');
        $etablissement->user_id = Auth()->user()->id;
        $etablissement->status = 'En attente';
        $etablissement->save();
        
        $proprietaire = $etablissement->proprietaires->first();

        $proprietaire->nom = $request->input('nom');
        $proprietaire->cin = $request->input('cin');
        $proprietaire->nationalite_id = $request->input('nationalite_id');
        $proprietaire->adresse = $request->input('adresse');
        $proprietaire->fokontany_id = $request->input('fonkotany_id');
        $proprietaire->num_tel = $request->input('num_tel');
        $proprietaire->email = $request->input('email');
        $proprietaire->lien = $request->input('lien');
        $proprietaire->save();

        $etablissement->proprietaires()->attach($proprietaire->id);
       return redirect()->route('reg_etab.show',$etablissement->id)->with('success', 'Rectifications enregistrées !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
