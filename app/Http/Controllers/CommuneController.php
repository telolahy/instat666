<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommuneController extends Controller
{
    public function affiche_form_commune()
    {
        return view('commune.ajout_commune');
    }

    public function ajout_commune(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_region' => 'required',
            'region' => 'required',
            'code_district' => 'required',
            'district' => 'required',
            'code_commune' => 'required',
            'commune' => 'required',
        ]);

        $verif_region = DB::table('communes')
            ->select('code_region')
            ->where('code_region', '=', $request->input('code_region'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (!is_null($verif_region) && $verif_region->code_region == $request->input('code_region')) {
            return response()->json([
                'status' => 400,
                'error' => " Code de la commune existe deja !!! ",
            ]);
        } else {
            $commune = new Commune();

            $commune->code_region = $request->input('code_region');
            $commune->region = $request->input('region');
            $commune->code_district = $request->input('code_district');
            $commune->district = $request->input('district');
            $commune->code_commune = $request->input('code_commune');
            $commune->commune = $request->input('commune');
            $commune->save();
            return response()->json([
                'status' => 200,
                'message' => " Commune ajouté avec succèss !!!",
            ]);
        }
    }

    public function list_commune()
    {
        $communes = Commune::all();
        return view('commune.list_commune')->with('communes', $communes);
    }


    public function supprimer_commune($id)
    {
        $commune = Commune::find($id);
        $commune->delete();
        return response()->json([
            'status' => 200,
            'message' => " Commune supprimé avec succèss !!!",
        ]);
    }

    public function affiche_form_edit_commune($id)
    {
        $commune = Commune::find($id);
        return view('commune.edit_commune')->with('commune', $commune);
    }

    public function modifier_commune(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_region' => 'required',
            'region' => 'required',
            'code_district' => 'required',
            'district' => 'required',
            'code_commune' => 'required',
            'commune' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } else {
            $commune = Commune::find($request->input('id'));
            $commune->code_region = $request->input('code_region');
            $commune->region = $request->input('region');
            $commune->code_district = $request->input('code_district');
            $commune->district = $request->input('district');
            $commune->code_commune = $request->input('code_commune');
            $commune->commune = $request->input('commune');
            $commune->update();
            return response()->json([
                'status' => 200,
                'message' => " Commune modifié avec succèss !!!",
            ]);
        }
    }
}
