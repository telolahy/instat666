<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Region;
use App\Models\Commune;
use App\Models\District;
use App\Models\Quitance;
use App\Models\Categorie;
use App\Models\Fokontany;
use App\Models\Nationalite;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class EtablissementController extends Controller
{
    public function ft_search(Request $request)
    {
        $cins = Proprietaire::where('cin', 'like', "%$request->search%")
                            ->orWhere('nom', 'like', "%$request->search%")->get();
        $etablissements = collect();
        foreach ($cins as $proprietaire) {
            $etablissements = $etablissements->merge($proprietaire->etablissement);
        }

       // dd($etablissements);  
        return view('etablissement.search_etablissement')->with('etablissements', $etablissements);
    }
    public function list_etablissement()
    {
        //dd('coucou');
        if (Auth()->user()->role == "admin_par_region") {
            $etablissements = DB::table('communes')
                ->join('etablissements as a', 'a.commune_id', '=', 'communes.id')
                ->join('proprietaires', 'proprietaires.id', '=', 'a.proprietaire_id')
                ->join('etablissements as b', 'b.proprietaire_id', '=', 'proprietaires.id')
                ->select('*')
                ->where('region', '=', Auth()->user()->region_user)->orderBy('b.created_at', 'desc')->paginate(8);
        } else {
            $etablissements = DB::table('proprietaires')
                ->join('etablissements', 'etablissements.proprietaire_id', '=', 'proprietaires.id')
                ->select('*')
                ->orderBy('etablissements.created_at', 'desc')->paginate(8);
        }
        //dd($etablissements);

        return view('etablissement.list_etablissement')->with('etablissements', $etablissements);
    }

    //**********************Detail de proprietaire et etablissement

    public function detail_etab_proprietaire($id)
    {
        $etablissement = Etablissement::find($id);

        // dd($etablissement);
        return view('etablissement.detail_etablissement')->with('etablissement', $etablissement);
    }

    //**********************Liste pour Sélectionner l'etablissement à mutter avec proprietaire existant

    public function list_mutation_proprio_exist()
    {
        $etablissements = Etablissement::all();

        return view('etablissement.list_mutation_proprio_exist')->with('etablissements', $etablissements);
    }

    // *********************Formulaire de mutation avec proprietaire existant

    public function form_mutation_etablissement_exist($id)
    {
        $etablissement = Etablissement::find($id);
        $cin_proprio = Proprietaire::all();
        // dd($etablissement);
        return view('etablissement.form_mutation_proprio_exist')
            ->with('etablissement', $etablissement)
            ->with('proprietaires', $cin_proprio);
    }

    //   **********************recuperer l'information du proprietaire à partir du cin

    public function get_proprietaire($cin)
    {
        $res = DB::table('proprietaires')
            ->select('nom', 'id', 'adresse', 'num_tel', 'lien', 'email', 'fokontany_id')
            ->where('cin', '=', $cin)->get();

        $fokotany = DB::table('fokontanies')
            ->select('fokotany')
            ->where('id', '=', $res[0]->fokontany_id)->get();

        return response()->json([
            'status' => 400,
            'proprietaire' => $res,
            'fokotany' => $fokotany,
        ]);
    }



    // ****************************carte statistique

    public function carte_statistique($id)
    {
        $etablissement = Etablissement::find($id);

        ini_set('max_execution_time', 600);
        $tab = explode("-", $etablissement->identification_stat);
        $activite = $etablissement->activite->categorie;
        $lien = $etablissement->proprietaire->lien;
        $date_now = Carbon::now()->isoFormat('DD/MM/YYYY');
        $region = $tab[0];
        $annee = $tab[1];
        $code = $tab[2];
        PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.pdf_carte_statistique', compact('etablissement', 'activite', 'region', 'annee', 'code', 'lien', 'date_now'));

        return $pdf->download('carte' . '_' . $etablissement->proprietaire->nom . '.pdf');
    }

    // **************liste des etabissement pour Sélectionner l'etablissement obtenir le cretificat d'existence 

    public function list_etab_certificat()
    {
        $etablissements = Etablissement::getEtabUser();
        return view('etablissement.list_etab_obtenir_certificat')->with('etablissements', $etablissements);
    }

    //  ***********************formulaire d'ajout de quittance pour le certificat d'existence

    public function form_quittance_certificat_existence($id)
    {

        $etablissement = Etablissement::find($id);
        return view('etablissement.form_quittance_certificat_existence')->with('etablissement', $etablissement);
    }

    // *****************************ajout de quittance pour le certificat d'existence

    public function ajout_quittance_certificat_existence(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'id_etab' => 'required',
            'num_quitance' => 'required',
            'prix' => 'required',
            'type_quitance' => 'required',
        ]);

        $verif_num_quitance = DB::table('quitances')
            ->select('num_quitance')
            ->where('num_quitance', '=', $request->input('num_quitance'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (!is_null($verif_num_quitance) && $verif_num_quitance->num_quitance == $request->input('num_quitance')) {
            return response()->json([
                'status' => 400,
                'error' => " Numero du quittance existe deja !!! ",
            ]);
        } else {
            $quittance = new Quitance();
            $quittance->etablissement_id = $request->input('id_etab');
            $quittance->num_quitance = $request->input('num_quitance');
            $quittance->type = $request->input('type_quitance');
            $quittance->prix = $request->input('prix');
            $quittance->save();
            return response()->json([
                'status' => 200,
                'message' => " Numéro quittance enregistré avec succèss !!! ",
            ]);
        }
    }

    // ***************************generer un certificat d'existence en pdf

    public function certificat_existence($id)
    {

        $etablissement = Etablissement::find($id);
        ini_set('max_execution_time', 600);
        $categorie_Etab=Categorie::getCategorieEtab($id);
        $region_Etab = Region::getRegionEtablissement($id);
        $district_Etab = District::getDistrictEtablissement($id);
        $commune_Etab = Commune::getCommuneEtablissement($id);
        $nationalite_Prop = Nationalite::getNationaliteProp($id);
        $fokontany_Etab = Fokontany::getFokontanyEtablissement($id);
        $tab = explode("-", $etablissement->identification_stat);
        $activite = $etablissement->activite_princ;
        $lien = $etablissement->proprietaires->first()->lien;
        $date_now = Carbon::now()->isoFormat('DD/MM/YYYY');
        $region = $tab[0];
        $annee = $tab[1];
        $code = $tab[2];
        if ($region[0] == "1") $province = "Antananarivo";
        elseif ($region[0] == "2") $province = "Fianarantsoa";
        elseif ($region[0] == "3") $province = "Toamasina";
        elseif ($region[0] == "4") $province = "Mahajanga";
        elseif ($region[0] == "5") $province = "Toliara";
        else $province = "Antsiranana";

        $get_type = DB::table('quitances')
            ->select('type', 'created_at')
            ->where([
                ['etablissement_id', '=', $id],
                ['type', '<>', 'existence'],
                ['type', '<>', 'annulation'],
            ])->orderBy('created_at', 'desc')->first();

        if (!is_null($get_type)) {
            $type = $get_type->type;
            $date_type = Carbon::parse($get_type->created_at)->isoFormat('DD/MM/YYYY');
        } else {
            $data =  DB::table('etablissements')
                ->select('type', 'created_at')
                ->where('id', '=', $id)
                ->orderBy('created_at', 'desc')->first();
            $type = $data->type;
            $date_type = Carbon::parse($data->created_at)->isoFormat('DD/MM/YYYY');
        }

        $date_now = Carbon::now()->isoFormat('DD/MM/YYYY');

        PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.certificat_existence', compact('etablissement','nationalite_Prop', 'categorie_Etab', 'region_Etab','district_Etab','commune_Etab','fokontany_Etab', 'annee', 'code', 'lien', 'date_now', 'province', 'type', 'date_type', 'date_now'));

        return $pdf->download('Cert_existence' . '_' . $etablissement->proprietaires->first()->nom . '.pdf');
    }

    // ******************afficher liste des etablissement pour l'annuler

    public function list_annulation_etablissement()
    {
        $etablissements = Etablissement::getEtabUser();
        //  dd($etablissements);
        return view('etablissement.list_annulation_etablissement')->with('etablissements', $etablissements);
    }

    //************************annuler l'etablissement Sélectionner

    public function annulation_etablissement($id)
    {
        $etablissement = Etablissement::find($id);
        $etablissement->type = "Annulation";
        $etablissement->update();

        return response()->json([
            'status' => 200,
            'message' => 'l\'annulation de l\'etablissement ' . $etablissement->identification_stat . ' a été avec success',
        ]);
    }

    // **********************generer certificat d'annulation en pdf

    public function certificat_annulation($id)
    {

        $etablissement = Etablissement::find($id);

        ini_set('max_execution_time', 600);
        $tab = explode("-", $etablissement->identification_stat);
        $activite = $etablissement->activite_princ;
        $lien = $etablissement->proprietaires->first()->lien;
        $date_creation = Carbon::parse($etablissement->created_at)->isoFormat('DD/MM/YYYY');
        $date_now = Carbon::now()->isoFormat('DD/MM/YYYY');
        $region = $tab[0];
        $annee = $tab[1];
        $code = $tab[2];
        if ($region[0] == "1") $province = "Antananarivo";
        elseif ($region[0] == "2") $province = "Fianarantsoa";
        elseif ($region[0] == "3") $province = "Toamasina";
        elseif ($region[0] == "4") $province = "Mahajanga";
        elseif ($region[0] == "5") $province = "Toliara";
        else $province = "Antsiranana";

        PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.certificat_annulation', compact('etablissement', 'activite', 'region', 'annee', 'code', 'lien', 'date_now', 'province', 'date_creation'));

        return $pdf->download('Cert_annulation' . '_' . $etablissement->proprietaires->first()->nom . '.pdf');
    }

    // ******************************liste des etablissement annulé

    public function list_reprise_etablissement()
    {

        {
            $etablissements = Etablissement::where('type', '=', 'Annulation')->get();
            return view('etablissement.list_reprise_etablissement')->with('etablissements', $etablissements);
        }
       
    }

    // ****************formulaire d'ajout de quittance pour la reprise d'etablissement

    public function form_reprise_etablissement($id)
    {
        $etablissement = Etablissement::find($id);

        return view('etablissement.form_reprise_etablissement')->with('etablissement', $etablissement);
    }

    // ****************formulaire d'ajout de quittance pour la reprise d'etablissement

    public function ajout_quittance_reprise_etablissement(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'id_etab' => 'required',
            'num_quitance' => 'required',
            'prix' => 'required',
            'type_quitance' => 'required',
        ]);

        $etablissement = Etablissement::find($request->input('id_etab'));

        $verif_num_quitance = DB::table('quitances')
            ->select('num_quitance')
            ->where('num_quitance', '=', $request->input('num_quitance'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (!is_null($verif_num_quitance) && $verif_num_quitance->num_quitance == $request->input('num_quitance')) {
            return response()->json([
                'status' => 400,
                'error' => " Numero du quittance existe deja !!! ",
            ]);
        } else {
            $quittance = new Quitance();
            $quittance->etablissement_id = $request->input('id_etab');
            $quittance->num_quitance = $request->input('num_quitance');
            $quittance->type = $request->input('type_quitance');
            $quittance->prix = $request->input('prix');

            $etablissement->type = $request->input('type_quitance');
            $etablissement->update();
            $quittance->save();
            return response()->json([
                'status' => 200,
                'message' => " Numéro quittance enregistré avec succèss !!! ",
            ]);
        }
    }
}
