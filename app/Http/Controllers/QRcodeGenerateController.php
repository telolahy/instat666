<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRcodeGenerateController extends Controller
{
    public function qrcode()
    {
       // $etablissement = Etablissement::where('id', 1)->value('sigle');
        $etablissement = Etablissement::first();
        $sigle ="Sigle: ".$etablissement->sigle."\n Telolahy Daniel";
        $qrcode = QrCode::size(100)->generate($sigle);
        
    	# 3. On envoie le QR code généré à la vue "simple-qrcode"
    	return view("qrcode.code", compact('qrcode'));
    }
}
