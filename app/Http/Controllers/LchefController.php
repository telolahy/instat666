<?php

namespace App\Http\Controllers;

use App\Models\Lchef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LchefController extends Controller
{
    public function affiche_form_lchef()
    {
        return view('lchef.ajout_lchef');
    }

    public function ajout_lchef(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qualité' => 'required',
            'lchef' => 'required',
            'description_lchef' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            $lchef = new Lchef();

            $lchef->qualité = $request->input('qualité');
            $lchef->lchef = $request->input('lchef');
            $lchef->description_lchef = $request->input('description_lchef');
            $lchef->save();
            return response()->json([
                'status' => 200,
                'message' => " Lchef ajouté avec succèss !!!",
            ]);
        }
    }

    public function list_lchef()
    {
        $lchefs = Lchef::all();
        return view('lchef.list_lchef')->with('lchefs', $lchefs);
    }


    public function supprimer_lchef($id)
    {
        $lchef = Lchef::find($id);
        $lchef->delete();
        return response()->json([
            'status' => 200,
            'message' => "Lchef supprimé avec succèss !!!",
        ]);
    }

    public function affiche_form_edit_lchef($id)
    {
        $lchef = Lchef::find($id);
        return view('lchef.edit_lchef')->with('lchef', $lchef);
    }

    public function modifier_lchef(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qualité' => 'required',
            'lchef' => 'required',
            'description_lchef' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            $activite = Lchef::find($request->input('id'));
            $activite->qualité = $request->input('qualité');
            $activite->lchef = $request->input('lchef');
            $activite->description_lchef = $request->input('description_lchef');
            $activite->update();
            return response()->json([
                'status' => 200,
                'message' => " Lchef modifié avec succèss !!!",
            ]);
        }
    }
}
