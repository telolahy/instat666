<?php

namespace App\Http\Controllers;

use App\Models\Juridique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JuridiqueController extends Controller
{
    public function affiche_form_juridique()
    {
        return view('juridique.ajout_juridique');
    }

    public function ajout_juridique(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'alias_code_juridique' => 'required',
            'description_code_juridique' => 'required',
        ]);

        $verif_juridique = DB::table('juridiques')
            ->select('code')
            ->where('code', '=', $request->input('code'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (!is_null($verif_juridique) && $verif_juridique->code == $request->input('code')) {
            return response()->json([
                'status' => 400,
                'error' => " Juridique existe deja !!! ",
            ]);
        } else {
            $juridique = new Juridique();

            $juridique->code = $request->input('code');
            $juridique->alias_code_juridique = $request->input('alias_code_juridique');
            $juridique->description_code_juridique = $request->input('description_code_juridique');
            $juridique->save();
            return response()->json([
                'status' => 200,
                'message' => " Forme juridique ajouté avec succèss !!!",
            ]);
        }
    }

    public function list_juridique()
    {
        $juridiques = Juridique::all();
        return view('juridique.list_juridique')->with('juridiques', $juridiques);
    }


    public function supprimer_juridique($id)
    {
        $juridique = Juridique::find($id);
        $juridique->delete();
        return response()->json([
            'status' => 200,
            'message' => "Forme juridique supprimé avec succèss !!!",
        ]);
    }

    public function affiche_form_edit_juridique($id)
    {
        $juridique = Juridique::find($id);
        return view('juridique.edit_Juridique')->with('juridique', $juridique);
    }

    public function modifier_juridique(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'alias_code_juridique' => 'required',
            'description_code_juridique' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            $activite = Juridique::find($request->input('id'));
            $activite->code = $request->input('code');
            $activite->alias_code_juridique = $request->input('alias_code_juridique');
            $activite->description_code_juridique = $request->input('description_code_juridique');
            $activite->update();
            return response()->json([
                'status' => 200,
                'message' => " Forme Juridique modifié avec succèss !!!",
            ]);
        }
    }
}
