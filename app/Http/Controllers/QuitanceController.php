<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Models\Quitance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuitanceController extends Controller
{
    public function affiche_form_quitance($id)
    {
       // dd('coucou'); 
        $etablissement = Etablissement::find($id);

        return view('admin_reg.quitance.ajout_quitance')->with('etablissement', $etablissement);
    }

    public function ajout_quitance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'num_quitance' => 'required',
            'etab_id' => 'required',
            'prix' => 'required',
        ]);

        $verif_quitance = DB::table('quitances')
            ->select('num_quitance')
            ->where('num_quitance', '=', $request->input('num_quitance'))->first();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => " Le(s) champ(s) ne doit pas être vide !!! ",
            ]);
        } elseif (!is_null($verif_quitance) && $verif_quitance->num_quitance == $request->input('num_quitance')) {
            return response()->json([
                'status' => 400,
                'error' => " Numero du quitance existe deja !!! ",
            ]);
        } else {
            $quitance = new Quitance();

            $quitance->etablissement_id = $request->input('etab_id');
            $quitance->num_quitance = $request->input('num_quitance');
            $quitance->type = $request->input('type_quitance');
            $quitance->prix = $request->input('prix');
            $etablissement = Etablissement::find($request->input('etab_id'));
            $etablissement->status = "Validé";
            $quitance->save();
            $etablissement->update();

            return response()->json([
                'status' => 200,
                'message' => " Etablissement validé avec succèss !!!",
            ]);
        }
    }
}
