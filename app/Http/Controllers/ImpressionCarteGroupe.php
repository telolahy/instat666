<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
class ImpressionCarteGroupe extends Controller
{
    public function cumule($id)
    {
       
        $etablissement = Etablissement::findOrFail($id);

        $etablissement->cumule = 0;
        $etablissement->save();

        $etablissement_cumuler = Etablissement::where('cumule', 0)->get();
        $count = $etablissement_cumuler->count();
        if ($count == 3)
        {
            return redirect()->route('cumule_index');
        }
        return redirect()->route('reg_etab.index')->with('success',' Enregistrer !!!!');
    }

    public function cumule_index()
    {
        $etablissements = Etablissement::with('proprietaires')
                        ->where('cumule', 0)
                        ->get();

        return view('admin_reg.cumule.index',compact('etablissements'));
    }

    public function impression_index()
    {
       
        $etablissements = Etablissement::with('proprietaires')
                        ->where('cumule', 0)
                        ->get();
        
        $i = 0;
        $etab = [];
        $etablissement_prop = []; 
        foreach ($etablissements as  $etablissement )
        {
           
            $etablissement_prop[$i] = $etablissement;
            $activite_desc= $etablissement->get_first_25_words($etablissement->activite_princ);
            $activite_desc1= $etablissement->get_first_25_words($etablissement->activite_sec1);
            $activite_desc2= $etablissement->get_first_15_words($etablissement->activite_sec2);

        
            $data ="INSTAT MADAGASCAR"."\n"."Sigle: ".$etablissement->sigle."\n"."Nom Proprietaire: ". $etablissement->proprietaires->first()->nom."\n"."Adresse Etab: ".$etablissement->adresse_etab. "\n"."CIN :". $etablissement->proprietaires->first()->cin;
            //$qrcode = QrCode::size(100)->generate($sigle);
    
            $qrcode = QrCode::format('svg')->size(100)->generate($data);
    
            $qrcodeBase64 = 'data:image/svg+xml;base64,' . base64_encode($qrcode);
            
            ini_set('max_execution_time', 600);
            $tab = explode("-", $etablissement->identification_stat);
            
            // $activite = $etablissement->activite->categorie;    
            // $lien = $etablissement->proprietaires->first()->lien;
            // $nom = $etablissement->proprietaires->first()->nom;
            // $sigle = $etablissement->sigle;
            // $adresse_etab = $etablissement->adresse_etab;
            // $adresse_prop = $etablissement->proprietaires->first()->adresse;

            // $fokotany_etab = $etablissement->fokontany->fokotany;
            $date_now = Carbon::now()->isoFormat('DD/MM/YYYY');
            $region = $tab[0];
            $annee = $tab[1];
            $code = $tab[2];

            if (!isset($etab[$i])) {
                $etab[$i] = [];
            }
            array_push($etab[$i], $data, $qrcode, $qrcodeBase64, $tab, $code);
            $i = $i + 1;
        }
         
        // dd($etab[0]);
        $etablissement_prop[0]->cumule = 1;
        $etablissement_prop[1]->cumule = 1;
        $etablissement_prop[2]->cumule = 1;

        $etablissement_prop[0]->save();
        $etablissement_prop[1]->save();
        $etablissement_prop[2]->save();
        

       
        $etablissement_prop_0 = $etablissement_prop[0];
        $etablissement_prop_1 = $etablissement_prop[1];
        $etablissement_prop_2 = $etablissement_prop[2];

        $categorie_0 = Etablissement::getCategorieEtab($etablissement_prop_0->id);
        $categorie_1 = Etablissement::getCategorieEtab($etablissement_prop_1->id);
        $categorie_2 = Etablissement::getCategorieEtab($etablissement_prop_2->id);
       


        $etab_0 = $etab[0] ;
        $etab_1 = $etab[1] ;
        $etab_2 = $etab[2] ;

        // dd($etab_2);

        PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.groupe', compact('categorie_0','categorie_1','categorie_2','annee', 'region', 'date_now','etab_0','etab_1','etab_2','etablissement_prop_0','etablissement_prop_1','etablissement_prop_2'));

        return $pdf->download('carte' . '_' . $etablissement->proprietaires->first()->nom . '.pdf');
    }
}
