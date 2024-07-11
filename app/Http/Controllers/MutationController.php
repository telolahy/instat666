<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activite;
use App\Models\Ancien_proprietaire;
use App\Models\Commune;
use App\Models\Etablissement;
use App\Models\Fokontany;
use App\Models\Juridique;
use App\Models\Lchef;
use App\Models\Nationalite;
use App\Models\Proprietaire;
use App\Models\Quitance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MutationController extends Controller
{

    // *************************************valider(ajouter) la mutation d'etablissement

    public function ajout_mutation(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'cin' => 'required',
            'nom' => 'required',
            'adresse' => 'required',
            'lien' => 'required',
            'num_tel' => 'required',
            'num_quitance' => 'required',
            'prix' => 'required',
            'type_quitance' => 'required',
        ]);

        $proprietaire = Proprietaire::find($request->input('id_proprietaire'));
        $etablissement = Etablissement::find($request->input('id_etab'));

        $getEtab_a_muter = DB::table('etablissements')
            ->select('id', 'identification_stat')
            ->where('id', '=', $request->input('id_etab'))->first();

        $id_commune = DB::table('communes')
            ->select('id')
            ->where('commune', '=', $request->input('commune_proprio'))->first();
        $id_nationalite = DB::table('nationalites')
            ->select('id')
            ->where('nationalite', '=', $request->input('nationalite_proprietaire'))->first();
        $id_fokontany = DB::table('fokontanies')
            ->select('id')
            ->where('fokotany', '=', $request->input('fokotany_proprietaire'))->first();

        $getEtab = DB::table('etablissements')
            ->select('num_entreprise', 'identification_stat')
            ->where('proprietaire_id', '=', $request->input('id_proprietaire'))->get();

        $verif_cin = DB::table('proprietaires')
            ->select('cin')
            ->where('cin', '=', $request->input('cin'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (!is_null($verif_cin) && $verif_cin->cin == $request->input('cin')) {
            return response()->json([
                'status' => 400,
                'error' => " Numero CIN existe deja !!! ",
            ]);
        } else {

            if ($request->input('ancien_lien') == 0) {
                $nouveau_proprietaire = new Proprietaire();
                $nouveau_proprietaire->nom = $request->input('nom');
                $nouveau_proprietaire->cin = $request->input('cin');
                $nouveau_proprietaire->adresse = $request->input('adresse');
                $nouveau_proprietaire->lien = $request->input('lien');
                $nouveau_proprietaire->email = $request->input('email');
                $nouveau_proprietaire->num_tel = $request->input('num_tel');
                $nouveau_proprietaire->commune_id = $id_commune->id;
                $nouveau_proprietaire->fokontany_id = $id_fokontany->id;
                $nouveau_proprietaire->nationalite_id = $id_nationalite->id;
                $nouveau_proprietaire->save();

                $id_proprietaire = DB::table('proprietaires')
                    ->select('id')
                    ->where('cin', '=', $request->input('cin'))->first();
                $etablissement_mutter = Etablissement::find($getEtab_a_muter->id);
                $etablissement_mutter->proprietaire_id = $id_proprietaire->id;
                $etablissement_mutter->type = $request->input('type_quitance');
                $etablissement_mutter->update();

                $ancien_proprietaire = new Ancien_proprietaire();

                $ancien_proprietaire->nom = $request->input('ancien_nom');
                $ancien_proprietaire->cin = $request->input('ancien_cin');
                $ancien_proprietaire->adresse = $request->input('ancien_adresse');
                $ancien_proprietaire->commune = $request->input('ancien_commune');
                $ancien_proprietaire->email = $request->input('ancien_email');
                $ancien_proprietaire->num_tel = $request->input('ancien_num_tel');
                $ancien_proprietaire->etablissement_id = $getEtab_a_muter->id;
                $ancien_proprietaire->save();

                $quittance = new Quitance();
                $quittance->etablissement_id = $request->input('id_etab');
                $quittance->num_quitance = $request->input('num_quitance');
                $quittance->type = $request->input('type_quitance');
                $quittance->prix = $request->input('prix');
                $quittance->save();

                $proprietaire->delete();
                return response()->json([
                    'status' => 200,
                    'message' => " Etablissement muté avec succèss !!! ",
                ]);
            } else if ($request->input('ancien_lien') == 1) {

                if ($getEtab_a_muter->identification_stat == $getEtab[0]->identification_stat) {
                    $autre_etab = DB::table('etablissements')
                        ->select('id', 'num_entreprise', 'identification_stat')
                        ->where('num_entreprise', '=', $getEtab[0]->identification_stat)->first();
                    $etablissement = Etablissement::find($autre_etab->id);
                    $etablissement->num_entreprise = '';

                    $nouveau_proprietaire = new Proprietaire();
                    $nouveau_proprietaire->nom = $request->input('nom');
                    $nouveau_proprietaire->cin = $request->input('cin');
                    $nouveau_proprietaire->adresse = $request->input('adresse');
                    $nouveau_proprietaire->lien = $request->input('lien');
                    $nouveau_proprietaire->email = $request->input('email');
                    $nouveau_proprietaire->num_tel = $request->input('num_tel');
                    $nouveau_proprietaire->commune_id = $id_commune->id;
                    $nouveau_proprietaire->fokontany_id = $id_fokontany->id;
                    $nouveau_proprietaire->nationalite_id = $id_nationalite->id;
                    $nouveau_proprietaire->save();

                    $id_proprietaire = DB::table('proprietaires')
                        ->select('id')
                        ->where('cin', '=', $request->input('cin'))->first();
                    $etablissement_mutter = Etablissement::find($getEtab_a_muter->id);
                    $etablissement_mutter->proprietaire_id = $id_proprietaire->id;
                    $etablissement_mutter->type = $request->input('type_quitance');


                    $ancien_proprietaire = new Ancien_proprietaire();

                    $ancien_proprietaire->nom = $request->input('ancien_nom');
                    $ancien_proprietaire->cin = $request->input('ancien_cin');
                    $ancien_proprietaire->adresse = $request->input('ancien_adresse');
                    $ancien_proprietaire->commune = $request->input('ancien_commune');
                    $ancien_proprietaire->email = $request->input('ancien_email');
                    $ancien_proprietaire->num_tel = $request->input('ancien_num_tel');
                    $ancien_proprietaire->etablissement_id = $getEtab_a_muter->id;

                    $proprietaire->lien = $request->input('ancien_lien') - 1;

                    $quittance = new Quitance();
                    $quittance->etablissement_id = $request->input('id_etab');
                    $quittance->num_quitance = $request->input('num_quitance');
                    $quittance->type = $request->input('type_quitance');
                    $quittance->prix = $request->input('prix');
                    $quittance->save();

                    $etablissement->update();
                    $ancien_proprietaire->save();
                    $etablissement_mutter->update();
                    $proprietaire->update();
                } else {

                    $nouveau_proprietaire = new Proprietaire();
                    $nouveau_proprietaire->nom = $request->input('nom');
                    $nouveau_proprietaire->cin = $request->input('cin');
                    $nouveau_proprietaire->adresse = $request->input('adresse');
                    $nouveau_proprietaire->lien = $request->input('lien');
                    $nouveau_proprietaire->email = $request->input('email');
                    $nouveau_proprietaire->num_tel = $request->input('num_tel');
                    $nouveau_proprietaire->commune_id = $id_commune->id;
                    $nouveau_proprietaire->fokontany_id = $id_fokontany->id;
                    $nouveau_proprietaire->nationalite_id = $id_nationalite->id;
                    $nouveau_proprietaire->save();

                    $id_proprietaire = DB::table('proprietaires')
                        ->select('id')
                        ->where('cin', '=', $request->input('cin'))->first();
                    $etablissement_mutter = Etablissement::find($getEtab_a_muter->id);
                    $etablissement_mutter->num_entreprise = '';
                    $etablissement_mutter->proprietaire_id = $id_proprietaire->id;
                    $etablissement_mutter->type = $request->input('type_quitance');


                    $ancien_proprietaire = new Ancien_proprietaire();

                    $ancien_proprietaire->nom = $request->input('ancien_nom');
                    $ancien_proprietaire->cin = $request->input('ancien_cin');
                    $ancien_proprietaire->adresse = $request->input('ancien_adresse');
                    $ancien_proprietaire->commune = $request->input('ancien_commune');
                    $ancien_proprietaire->email = $request->input('ancien_email');
                    $ancien_proprietaire->num_tel = $request->input('ancien_num_tel');
                    $ancien_proprietaire->etablissement_id = $getEtab_a_muter->id;

                    $proprietaire->lien = $request->input('ancien_lien') - 1;

                    $quittance = new Quitance();
                    $quittance->etablissement_id = $request->input('id_etab');
                    $quittance->num_quitance = $request->input('num_quitance');
                    $quittance->type = $request->input('type_quitance');
                    $quittance->prix = $request->input('prix');
                    $quittance->save();

                    $ancien_proprietaire->save();
                    $etablissement_mutter->update();
                    $proprietaire->update();
                }
                return response()->json([
                    'status' => 200,
                    'message' => " Etablissement muté avec succèss !!! ",
                ]);
            } else if ($request->input('ancien_lien') == 2) {
                if ($getEtab_a_muter->identification_stat == $getEtab[0]->identification_stat) {
                    $autre_etab = DB::table('etablissements')
                        ->select('id', 'num_entreprise', 'identification_stat')
                        ->where('num_entreprise', '=', $getEtab[0]->identification_stat)->first();
                    $etablissement = Etablissement::find($autre_etab->id);
                    $etablissement->num_entreprise = '';

                    $nouveau_proprietaire = new Proprietaire();
                    $nouveau_proprietaire->nom = $request->input('nom');
                    $nouveau_proprietaire->cin = $request->input('cin');
                    $nouveau_proprietaire->adresse = $request->input('adresse');
                    $nouveau_proprietaire->lien = $request->input('lien');
                    $nouveau_proprietaire->email = $request->input('email');
                    $nouveau_proprietaire->num_tel = $request->input('num_tel');
                    $nouveau_proprietaire->commune_id = $id_commune->id;
                    $nouveau_proprietaire->fokontany_id = $id_fokontany->id;
                    $nouveau_proprietaire->nationalite_id = $id_nationalite->id;
                    $nouveau_proprietaire->save();

                    $id_proprietaire = DB::table('proprietaires')
                        ->select('id')
                        ->where('cin', '=', $request->input('cin'))->first();
                    $etablissement_mutter = Etablissement::find($getEtab_a_muter->id);
                    $etablissement_mutter->proprietaire_id = $id_proprietaire->id;

                    $ancien_proprietaire = new Ancien_proprietaire();

                    $ancien_proprietaire->nom = $request->input('ancien_nom');
                    $ancien_proprietaire->cin = $request->input('ancien_cin');
                    $ancien_proprietaire->adresse = $request->input('ancien_adresse');
                    $ancien_proprietaire->commune = $request->input('ancien_commune');
                    $ancien_proprietaire->email = $request->input('ancien_email');
                    $ancien_proprietaire->num_tel = $request->input('ancien_num_tel');
                    $ancien_proprietaire->etablissement_id = $getEtab_a_muter->id;

                    $proprietaire->lien = $request->input('ancien_lien') - 1;


                    $quittance = new Quitance();
                    $quittance->etablissement_id = $request->input('id_etab');
                    $quittance->num_quitance = $request->input('num_quitance');
                    $quittance->type = $request->input('type_quitance');
                    $quittance->prix = $request->input('prix');
                    $quittance->save();

                    $etablissement->update();
                    $ancien_proprietaire->save();
                    $etablissement_mutter->update();
                    $proprietaire->update();
                } else if ($getEtab_a_muter->identification_stat == $getEtab[1]->identification_stat) {


                    $nouveau_proprietaire = new Proprietaire();
                    $nouveau_proprietaire->nom = $request->input('nom');
                    $nouveau_proprietaire->cin = $request->input('cin');
                    $nouveau_proprietaire->adresse = $request->input('adresse');
                    $nouveau_proprietaire->lien = $request->input('lien');
                    $nouveau_proprietaire->email = $request->input('email');
                    $nouveau_proprietaire->num_tel = $request->input('num_tel');
                    $nouveau_proprietaire->commune_id = $id_commune->id;
                    $nouveau_proprietaire->fokontany_id = $id_fokontany->id;
                    $nouveau_proprietaire->nationalite_id = $id_nationalite->id;
                    $nouveau_proprietaire->save();

                    $id_proprietaire = DB::table('proprietaires')
                        ->select('id')
                        ->where('cin', '=', $request->input('cin'))->first();
                    $etablissement_mutter = Etablissement::find($getEtab_a_muter->id);
                    $etablissement_mutter->proprietaire_id = $id_proprietaire->id;
                    $etablissement_mutter->num_entreprise = '';
                    $etablissement_mutter->type = $request->input('type_quitance');

                    $autre_etab = DB::table('etablissements')
                        ->select('id', 'num_entreprise', 'identification_stat')
                        ->where('identification_stat', '=', $getEtab[2]->identification_stat)->first();
                    $etablissement = Etablissement::find($autre_etab->id);
                    $etablissement->num_entreprise = $getEtab[0]->identification_stat;

                    $ancien_proprietaire = new Ancien_proprietaire();

                    $ancien_proprietaire->nom = $request->input('ancien_nom');
                    $ancien_proprietaire->cin = $request->input('ancien_cin');
                    $ancien_proprietaire->adresse = $request->input('ancien_adresse');
                    $ancien_proprietaire->commune = $request->input('ancien_commune');
                    $ancien_proprietaire->email = $request->input('ancien_email');
                    $ancien_proprietaire->num_tel = $request->input('ancien_num_tel');
                    $ancien_proprietaire->etablissement_id = $getEtab_a_muter->id;

                    $proprietaire->lien = $request->input('ancien_lien') - 1;


                    $quittance = new Quitance();
                    $quittance->etablissement_id = $request->input('id_etab');
                    $quittance->num_quitance = $request->input('num_quitance');
                    $quittance->type = $request->input('type_quitance');
                    $quittance->prix = $request->input('prix');
                    $quittance->save();

                    $etablissement->update();
                    $ancien_proprietaire->save();
                    $etablissement_mutter->update();
                    $proprietaire->update();
                } else {
                    $nouveau_proprietaire = new Proprietaire();
                    $nouveau_proprietaire->nom = $request->input('nom');
                    $nouveau_proprietaire->cin = $request->input('cin');
                    $nouveau_proprietaire->adresse = $request->input('adresse');
                    $nouveau_proprietaire->lien = $request->input('lien');
                    $nouveau_proprietaire->email = $request->input('email');
                    $nouveau_proprietaire->num_tel = $request->input('num_tel');
                    $nouveau_proprietaire->commune_id = $id_commune->id;
                    $nouveau_proprietaire->fokontany_id = $id_fokontany->id;
                    $nouveau_proprietaire->nationalite_id = $id_nationalite->id;
                    $nouveau_proprietaire->save();

                    $id_proprietaire = DB::table('proprietaires')
                        ->select('id')
                        ->where('cin', '=', $request->input('cin'))->first();
                    $etablissement_mutter = Etablissement::find($getEtab_a_muter->id);
                    $etablissement_mutter->num_entreprise = '';
                    $etablissement_mutter->proprietaire_id = $id_proprietaire->id;
                    $etablissement_mutter->type = $request->input('type_quitance');


                    $ancien_proprietaire = new Ancien_proprietaire();

                    $ancien_proprietaire->nom = $request->input('ancien_nom');
                    $ancien_proprietaire->cin = $request->input('ancien_cin');
                    $ancien_proprietaire->adresse = $request->input('ancien_adresse');
                    $ancien_proprietaire->commune = $request->input('ancien_commune');
                    $ancien_proprietaire->email = $request->input('ancien_email');
                    $ancien_proprietaire->num_tel = $request->input('ancien_num_tel');
                    $ancien_proprietaire->etablissement_id = $getEtab_a_muter->id;

                    $proprietaire->lien = $request->input('ancien_lien') - 1;

                    $quittance = new Quitance();
                    $quittance->etablissement_id = $request->input('id_etab');
                    $quittance->num_quitance = $request->input('num_quitance');
                    $quittance->type = $request->input('type_quitance');
                    $quittance->prix = $request->input('prix');
                    $quittance->save();

                    $ancien_proprietaire->save();
                    $etablissement_mutter->update();
                    $proprietaire->update();
                }
                return response()->json([
                    'status' => 200,
                    'message' => " Etablissement muté avec succèss !!! ",
                ]);
            }
        }
    }

    // ***************************ajout mutation avec un proprietaire existant


    public function ajout_mutation_proprio_existant(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'id_proprietaire' => 'required',
            'id_etab' => 'required',
            'id_nouveau' => 'required',
            'num_quitance' => 'required',
            'prix' => 'required',
            'type_quitance' => 'required',
        ]);

        $roprietaire = Proprietaire::find($request->input('id_proprietaire'));
        $etablissement = Etablissement::find($request->input('id_etab'));
        $nouveau_proprietaire = Proprietaire::find($request->input('id_nouveau'));

        $getEtab_a_muter = DB::table('etablissements')
            ->select('id', 'identification_stat')
            ->where('id', '=', $request->input('id_etab'))->first();


        $getEtab_ancien_proprietaire = DB::table('etablissements')
            ->select('identification_stat')
            ->where('proprietaire_id', '=', $request->input('id_nouveau'))->orderBy('created_at', 'desc')->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {

            if ($request->input('ancien_lien') == 0) {

                $etablissement_mutter = Etablissement::find($getEtab_a_muter->id);
                $etablissement_mutter->proprietaire_id = $request->input('id_nouveau');
                $etablissement_mutter->type = $request->input('type_quitance');
                $etablissement_mutter->update();

                $ancien_proprietaire = new Ancien_proprietaire();

                $ancien_proprietaire->nom = $request->input('ancien_nom');
                $ancien_proprietaire->cin = $request->input('ancien_cin');
                $ancien_proprietaire->adresse = $request->input('ancien_adresse');
                $ancien_proprietaire->commune = $request->input('ancien_commune');
                $ancien_proprietaire->email = $request->input('ancien_email');
                $ancien_proprietaire->num_tel = $request->input('ancien_num_tel');
                $ancien_proprietaire->etablissement_id = $getEtab_a_muter->id;
                $ancien_proprietaire->save();

                $nouveau_proprietaire->lien = $request->input('ancien_lien') + 1;
                $nouveau_proprietaire->update();

                $quittance = new Quitance();
                $quittance->etablissement_id = $request->input('id_etab');
                $quittance->num_quitance = $request->input('num_quitance');
                $quittance->type = $request->input('type_quitance');
                $quittance->prix = $request->input('prix');
                $quittance->save();

                $roprietaire->delete();
                return response()->json([
                    'status' => 200,
                    'message' => " Etablissement muté avec succèss !!! ",
                ]);
            }
        }
    }
}
