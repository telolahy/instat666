<?php
 
namespace App\Http\Controllers;

use App\Models\Lchef;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Section;
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

        return view('admin_reg.ajout_existant.edit')
            ->with('proprietaire', $proprietaire)
            ->with('nationalites', $nationalite)
            ->with('fokontanis', $fokontanis)
            ->with('regions', $regions)
            ->with('districts', $districts)
            ->with('provinces', $provinces)
            ->with('district_users', $district_users)
            ->with('communes', $communes)
            ->with('region_user', $region_user)
            ->with('lchefs', $lchefs)
            ->with('juridiques', $juridiques)
            ->with('provinces', $provinces)
            ->with('identification_stat', $identification_stat)
            ->with('sections', $sections);
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
