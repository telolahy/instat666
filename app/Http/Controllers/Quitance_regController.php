<?php

namespace App\Http\Controllers;

use App\Models\Quitance;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Quitance_regController extends Controller
{


    public function carte_statistique($id)
    {

        $etablissement = Etablissement::with('proprietaires')->find($id);

        $activite_desc= $etablissement->get_first_25_words($etablissement->activite_princ);
        $activite_desc1= $etablissement->get_first_25_words($etablissement->activite_sec1);
        $activite_desc2= $etablissement->get_first_15_words($etablissement->activite_sec2);


    
        $data ="INSTAT MADAGASCAR"."\n"."Sigle: ".$etablissement->sigle."\n"."Nom Proprietaire: ". $etablissement->proprietaires->first()->nom."\n"."Adresse Etab: ".$etablissement->adresse_etab. "\n"."CIN :". $etablissement->proprietaires->first()->cin;
        //$qrcode = QrCode::size(100)->generate($sigle);

        $qrcode = QrCode::format('svg')->size(100)->generate($data);

        $qrcodeBase64 = 'data:image/svg+xml;base64,' . base64_encode($qrcode);
        
        ini_set('max_execution_time', 600);
        $tab = explode("-", $etablissement->identification_stat);
        $categorie = Etablissement::getCategorieEtab($id);

        $lien = $etablissement->proprietaires->first()->lien;
        $date_now = Carbon::now()->isoFormat('DD/MM/YYYY');
        $region = $tab[0];
        $annee = $tab[1];
        $code = $tab[2];
        PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.pdf_carte_statistique', compact('etablissement', 'categorie', 'region', 'annee', 'code', 'lien', 'date_now','qrcodeBase64','activite_desc','activite_desc1','activite_desc2'));

        return $pdf->download('carte' . '_' . $etablissement->proprietaires->first()->nom . '.pdf');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function affiche_form_quitance($id)
    {
       // dd('coucou'); 
        $etablissement = Etablissement::find($id);

        return view('quitance.ajout_quitance')->with('etablissement', $etablissement);
    }


    public function ajout_quitance(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'num_quitance' => 'required',
            'etab_id' => 'required',
            'prix' => 'required',
        ]);
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $verif_quitance = DB::table('quitances')
            ->select('num_quitance')
            ->where('num_quitance', '=', $request->input('num_quitance'))->first();

        if (!is_null($verif_quitance) && $verif_quitance->num_quitance == $request->input('num_quitance')) 
        {
            return response()->json([
                'status' => 400,
                'error' => " Numero du quitance existe deja !!! ",
            ]);
        } 
        $quitance = new Quitance();

        $quitance->etablissement_id = $request->input('etab_id');
        $quitance->num_quitance = $request->input('num_quitance');
        $quitance->type = $request->input('type_quitance');
        $quitance->prix = $request->input('prix');
        $etablissement = Etablissement::find($request->input('etab_id'));
        $etablissement->status = "Validé";
        $quitance->save();
        $etablissement->update();

        return redirect()->back();
                
        
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
