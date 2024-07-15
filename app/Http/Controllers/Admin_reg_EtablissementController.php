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
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
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
        // $etablissements = Etablissement::with('proprietaires')
        //     ->join('communes', 'etablissements.commune_id', '=', 'communes.id')
        //     ->join('users', 'users.region_user', '=', 'communes.region')
        //     ->select('etablissements.*', 'communes.commune as nom_commune', 'users.region_user', 'communes.id as id_commune')
        //     ->distinct()
        //     ->paginate(8);

        $region_user =Region::getRegionsUser();
        
        $etablissements = Etablissement::with('proprietaires')
                        ->where('region_id', $region_user->id)->paginate(8);
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
        
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $district_prop = District::getDistrictProprietaire($id);
        $region_prop = Region::getRegionProprietaire($id);
        $fokontany_prop = Fokontany::getFokontanyProprietaire($id);
        $district_etab = District::getDistrictEtablissement($id);
        $region_etab = Region::getRegionEtablissement($id);
        $fokontany_etab = Fokontany::getFokontanyEtablissement($id);
        // dd($fokontany_etab); 
        return view('admin_reg.liste_etab.show')
                ->with('etablissement', $etablissement)
                ->with('district_prop', $district_prop)
                ->with('district_etab', $district_etab)
                ->with('fokontany_etab', $fokontany_etab)
                ->with('region_etab', $region_etab)
                ->with('fokontany_prop', $fokontany_prop)
                ->with('region_prop', $region_prop);
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

        $province_prop = Province::getProvinceProprietaire($id);
        $region_prop = Region::getRegionProprietaire($id);
        $district_prop = District::getDistrictProprietaire($id);
        $commune_prop = Commune::getCommuneProprietaire($id);
        $nationalite_prop = Nationalite::getNationaliteProp($id);
        $fokontany_prop = Fokontany::getFokontanyProprietaire($id);
        // dd($nationalite_prop->nationalite);
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
        return view('admin_reg.liste_etab.edit')
            ->with('nationalites', $nationalite)
            ->with('fokontanis', $fokontanis)
            ->with('regions', $regions)
            ->with('districts', $districts)
            ->with('district_users', $district_users)
            ->with('communes', $communes)
            ->with('region_user', $region_user)
            ->with('lchefs', $lchefs)
            ->with('juridiques', $juridiques)
            ->with('provinces', $provinces)
            ->with('province_prop', $province_prop)
            ->with('region_prop', $region_prop)
            ->with('district_prop', $district_prop)
            ->with('commune_prop', $commune_prop)
            ->with('fokontany_prop', $fokontany_prop)
            ->with('nationalite_prop', $nationalite_prop)
            ->with('etablissement', $etablissement)
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
