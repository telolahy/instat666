<?php

namespace App\Http\Controllers;

use App\Models\Nationalite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NationaliteController extends Controller
{
    public function affiche_form_nationalite()
    {
        return view('nationalite.ajout_nationalite');
    }

    public function ajout_nationalite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_nationalite' => 'required',
            'nationalite' => 'required',
        ]);

        $verif_nationalite = DB::table('nationalites')
            ->select('code_nationalite')
            ->where('code_nationalite', '=', $request->input('code_nationalite'));

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (isset($verif_nationalite)) {
            return response()->json([
                'status' => 400,
                'error' => " Le code existe deja !!! ",
            ]);
        } else {
            $nationalite = new Nationalite();

            $nationalite->code_nationalite = $request->input('code_nationalite');
            $nationalite->nationalite = $request->input('nationalite');
            $nationalite->save();
            return response()->json([
                'status' => 200,
                'message' => " Nationalité ajouté avec succèss !!!",
            ]);
        }
    }

    public function list_nationalite()
    {
        $nationalites = Nationalite::all();
        return view('nationalite.list_nationalite')->with('nationalites', $nationalites);
    }


    public function supprimer_nationalite($id)
    {
        $nationalite = Nationalite::find($id);
        $nationalite->delete();
        return response()->json([
            'status' => 200,
            'message' => "Nationalité supprimé avec succèss !!!",
        ]);
    }

    public function affiche_form_edit_nationalite($id)
    {
        $nationalite = Nationalite::find($id);
        return view('nationalite.edit_nationalite')->with('nationalite', $nationalite);
    }

    public function modifier_nationalite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_nationalite' => 'required',
            'nationalite' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            $nationalite = Nationalite::find($request->input('id'));
            $nationalite->code_nationalite = $request->input('code_nationalite');
            $nationalite->nationalite = $request->input('nationalite');
            $nationalite->update();
            return response()->json([
                'status' => 200,
                'message' => " Nationalité modifié avec succèss !!!",
            ]);
        }
    }
}
