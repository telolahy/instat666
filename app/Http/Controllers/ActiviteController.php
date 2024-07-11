<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ActiviteController extends Controller
{
    public function affiche_form_activite()
    {
        return view('activite.ajout_activite');
    }

    public function ajout_activite(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'categorie' => 'required',
            'classe' => 'required',
            'description' => 'required',
        ]);

        $verif_categorie = DB::table('activites')
            ->select('categorie')
            ->where('categorie', '=', $request->input('categorie'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (!is_null($verif_categorie) && $verif_categorie->categorie == $request->input('categorie')) {
            return response()->json([
                'status' => 400,
                'error' => " Le categorie existe deja !!! ",
            ]);
        } else {
            $activite = new Activite();

            $activite->categorie = $request->input('categorie');
            $activite->classe = $request->input('classe');
            $activite->description = $request->input('description');
            $activite->save();
            return response()->json([
                'status' => 200,
                'message' => " Categorie ajouté avec succèss !!!",
            ]);
        }
    }

    public function list_activite()
    {
        $activites = Activite::all();
        return view('activite.list_activite')->with('activites', $activites);
    }


    public function supprimer_activite($id)
    {
        $activite = Activite::find($id);
        $activite->delete();
        return response()->json([
            'status' => 200,
            'message' => " Activité supprimé avec succèss !!!",
        ]);
    }

    public function affiche_form_edit_activite($id)
    {
        $activite = Activite::find($id);
        return view('activite.edit_activite')->with('activite', $activite);
    }

    public function modifier_activite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categorie' => 'required',
            'classe' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            $activite = Activite::find($request->input('id'));
            $activite->categorie = $request->input('categorie');
            $activite->classe = $request->input('classe');
            $activite->description = $request->input('description');
            $activite->update();
            return response()->json([
                'status' => 200,
                'message' => " Activité modifié avec succèss !!!",
            ]);
        }
    }
}
