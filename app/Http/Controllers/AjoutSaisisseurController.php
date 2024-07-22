<?php

namespace App\Http\Controllers;

use App\Models\Lchef;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Activite;
use App\Models\District;
use App\Models\Province;
use App\Models\Fokontany;
use App\Models\Juridique;
use App\Models\Nationalite;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Categorie;

class AjoutSaisisseurController extends Controller
{
    public function ft_search(Request $request)
    {
        if ($request->search == "")
        {
            return redirect()->back();
        }
        $communes = Commune::where('commune', 'like', "%$request->search%")
                    ->groupBy('commune')
                    ->get();
        return view('admin_reg.ajout_etab.search_index')->with('communes', $communes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function index()
    {
        $communes = Commune::groupBy('commune')->paginate(8);
        return view('admin_reg.ajout_etab.index')->with('communes', $communes);
    }
 */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout()
    {
        $nationalite = Nationalite::All();
        $provinces = Province::all();
        $regions = Region::all();
        $districts = District::all();
        $communes = Commune::all();
        $fokontanis = Fokontany::All();
        $sections = Section::all();

        $district_users = District::getDistrictsUser();
        $region_user = Region::getRegionsUser();
        $lchefs = Lchef::All();
        $juridiques = Juridique::All();
        $code_region = DB::table('regions')
            ->select('code_region')
            ->where('id', '=', Auth()->user()->region_id)->first();

        // // dd($code_region);


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

        return view('saisisseur.ajout.ajout')
            // ->with('commune', $commune)
            ->with('nationalites', $nationalite)
            ->with('fokontanis', $fokontanis)
            ->with('regions', $regions)
            ->with('districts', $districts)
            ->with('provinces', $provinces)
            ->with('district_users', $district_users)
            ->with('communes', $communes)
            ->with('region_user', $region_user)
            // ->with('fokontany_etab', $fokontany_etab)
            // ->with('activites', $activite_etab)
            ->with('lchefs', $lchefs)
            // ->with('communes', $communes)
            ->with('juridiques', $juridiques)
            ->with('provinces', $provinces)
            ->with('identification_stat', $identification_stat)
            ->with('sections', $sections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //proprietaire validation
            'cin' => 'required',
            'nationalite_id' => 'required',
            'nom' => 'required',
            'adresse' => 'required',
            'province'=>'required',
            'region'=>'required',
            'district'=>'required',
            'commune' => 'required',
            'fokontany' => 'required',
            'num_tel' => 'required',
            'lien' => 'required',
            //proprietaire validation
            'sigle' => 'required',
            'adresse_etab' => 'required',
            'district_etab' => 'required',
            'commune_etab' => 'required',
            'fokontany_etab' => 'required',
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
            $categorie = Categorie::findOrFail($request->input('categorie_0'));
            $province_etab = Region::findOrFail($request->input('region_etab'));
            
           
           $etablissement->user_id = Auth::user()->id;
           $etablissement->identification_stat = $request->input('identification_stat');
           $etablissement->sigle = $request->input('sigle');
           $etablissement->adresse_etab = $request->input('adresse_etab');

           $etablissement->province_id = $province_etab->province_id;

           $etablissement->region_id = $request->input('region_etab');
           $etablissement->district_id = $request->input('district_etab');
           $etablissement->commune_id = $request->input('commune_etab');
           $etablissement->fokontany_id = $request->input('fokontany_etab');
           $etablissement->lchef_id = $request->input('lchef_id');
           $etablissement->juridique_id = $request->input('juridique_id');
           $etablissement->fond = $request->input('fond');
           $etablissement->tel_etab = $request->input('tel_etab');
           $etablissement->num_patente = $request->input('num_patente');
           $etablissement->bp = $request->input('bp');
           $etablissement->comptabilite = $request->input('comptabilite');
           $etablissement->duplicata = $request->input('duplicata');
           $etablissement->type = $request->input('type');
           $etablissement->activite_princ = $request->input('activite_0');
           $etablissement->section_id = $request->input('section_0');
           $etablissement->division_id = $request->input('division_0');
           $etablissement->groupe_id = $request->input('groupe_0');
           $etablissement->classe_id = $request->input('classe_0');
           $etablissement->categorie_id = $request->input('categorie_0');
           $etablissement->activite_sec1 = $request->input('activite_1');
           $etablissement->section_sec1 = $request->input('section_1');
           $etablissement->division_sec1 = $request->input('division_1');
           $etablissement->groupe_sec1 = $request->input('groupe_1');
           $etablissement->classe_sec1 = $request->input('classe_1');
           $etablissement->categorie_sec1 = $request->input('categorie_1');
           $etablissement->activite_sec2 = $request->input('activite_2');
           $etablissement->section_sec2 = $request->input('section_2');
           $etablissement->division_sec2 = $request->input('division_2');
           $etablissement->groupe_sec2 = $request->input('groupe_2');
           $etablissement->classe_sec2 = $request->input('classe_2');
           $etablissement->categorie_sec2 = $request->input('categorie_2');
           $etablissement->malagasy_m = $request->input('malagasy_m');
           $etablissement->malagasy_f = $request->input('malagasy_f');
           $etablissement->etranger_m = $request->input('etranger_m');
           $etablissement->etranger_f = $request->input('etranger_f');
           $etablissement->status = "En attente";


           $etablissement->num_entreprise =$categorie->code_categorie."-".$etablissement->identification_stat;

           $etablissement->save();
           $proprietaire = new Proprietaire();
           $proprietaire->province_id = $request->input('province');
           $proprietaire->region_id = $request->input('region');
           $proprietaire->district_id = $request->input('district');
           $proprietaire->commune_id = $request->input('commune');
           $proprietaire->cin = $request->input('cin');
           $proprietaire->nom = $request->input('nom');
           $proprietaire->nationalite_id = $request->input('nationalite_id');
           $proprietaire->adresse = $request->input('adresse');
           $proprietaire->fokontany_id = $request->input('fokontany');
           $proprietaire->num_tel = $request->input('num_tel');
           $proprietaire->lien = $request->input('lien');
           $proprietaire->email = $request->input('email');
           $proprietaire->save();




        $etablissement->proprietaires()->attach($proprietaire->id);


        return redirect()->back()->with('success', 'Données envoyées avec succès !!!');
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
        //
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
        //
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
