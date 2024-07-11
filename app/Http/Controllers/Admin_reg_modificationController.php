<?php

namespace App\Http\Controllers;

use App\Models\Lchef;
use App\Models\Activite;
use App\Models\Juridique;
use App\Models\Nationalite;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Admin_reg_modificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissements = Etablissement::where('status','!=','En attente')->with('proprietaires')->get();
        // dd($etablissements);
        return view('admin_reg.modification.index')->with('etablissements', $etablissements);
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
        $etablissement = Etablissement::with('proprietaires')->find($id);
       // $proprietaire = $etablissement->proprietaires->first();
    //    dd($etablissement);
        $nationalite = Nationalite::All();
        $fokontany= DB::table('fokontanies')->select('fokotany','id')->groupBy('fokotany')->get();
        $activite_etab = Activite::All();
        $lchefs = Lchef::All();
        $juridiques = Juridique::All();

        // dd($fokontany);
        

        $communes = DB::table('communes')
            ->select('commune', 'id')
            ->where('region', '=', Auth()->user()->region_user)
            ->groupBy('commune')
            ->get();

        return view('admin_reg.modification.edit')
            ->with('nationalites', $nationalite)
            ->with('fokontanys', $fokontany)
            ->with('activites', $activite_etab)
            ->with('lchefs', $lchefs)
            ->with('communes', $communes)
            ->with('juridiques', $juridiques)
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
        // dd($request->input('fonkotany_id'));
        $validator = Validator::make($request->all(), [
            
            'adresse' => 'required',
            'lien' => 'required',
            'num_tel' => 'required',
            'sigle' => 'required',
            'adresse_etab' => 'required',
            'fond' => 'required',
            'tel_etab' => 'required',
            'num_patente' => 'required',
            'bp' => 'required',
            'malagasy_m' => 'required',
            'malagasy_f' => 'required',
            'etranger_m' => 'required',
            'etranger_f' => 'required',
            'fokotany_etab' => 'required|exists:fokontanies,id',
            'fonkotany_id' => 'required|exists:fokontanies,id',
            'lchef_etab' => 'required|exists:lchefs,id',
            'activite_etab' => 'required|exists:activites,id',
            'juridique_etab' => 'required|exists:juridiques,id',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $etablissement = Etablissement::findOrFail($id);
        $etablissement->fokontany_id = $request->input('fokotany_etab');
        $etablissement->sigle = $request->input('sigle');
        $etablissement->adresse_etab = $request->input('adresse_etab');
        $etablissement->fond = $request->input('fond');
        $etablissement->comptabilite = $request->input('comptabilite');
        $etablissement->duplicata = $request->input('duplicata');
        $etablissement->type = 'M';
        $etablissement->juridique_id = $request->input('juridique_etab');
        $etablissement->lchef_id = $request->input('lchef_etab');
        $etablissement->activite_id = $request->input('activite_etab');
        $etablissement->activite_sec1 = $request->input('activite_sec1');
        $etablissement->activite_sec2 = $request->input('activite_sec2'); 
        $etablissement->tel_etab = $request->input('tel_etab');
        $etablissement->num_patente = $request->input('num_patente');
        $etablissement->bp = $request->input('bp');
        $etablissement->malagasy_f = $request->input('malagasy_f');
        $etablissement->malagasy_m = $request->input('malagasy_m');
        $etablissement->etranger_m = $request->input('etranger_m');
        $etablissement->etranger_f = $request->input('etranger_f');
        $etablissement->status = 'En attente';
 
        $etablissement->save();

        $proprietaire = $etablissement->proprietaires->first();
        $proprietaire->fokontany_id = $request->input('fonkotany_id');
        $proprietaire->adresse = $request->input('adresse');
        $proprietaire->email = $request->input('email');
        $proprietaire->lien = $request->input('lien');
        $proprietaire->num_tel = $request->input('num_tel');
        $proprietaire->save();
       // $etablissement->proprietaires()->attach($proprietaire->id);
       return redirect()->route('reg_etab.index')->with('success', 'Données envoyées avec succès !!!');
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
