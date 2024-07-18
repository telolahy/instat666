<?php

namespace App\Http\Controllers;

use App\Models\Lchef;
use App\Models\Classe;
use App\Models\Groupe;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Section;
use App\Models\Activite;
use App\Models\District;
use App\Models\Division;
use App\Models\Province;
use App\Models\Categorie;
use App\Models\Fokontany;
use App\Models\Juridique;
use App\Models\Nationalite;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $identification_stat = $etablissement->identification_stat;
        $province_prop = Province::getProvinceProprietaire($id);
        $region_prop = Region::getRegionProprietaire($id);
        $district_prop = District::getDistrictProprietaire($id);
        $commune_prop = Commune::getCommuneProprietaire($id);
        $nationalite_prop = Nationalite::getNationaliteProp($id);
        $fokontany_prop = Fokontany::getFokontanyProprietaire($id);
        $region_etab = Region::getRegionEtablissement($id);
        $district_etab = District::getDistrictEtablissement($id);
        $commune_etab = Commune::getCommuneEtablissement($id);
        $fokontany_etab = Fokontany::getFokontanyEtablissement($id);
        
        $section_etab = Section::getSectionEtab($id);
        $division_etab = Division::getDivisionEtab($id);
        $groupe_etab = Groupe::getGroupeEtab($id);
        $classe_etab = Classe::getClasseEtab($id);
        $categorie_etab = Categorie::getCategorieEtab($id);

        $section_sec1 = Section::getSection1Etab($id);
        $division_sec1 = Division::getDivision1Etab($id);
        $groupe_sec1 = Groupe::getGroupe1Etab($id);
        $classe_sec1 = Classe::getClasse1Etab($id);
        $categorie_sec1 = Categorie::getCategorie1Etab($id);

        $section_sec2 = Section::getSection2Etab($id);
        $division_sec2 = Division::getDivision2Etab($id);
        $groupe_sec2 = Groupe::getGroupe2Etab($id);
        $classe_sec2 = Classe::getClasse2Etab($id);
        $categorie_sec2 = Categorie::getCategorie2Etab($id);

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
        return view('admin_reg.liste_etab.edit')
            ->with('nationalites', $nationalite)
            ->with('section_etab', $section_etab)
            ->with('division_etab', $division_etab)
            ->with('groupe_etab', $groupe_etab)
            ->with('classe_etab', $classe_etab)
            ->with('categorie_etab', $categorie_etab)
            ->with('section_sec1', $section_sec1)
            ->with('division_sec1', $division_sec1)
            ->with('groupe_sec1', $groupe_sec1)
            ->with('classe_sec1', $classe_sec1)
            ->with('categorie_sec1', $categorie_sec1)
            ->with('section_sec2', $section_sec2)
            ->with('division_sec2', $division_sec2)
            ->with('groupe_sec2', $groupe_sec2)
            ->with('classe_sec2', $classe_sec2)
            ->with('categorie_sec2', $categorie_sec2)
            ->with('fokontany_etab', $fokontany_etab)
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
            ->with('region_etab', $region_etab)
            ->with('district_prop', $district_prop)
            ->with('district_etab', $district_etab)
            ->with('commune_prop', $commune_prop)
            ->with('commune_etab', $commune_etab)
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

           $etablissement = Etablissement::findOrfail($id);
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

           $proprietaire = $etablissement->proprietaires->first();

           
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
          
           $etablissement->save();
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
