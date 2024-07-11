<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Fokontany;
use App\Models\Nationalite;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Admin_reg_MutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissements = Etablissement::where('status','!=','En attente')->with('proprietaires')->get();
        return view('admin_reg.mutation.index')->with('etablissements', $etablissements);
    }

    public function mutation_ft(Request $request, $id, $prop_id)
    {
        $validator = Validator::make($request->all(), [

            'cin' => 'required',
            'nom' => 'required',
            'adresse' => 'required',
            'lien' => 'required',
            'num_tel' => 'required',
            'fokotany_proprietaire' => 'required|exists:fokontanies,id',
            'commune_proprio' => 'required|exists:communes,id',
            'nationalite_proprietaire' => 'required|exists:nationalites,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $etablissement = Etablissement::with('proprietaires')->findOrFail($id);
        $ancien_proprietaire = $etablissement->proprietaires->first();
        // if (intval($ancien_proprietaire->lien))
        // {
        $ancien_proprietaire->lien = $ancien_proprietaire->lien - 1;
        $etablissement->proprietaires()->detach($ancien_proprietaire->id);
        // }
        // else
        // {
        //     $ancien_proprietaire->delete();
        // }
        $ancien_proprietaire->save();
        
        //proprietaire
        $proprietaire = new Proprietaire();
        $proprietaire->cin = $request->input('cin');
        $proprietaire->nom = $request->input('nom');
        $proprietaire->adresse = $request->input('adresse');
        $proprietaire->nationalite_id = $request->input('nationalite_proprietaire');
        $proprietaire->fokontany_id = $request->input('fokotany_proprietaire');
        $proprietaire->commune_id = $request->input('commune_proprio');
        $proprietaire->lien = 0;
        $proprietaire->email = $request->input('email');
        $proprietaire->num_tel = $request->input('num_tel');

        //etablissement
        $etablissement->status = "En attente";
        $etablissement->type = "U";
        $etablissement->save();
        $proprietaire->save();
        $etablissement->proprietaires()->attach($proprietaire->id);

        return redirect()->route('reg_etab.index')->with('success', 'Données envoyées avec succès !!!');

       
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //  dd('coucou');
        $etablissement = Etablissement::find($id);
        // if (Auth()->user()->role == "admin_par_region") {
            $communes = DB::table('communes')
            ->select('id', 'commune')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MIN(id)'))
                      ->from('communes')
                      ->where('region', '=', Auth::user()->region_user)
                      ->groupBy('commune');
            })
            ->get();
        // } else {
        //     $communes = Commune::All();
        // }
        // dd($communes);
        $fokontany = Fokontany::all();
        $nationalites = Nationalite::all();
        
        return view('admin_reg.mutation.edit')
            ->with('fokontanys', $fokontany)
            ->with('communes', $communes)
            ->with('nationalites', $nationalites)
            ->with('etablissement', $etablissement);
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
        $validator = Validator::make($request->all(), [

            'cin' => 'required',
            'nom' => 'required',
            'adresse' => 'required',
            'lien' => 'required',
            'num_tel' => 'required',
            'fokotany_proprietaire' => 'required|exists:fokontanies,id',
            'commune_proprio' => 'required|exists:communes,id',
            'nationalite_proprietaire' => 'required|exists:nationalites,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $etablissement = Etablissement::findOrFail($id);
        $proprietaire = $etablissement->proprietaire;
        
        $proprietaire->cin = $request->input('cin');
        $proprietaire->nom = $request->input('nom');
        $proprietaire->adresse = $request->input('adresse');
        $proprietaire->nationalite_id = $request->input('nationalite_proprietaire');
        $proprietaire->fokontany_id = $request->input('fokotany_proprietaire');
        $proprietaire->commune_id = $request->input('commune_proprio');
        
        $proprietaire->email = $request->input('email');
        $proprietaire->num_tel = $request->input('num_tel');
        $etablissement->status = "En attente";
        $etablissement->save();
        //dd($proprietaire);
        $proprietaire->save();
        return redirect()->route('list_etablissement')->with('success', 'Données envoyées avec succès !!!');
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
