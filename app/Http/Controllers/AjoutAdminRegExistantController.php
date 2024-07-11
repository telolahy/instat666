<?php

namespace App\Http\Controllers;

use App\Models\Lchef;
use App\Models\Activite;
use App\Models\Fokontany;
use App\Models\Juridique;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AjoutAdminRegExistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proprietaires = Proprietaire::with('etablissements')->get();
        return view('admin_reg.ajout_existant.index')->with('proprietaires', $proprietaires);
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
        $proprietaire  = Proprietaire::find($id);

        $fokontany_etab = Fokontany::All();
        $activite_etab = Activite::All();
        $lchefs = Lchef::All();
        $juridiques = Juridique::All();

        $code_region = DB::table('communes')
            ->select('code_region')
            ->where('region', '=', Auth()->user()->region_user)->first();

        $communes = DB::table('communes')
            ->select('commune', 'id')
            ->where('region', '=', Auth()->user()->region_user)
            ->groupBy('commune')
            ->get();

        $dernier_ligne = Etablissement::orderBy('created_at', 'DESC')->first();

        $today = Carbon::now();
        $today_year = $today->year;

        if ($dernier_ligne != null) {
            if ($today_year > $dernier_ligne->created_at->year) {

                $num_sequenciel = "00000";
            } else {

                $num_sequenciel = str_pad($dernier_ligne->id, 5, "0", STR_PAD_LEFT);
            }
        } else {
            $num_sequenciel = "00000";
        }
        $identification_stat = $code_region->code_region . "-" . $today_year . "-" . $num_sequenciel;

        return view('admin_reg.ajout_existant.edit')
            ->with('identification_stat', $identification_stat)
            ->with('fokontany_etab', $fokontany_etab)
            ->with('activites', $activite_etab)
            ->with('lchefs', $lchefs)
            ->with('communes', $communes)
            ->with('juridiques', $juridiques)
            ->with('proprietaire', $proprietaire);
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $etablissement = new Etablissement();

        $etablissement->identification_stat = $request->input('identification_stat');
        $etablissement->sigle = $request->input('sigle');
        $etablissement->adresse_etab = $request->input('adresse_etab');
        $etablissement->fokontany_id = $request->input('fokotany_etab');
        $etablissement->fond = $request->input('fond');
        $etablissement->tel_etab = $request->input('tel_etab');
        $etablissement->num_patente = $request->input('num_patente');
        $etablissement->bp = $request->input('bp');
        $etablissement->comptabilite = $request->input('comptabilite');
        $etablissement->duplicata = $request->input('duplicata');
        $etablissement->type = $request->input('type');
        $etablissement->activite_id = $request->input('activite_etab');
        $etablissement->activite_sec1 = $request->input('activite_sec1');
        $etablissement->activite_sec2 = $request->input('activite_sec2');
        $etablissement->lchef_id = $request->input('lchef_etab');
        $etablissement->juridique_id = $request->input('juridique_etab');
        $etablissement->commune_id = $request->input('commune_etab');
        $etablissement->malagasy_f = $request->input('malagasy_f');
        $etablissement->malagasy_m = $request->input('malagasy_m');
        $etablissement->etranger_f = $request->input('etranger_f');
        $etablissement->etranger_m = $request->input('etranger_m');
        $etablissement->user_id = Auth()->user()->id;
        $etablissement->status = "En attente";
        $etablissement->num_entreprise =$etablissement->activite_id."-".$etablissement->identification_stat;
        $etablissement->save();
        $proprietaire =Proprietaire::findOrFail($id);
        $proprietaire->lien = (int)$proprietaire->lien + 1;
        $proprietaire->save();
        $etablissement->proprietaires()->attach($proprietaire->id);
        
        return redirect()->route('reg_etab.index')->with('message', 'Données envoyées avec succès !!!');
        
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
