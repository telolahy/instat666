<?php

namespace App\Http\Controllers;

use App\Models\Fokontany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FokontanyController extends Controller
{
    public function affiche_form_fokontany()
    {
        return view('fokontany.ajout_fokontany');
    }

    public function ajout_fokontany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_region' => 'required',
            'region' => 'required',
            'code_district' => 'required',
            'district' => 'required',
            'code_commune' => 'required',
            'commune' => 'required',
            'code_fokotany' => 'required',
            'fokotany' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            $fokotany = new Fokontany();

            $fokotany->code_region = $request->input('code_region');
            $fokotany->region = $request->input('region');
            $fokotany->code_district = $request->input('code_district');
            $fokotany->district = $request->input('district');
            $fokotany->code_commune = $request->input('code_commune');
            $fokotany->commune = $request->input('commune');
            $fokotany->code_fokotany = $request->input('code_fokotany');
            $fokotany->fokotany = $request->input('fokotany');
            $fokotany->save();
            return response()->json([
                'status' => 200,
                'message' => " Fokontany ajouté avec succèss !!!",
            ]);
        }
    }

    public function list_fokontany()
    {
        $fokotany = Fokontany::all();
        return view('fokontany.list_fokontany')->with('fokotany', $fokotany);
    }


    public function supprimer_fokontany($id)
    {
        $fokotany = Fokontany::find($id);
        $fokotany->delete();
        return response()->json([
            'status' => 200,
            'message' => " Fokontany supprimé avec succèss !!!",
        ]);
    }

    public function affiche_form_edit_fokontany($id)
    {
        $fokotany = Fokontany::find($id);
        return view('fokontany.edit_fokontany')->with('fokotany', $fokotany);
    }

    public function modifier_fokontany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_region' => 'required',
            'region' => 'required',
            'code_district' => 'required',
            'district' => 'required',
            'code_commune' => 'required',
            'commune' => 'required',
            'code_fokotany' => 'required',
            'fokotany' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            $fokotany = Fokontany::find($request->input('id'));
            $fokotany->code_region = $request->input('code_region');
            $fokotany->region = $request->input('region');
            $fokotany->code_district = $request->input('code_district');
            $fokotany->district = $request->input('district');
            $fokotany->code_commune = $request->input('code_commune');
            $fokotany->commune = $request->input('commune');
            $fokotany->code_fokotany = $request->input('code_fokotany');
            $fokotany->fokotany = $request->input('fokotany');
            $fokotany->update();
            return response()->json([
                'status' => 200,
                'message' => " Fokotany modifié avec succèss !!!",
            ]);
        }
    }
}
