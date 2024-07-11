<?php

namespace App\Http\Controllers;

use App\Mail\EnvoiMail;
use App\Models\Activite;
use App\Models\Commune;
use App\Models\Etablissement;
use App\Models\Fokontany;
use App\Models\Juridique;
use App\Models\Lchef;
use App\Models\Nationalite;
use App\Models\Proprietaire;
use App\Models\Quitance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class ProprietaireController extends Controller
{
    // *****************************************affiche etablissement

    public function affiche_list_comm_proprietaire()
    {
        $communes = Commune::groupBy('commune')->get();
       // dd($communes);
        return view('etablissement.list_communes')->with('communes', $communes);
    }

    // **************************************algorithme d_identification

    public function affiche_form_proprietaire($id)
    {
       // dd('coucou');
        $commune = Commune::find($id);
        $nationalite = Nationalite::All();
        $fokontany = Fokontany::All();
        $fokontany_etab = Fokontany::All();
        $activite_etab = Activite::All();
        $lchefs = Lchef::All();
        $juridiques = Juridique::All();

        $code_region = DB::table('communes')
            ->select('code_region')
            ->where('region', '=', Auth()->user()->region_user)->first();

        if (Auth()->user()->role == "admin_par_region") {
            $communes = DB::table('communes')
                ->select('commune')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else if (Auth()->user()->role == "saisisseur") {
            $communes = DB::table('communes')
                ->select('commune')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else {
            $communes = Commune::All();
        }

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


        return view('etablissement.ajout_proprietaire')
            ->with('commune', $commune)
            ->with('nationalites', $nationalite)
            ->with('fokontanys', $fokontany)
            ->with('fokontany_etab', $fokontany_etab)
            ->with('activites', $activite_etab)
            ->with('lchefs', $lchefs)
            ->with('communes', $communes)
            ->with('juridiques', $juridiques)
            ->with('identification_stat', $identification_stat);
    }

    //  **********************************ajouter un proprietaire et un etablissement

    public function ajout_proprietaire(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'cin' => 'required',
            'commune_proprietaire' => 'required',
            'fokotany_proprietaire' => 'required',
            'adresse' => 'required',
            'lien' => 'required',
            'num_tel' => 'required',
            'nationalite_proprietaire' => 'required',
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

        $verif_cin = DB::table('proprietaires')
            ->select('cin')
            ->where('cin', '=', $request->input('cin'))->first();
        $id_commune = DB::table('communes')
            ->select('id')
            ->where('commune', '=', $request->input('commune_proprietaire'))->first();
        $id_nationalite = DB::table('nationalites')
            ->select('id')
            ->where('nationalite', '=', $request->input('nationalite_proprietaire'))->first();
        $id_fokontany = DB::table('fokontanies')
            ->select('id')
            ->where('fokotany', '=', $request->input('fokotany_proprietaire'))->first();
        $id_commune_etab = DB::table('communes')
            ->select('id')
            ->where('commune', '=', $request->input('commune_etab'))->first();
        $id_fokontany_etab = DB::table('fokontanies')
            ->select('id')
            ->where('fokotany', '=', $request->input('fokotany_etab'))->first();
        $id_activite_etab = DB::table('activites')
            ->select('id')
            ->where('description', '=', $request->input('activite_etab'))->first();
        $id_lchef_etab = DB::table('lchefs')
            ->select('id')
            ->where('description_lchef', '=', $request->input('lchef_etab'))->first();
        $id_juridique_etab = DB::table('juridiques')
            ->select('id')
            ->where('description_code_juridique', '=', $request->input('juridique_etab'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
            // if ($request->input('cin')[5] <> "1" || $request->input('cin')[5] <> "0") {
            //     return response()->json([
            //         'status' => 400,
            //         'error' => " Le 6eme chiffre doit comporter 0 ou 1 !!! ",
            //     ]);
            // dump($request->input('cin')[5]);
        } elseif (!is_null($verif_cin) && $verif_cin->cin == $request->input('cin')) {
            return response()->json([
                'status' => 400,
                'error' => " Numero CIN existe deja !!! ",
            ]);
        } else {
            $proprietaire = new Proprietaire();

            $proprietaire->nom = $request->input('nom');
            $proprietaire->cin = $request->input('cin');
            $proprietaire->adresse = $request->input('adresse');
            $proprietaire->lien = $request->input('lien');
            $proprietaire->email = $request->input('email');
            $proprietaire->num_tel = $request->input('num_tel');
            $proprietaire->commune_id = $id_commune->id;
            $proprietaire->fokontany_id = $id_fokontany->id;
            $proprietaire->nationalite_id = $id_nationalite->id;
            $proprietaire->save();

            $etablissement = new Etablissement();

            $id_proprietaire = DB::table('proprietaires')
                ->select('id')
                ->where('cin', '=', $request->input('cin'))->first();

            $etablissement->identification_stat = $request->input('identification_stat');
            $etablissement->sigle = $request->input('sigle');
            $etablissement->adresse_etab = $request->input('adresse_etab');
            $etablissement->num_patente = $request->input('num_patente');
            $etablissement->comptabilite = $request->input('comptabilite');
            $etablissement->fond = $request->input('fond');
            $etablissement->duplicata = $request->input('duplicata');
            $etablissement->tel_etab = $request->input('tel_etab');
            $etablissement->bp = $request->input('bp');
            $etablissement->type = $request->input('type');
            $etablissement->activite_sec1 = $request->input('activite_sec1');
            $etablissement->activite_sec2 = $request->input('activite_sec2');
            $etablissement->malagasy_m = $request->input('malagasy_m');
            $etablissement->malagasy_f = $request->input('malagasy_f');
            $etablissement->etranger_m = $request->input('etranger_m');
            $etablissement->etranger_f = $request->input('etranger_f');
            $etablissement->status = "En attente";
            $etablissement->fokontany_id = $id_fokontany_etab->id;
            $etablissement->activite_id = $id_activite_etab->id;
            $etablissement->lchef_id = $id_lchef_etab->id;
            $etablissement->juridique_id = $id_juridique_etab->id;
            $etablissement->commune_id = $id_commune_etab->id;
            $etablissement->proprietaire_id = $id_proprietaire->id;
            $etablissement->user_id = Auth()->user()->id;
            $etablissement->save();

            // Mail::to('test@mail.test')->send(new EnvoiMail()); 
            
            
            return redirect()->route('list_com_prop')->with('message', 'Données envoyées avec succès !!!');
            // return response()->json([
            //     'status' => 200,
            //     'message' => " Données envoyé avec succèss !!!",
            // ]);
        }
    }

    //   **********************recuperer le region et le district à partir du commune

    public function get_region($commune)
    {
        $res = DB::table('communes')
            ->select('district', 'region')
            ->where('commune', '=', $commune)->get();


        return response()->json([
            'status' => 400,
            'etab' => $res,

        ]);
    }

    // **********************************affiche formulaire de rectification proprietaiire et entreprise

    public function affiche_form_edit($id)
    {

        $etablissement = Etablissement::find($id);
        $commune = Commune::find($id);
        $nationalite = Nationalite::All();
        $fokontany = Fokontany::All();
        $fokontany_etab = Fokontany::All();
        $activite_etab = Activite::All();
        $lchefs = Lchef::All();
        $juridiques = Juridique::All();

        if (Auth()->user()->role == "admin_par_region") {
            $communes = DB::table('communes')
                ->select('commune')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else {
            $communes = Commune::All();
        }

        return view('etablissement.edit_etab_proprietaire')
            ->with('commune', $commune)
            ->with('nationalites', $nationalite)
            ->with('fokontanys', $fokontany)
            ->with('fokontany_etab', $fokontany_etab)
            ->with('activites', $activite_etab)
            ->with('lchefs', $lchefs)
            ->with('communes', $communes)
            ->with('juridiques', $juridiques)->with('etablissement', $etablissement);
    }


    // *******************************rectification du proprietaire etablissement

    public function rectifier_etab(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'cin' => 'required',
            'adresse' => 'required',
            'lien' => 'required',
            'num_tel' => 'required',
            'nationalite_proprietaire' => 'required',
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

        $proprietaire = Proprietaire::find($request->input('id_proprietaire'));
        $etablissement = Etablissement::find($request->input('id_etab'));


        $id_nationalite = DB::table('nationalites')
            ->select('id')
            ->where('nationalite', '=', $request->input('nationalite_proprietaire'))->first();
        $id_fokontany = DB::table('fokontanies')
            ->select('id')
            ->where('fokotany', '=', $request->input('fokotany_proprietaire'))->first();
        $id_commune_etab = DB::table('communes')
            ->select('id')
            ->where('commune', '=', $request->input('commune_etab'))->first();
        $id_fokontany_etab = DB::table('fokontanies')
            ->select('id')
            ->where('fokotany', '=', $request->input('fokotany_etab'))->first();
        $id_activite_etab = DB::table('activites')
            ->select('id')
            ->where('description', '=', $request->input('activite_etab'))->first();
        $id_lchef_etab = DB::table('lchefs')
            ->select('id')
            ->where('description_lchef', '=', $request->input('lchef_etab'))->first();
        $id_juridique_etab = DB::table('juridiques')
            ->select('id')
            ->where('description_code_juridique', '=', $request->input('juridique_etab'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {

            $proprietaire->nom = $request->input('nom');
            $proprietaire->cin = $request->input('cin');
            $proprietaire->adresse = $request->input('adresse');
            $proprietaire->lien = $request->input('lien');
            $proprietaire->email = $request->input('email');
            $proprietaire->num_tel = $request->input('num_tel');
            $proprietaire->fokontany_id = $id_fokontany->id;
            $proprietaire->nationalite_id = $id_nationalite->id;
            $proprietaire->update();

            $etablissement->identification_stat = $request->input('identification_stat');
            $etablissement->sigle = $request->input('sigle');
            $etablissement->adresse_etab = $request->input('adresse_etab');
            $etablissement->num_patente = $request->input('num_patente');
            $etablissement->comptabilite = $request->input('comptabilite');
            $etablissement->fond = $request->input('fond');
            $etablissement->duplicata = $request->input('duplicata');
            $etablissement->tel_etab = $request->input('tel_etab');
            $etablissement->bp = $request->input('bp');
            $etablissement->type = $request->input('type');
            $etablissement->activite_sec1 = $request->input('activite_sec1');
            $etablissement->activite_sec2 = $request->input('activite_sec2');
            $etablissement->malagasy_m = $request->input('malagasy_m');
            $etablissement->malagasy_f = $request->input('malagasy_f');
            $etablissement->etranger_m = $request->input('etranger_m');
            $etablissement->etranger_f = $request->input('etranger_f');
            $etablissement->fokontany_id = $id_fokontany_etab->id;
            $etablissement->activite_id = $id_activite_etab->id;
            $etablissement->lchef_id = $id_lchef_etab->id;
            $etablissement->juridique_id = $id_juridique_etab->id;
            $etablissement->commune_id = $id_commune_etab->id;
            $etablissement->update();

            return response()->json([
                'status' => 200,
                'message' => " Rectification avec succèss !!!",
            ]);
        }
    }

    // *******************************liste des proprietaires

    public function list_proprietaire()
    {
        $proprietaires = Proprietaire::all();
        return view('etablissement.list_proprietaire')->with('proprietaires', $proprietaires);
    }

    // *****************************formulaire pour ajouter un etablissement avec un proprio existant


    public function form_etab_proprietaire_exist($id)
    {
        $proprietaire  = Proprietaire::find($id);

        $fokontany_etab = Fokontany::All();
        $activite_etab = Activite::All();
        $lchefs = Lchef::All();
        $juridiques = Juridique::All();

        $code_region = DB::table('communes')
            ->select('code_region')
            ->where('region', '=', Auth()->user()->region_user)->first();

        if (Auth()->user()->role == "admin_par_region") {
            $communes = DB::table('communes')
                ->select('commune')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else if (Auth()->user()->role == "saisisseur") {
            $communes = DB::table('communes')
                ->select('commune')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else {
            $communes = Commune::All();
        }

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

        return view('etablissement.ajout_etablissement_proprietaire_existe_deja')
            ->with('identification_stat', $identification_stat)
            ->with('fokontany_etab', $fokontany_etab)
            ->with('activites', $activite_etab)
            ->with('lchefs', $lchefs)
            ->with('communes', $communes)
            ->with('juridiques', $juridiques)
            ->with('proprietaire', $proprietaire);
    }

    // *****************************ajouter un etablissement avec un proprio existant

    public function ajout_etab_proprietaire_exist(Request $request)
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

        $proprietaire = Proprietaire::find($request->input('id_proprio'));
        $id_commune_etab = DB::table('communes')
            ->select('id')
            ->where('commune', '=', $request->input('commune_etab'))->first();
        $id_fokontany_etab = DB::table('fokontanies')
            ->select('id')
            ->where('fokotany', '=', $request->input('fokotany_etab'))->first();
        $id_activite_etab = DB::table('activites')
            ->select('id')
            ->where('description', '=', $request->input('activite_etab'))->first();
        $id_lchef_etab = DB::table('lchefs')
            ->select('id')
            ->where('description_lchef', '=', $request->input('lchef_etab'))->first();
        $id_juridique_etab = DB::table('juridiques')
            ->select('id')
            ->where('description_code_juridique', '=', $request->input('juridique_etab'))->first();

        $getEtab = DB::table('etablissements')
            ->select('identification_stat')
            ->where('proprietaire_id', '=', $request->input('id_proprio'))->orderBy('created_at', 'desc')->first();



        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {

            $proprietaire->lien = $request->input('lien') + 1;

            $proprietaire->update();

            $etablissement = new Etablissement();

            $id_proprietaire = DB::table('proprietaires')
                ->select('id')
                ->where('cin', '=', $request->input('cin'))->first();

            $etablissement->identification_stat = $request->input('identification_stat');
            $etablissement->num_entreprise = $getEtab->identification_stat;
            $etablissement->sigle = $request->input('sigle');
            $etablissement->adresse_etab = $request->input('adresse_etab');
            $etablissement->num_patente = $request->input('num_patente');
            $etablissement->comptabilite = $request->input('comptabilite');
            $etablissement->fond = $request->input('fond');
            $etablissement->duplicata = $request->input('duplicata');
            $etablissement->tel_etab = $request->input('tel_etab');
            $etablissement->bp = $request->input('bp');
            $etablissement->type = $request->input('type');
            $etablissement->activite_sec1 = $request->input('activite_sec1');
            $etablissement->activite_sec2 = $request->input('activite_sec2');
            $etablissement->malagasy_m = $request->input('malagasy_m');
            $etablissement->malagasy_f = $request->input('malagasy_f');
            $etablissement->etranger_m = $request->input('etranger_m');
            $etablissement->etranger_f = $request->input('etranger_f');
            $etablissement->status = "En attente";
            $etablissement->fokontany_id = $id_fokontany_etab->id;
            $etablissement->activite_id = $id_activite_etab->id;
            $etablissement->lchef_id = $id_lchef_etab->id;
            $etablissement->juridique_id = $id_juridique_etab->id;
            $etablissement->commune_id = $id_commune_etab->id;
            $etablissement->proprietaire_id = $id_proprietaire->id;
            $etablissement->user_id = Auth()->user()->id;
            $etablissement->save();

            return response()->json([
                'status' => 200,
                'message' => " Données envoyé avec succèss !!!",
            ]);
        }
    }
    //********************************* */  liste d'etabissement et son proprietaire

    public function list_modif_proprio_etablissement()
    {
        if (Auth()->user()->role == "admin_par_region") {
            $etablissements = DB::table('communes')
                ->join('etablissements as a', 'a.commune_id', '=', 'communes.id')
                ->join('proprietaires', 'proprietaires.id', '=', 'a.proprietaire_id')
                ->join('etablissements as b', 'b.proprietaire_id', '=', 'proprietaires.id')
                ->select('*')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else {
            $etablissements = DB::table('proprietaires')
                ->join('etablissements', 'etablissements.proprietaire_id', '=', 'proprietaires.id')
                ->select('*')
                ->get();
        }
        return view('etablissement.list_etab_proprietaire')->with('etablissements', $etablissements);
    }

    // ******************************formulaire de Modification d'etablissement et proprietaire

    public function form_modif_proprio_etablissement($id)
    {
        
        $etablissement = Etablissement::find($id);
        $nationalite = Nationalite::All();
        //$fokontany = Fokontany::All();
        $fokontany = Fokontany::distinct()->pluck('fokotany');
        //dd($fokontany);
       // $fokontany_etab = Fokontany::All();
        $activite_etab = Activite::All();
        $lchefs = Lchef::All();
        $juridiques = Juridique::All();


        if (Auth()->user()->role == "admin_par_region") {
            $communes = DB::table('communes')
                ->select('commune')
                ->where('region', '=', Auth()->user()->region_user)->distinct()->pluck('commune');
        } else {
            $communes = Commune::distinct()->pluck('commune');
        }

        return view('etablissement.edit_modif_proprio_etablissement')
            ->with('nationalites', $nationalite)
            ->with('fokontanys', $fokontany)
           // ->with('fokontany_etab', $fokontany_etab)
            ->with('activites', $activite_etab)
            ->with('lchefs', $lchefs)
            ->with('communes', $communes)
            ->with('juridiques', $juridiques)
            ->with('etablissement', $etablissement);
    }

    // **********************************modifier un proprietaire
    
    public function modifier_proprio_etablissement(Request $request)
    {
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
            'num_quitance' => '',
            'prix' => '',
            'type_quitance' => '',
        ]);
        
        $proprietaire = Proprietaire::find($request->input('id_proprietaire'));
        $etablissement = Etablissement::find($request->input('id_etab'));
        
        
        $id_fokontany = DB::table('fokontanies')
        ->select('id')
        ->where('fokotany', '=', $request->input('fokotany_proprietaire'))->first();
        $id_commune_etab = DB::table('communes')
        ->select('id')
        ->where('commune', '=', $request->input('commune_etab'))->first();
        $id_fokontany_etab = DB::table('fokontanies')
        ->select('id')
        ->where('fokotany', '=', $request->input('fokotany_etab'))->first();
        $id_activite_etab = DB::table('activites')
        ->select('id')
        ->where('description', '=', $request->input('activite_etab'))->first();
        $id_lchef_etab = DB::table('lchefs')
        ->select('id')
        ->where('description_lchef', '=', $request->input('lchef_etab'))->first();
        $id_juridique_etab = DB::table('juridiques')
        ->select('id')
        ->where('description_code_juridique', '=', $request->input('juridique_etab'))->first();
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            
            
            $proprietaire->adresse = $request->input('adresse');
            $proprietaire->email = $request->input('email');
            $proprietaire->num_tel = $request->input('num_tel');
            $proprietaire->fokontany_id = $id_fokontany->id;
            $proprietaire->update();
            
            $etablissement->sigle = $request->input('sigle');
            $etablissement->adresse_etab = $request->input('adresse_etab');
            $etablissement->num_patente = $request->input('num_patente');
            $etablissement->comptabilite = $request->input('comptabilite');
            $etablissement->fond = $request->input('fond');
            $etablissement->duplicata = $request->input('duplicata');
            $etablissement->tel_etab = $request->input('tel_etab');
            $etablissement->bp = $request->input('bp');
            $etablissement->type = $request->input('type');
            $etablissement->activite_sec1 = $request->input('activite_sec1');
            $etablissement->activite_sec2 = $request->input('activite_sec2');
            $etablissement->malagasy_m = $request->input('malagasy_m');
            $etablissement->malagasy_f = $request->input('malagasy_f');
            $etablissement->etranger_m = $request->input('etranger_m');
            $etablissement->etranger_f = $request->input('etranger_f');
            $etablissement->fokontany_id = $id_fokontany_etab->id;
            $etablissement->activite_id = $id_activite_etab->id;
            $etablissement->lchef_id = $id_lchef_etab->id;
            $etablissement->juridique_id = $id_juridique_etab->id;
            $etablissement->commune_id = $id_commune_etab->id;
            $etablissement->update();
            
            $quittance = new Quitance();
            $quittance->etablissement_id = $request->input('id_etab');
            $quittance->num_quitance = $request->input('num_quitance');
            $quittance->type = $request->input('type_quitance');
            $quittance->prix = $request->input('prix');
            $quittance->save();
            
            return response()->json([
                'status' => 200,
                'message' => " Modification avec succèss !!!",
            ]);
        }
    }
    // **********************************modifier saisiseur
   

    //**********************Liste pour Sélectionner l'etablissement à mutter
    
    public function list_mutation()
    {
        $etablissements = Etablissement::all();

        return view('etablissement.list_etab_mutation')->with('etablissements', $etablissements);
    }

    // ***************************Afficher le Formulaire de mutation d'entreprise

    public function form_mutation_etablissement($id)
    {
        $etablissement = Etablissement::find($id);
        if (Auth()->user()->role == "admin_par_region") {
            $communes = DB::table('communes')
                ->select('commune')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else {
            $communes = Commune::All();
        }
        $fokontany = Fokontany::all();
        $nationalites = Nationalite::all();

        return view('etablissement.form_mutation')
            ->with('fokontanys', $fokontany)
            ->with('communes', $communes)
            ->with('nationalites', $nationalites)
            ->with('etablissement', $etablissement);
    }
}
