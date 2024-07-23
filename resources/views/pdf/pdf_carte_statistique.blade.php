<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HTML 2 PDF</title>
        <style type="text/css">
            html { margin-top: 5% }
            @page {
                size: 39cm 47.7cm;
                margin-left: 0;
                margin-bottom: 0;
                margin-right: 0;
                margin-top: 5%;
            }
            body {
                padding-bottom: .3in;
                padding-left: .3in;
                padding-right: .3in;
                padding-top: .6in;
                }
            .card1 {
                width: 49%;
                height: 28%;
                border-style: solid;
                border-width: 2px;
                margin-right: 0.5%;
                display: inline-block;
                }
            .card2 {
                width: 49%;
                height: 28%;
                border-style: solid;
                border-width: 2px;
                margin-right: 0.5%;
                display: inline-block;
                }
            .container {
                padding-top: 5.5%;  
                }
            .text {
                /* border-style: solid;    */
                width: 45%;
                 border-width: 2px;
                 display: inline-block;
                 margin-top: 10%;
                
                }
             .image {
                width: 53%;
                /* border-style: solid;    */
                border-width: 2px;
                padding-top: 0%;
                display: inline-block;
                margin-top: 10%;
                }
            .title {
                text-align: center;
                font-size: 12px;
                font-style: italic;
                text-decoration: underline;
                font-weight: bold;
                line-height: 0%;
                }
            .contenu {
                font-size: 14.5px;
                font-style: italic;
                font-weight: bold;
                padding-left: 1%;
                }
            .presidence {
                margin-left: 45%;
            }
            .repoblika {
                text-align: center;
                font-size: 15px;
                font-style: italic;
                font-weight: bold;
                line-height: 0%;
            }
            .fitiavana {
                text-align: center;
                font-size: 12px;
                font-style: italic;
                font-weight: bold;
                line-height: 0%;
            }
            .line1 {
               text-align: center;
                font-size: 10px;
                font-weight: bold;
                line-height: 0%; 
            }
            .line2 {
               text-align: center;
                font-size: 10px;
                font-weight: bold;
                line-height: 0%; 
            }
            .ministere {
                text-align: center;
                font-size: 15px;
                font-weight: bold;
                font-style: italic; 
            }
            .instat {
                line-height: 0%; 
            }
            .karatra {
                text-align: center;
                font-size: 22px;
                font-weight: bold;
                line-height: 0%; 
            }
            .laharana {
                font-size: 10px;
                font-style: italic;
                font-weight: bold;
            }
            .activite, .region, .annee, .lien, .code {
                height: 7%;
                border-style: solid;
                border-width: 1px;
                display: inline-block;
                margin-bottom: 2%;
            }
            .activite {
                width: 22%;
            }
            .region {
                width: 14%;
            }
            .annee {
                width: 20%;
            }
            .lien {
                width: 10%;
            }
            .code {
                width: 22%;
            }
            
            .value {
            font-weight: bold;
            text-align: center;
            font-size: 20px;
            margin-top: 0.5%;
        }
            .nomena {
                width: 40%;
                margin-left: 1%;
                display: inline-block;
                vertical-align: top;
                margin-bottom: 0%;
            }

            .tapitra {
                width: 40%; 
                margin-left: 18%;
                display: inline-block;
                vertical-align: top;
                margin-bottom: 0%;
            }
            .label {
                font-size: 16px;
                font-style: italic;
                display: inline-block;
            }
            .date {
                font-size: 16px;
                font-style: italic;
                font-weight: bold;
                display: inline-block;
            }
            .input {
                font-size: 10px;
                font-style: italic;
                font-weight: bold;
                margin-left: 1%;
                 
            }
            .div_nom {
                width: 98.5%;
                height: 5%;
                border-style: solid;
                border-width: 0.5px;
                margin-left: 0.5%;
               
              
            }
            .nom {
                font-weight: bold;
                margin-left: 1%;
                font-size: 20px;
                margin-top: -0.2%; 
                
            }
            .div_activite {
                width: 98.5%;
                height: 21%;
                border-style: solid;
                border-width: 0.5px;
                margin-left: 0.5%;
                margin-top: 0.5%;
            
                
            }
            .activite_val {
                font-size: 15px;
                margin-left: 1%;
                width: 98%;
                border-width: 0px;
                padding-top: 0%;
                margin-top: 0%;
                  
            }

            .direction {
                width: 31%;
                height: 26%;
                border-style: solid;
                border-width: 0.5px;
                display: inline-block;
                margin-left: 0.5%;
                margin-top: 4.7%;
                
            }
            .QRimage{
                width: 15%;
                height: 26%;
                border-style: solid;
                border-width: 0.5px;
                display: inline-block;
                margin-left: 0.5%;
                margin-top: 4.7%;
                
            }
            .qrcode{
                width: 70%;
                height: 70%;
                display: inline-block;
                margin-left: 15%;
                margin-right: 15%;
                margin-top: 15%;
                margin-bottom: 15%;
            }
            .responsable {
                width: 50.5%;
                height: 26%;
                border-style: solid;
                border-width: 0.5px;
                display: inline-block;
                margin-top: 0.1%;
                
            }
            .p1 {
                font-size: 12px;
                text-align: center;
                border-width: 0px;
                margin-top: 2%;
                font-style: italic;
                
            }
            .p2 {
                padding-top: 3%;
                font-size: 13px;
                text-align: center;
                border-width: 0px;
                margin-top: 2%;
                font-style: italic;
                font-weight: bold;
                
            }
            .p3 {
                padding-top: 3%;
                font-size: 15px;
                text-align: center;
                border-width: 0px;
                margin-top: 1%;
                font-style: italic;
                font-weight: bold;
                
            }

        </style>

    </head>
    <body>
        <div class="card1">
            <div class="container">
               <div class="text">
                <p class="title">RECOMMANDATIONS</p>
                <p class="contenu">
                    En vertu du decret N° 2005 /380, portant <br/> nouvelle immatriculation statistique des<br/>
                    établissements exerçant une activité économique<br/> ou sociale à Madagascar, vous êtes tenus de vous<br/>
                    adresser au service de la statistique pour<br/>renouveler votre carte en cas de:<br/>
                    - de changement d'activité ou de rajout<br/>- de changement de propriétaire, de<br/>
                    denomination, de raison sociale, d'adresse<br/>- de cessation d'activité quel qu'en soit le motif.<br/>
                    Le nom respect de ce décret est passible d'amende.
                </p>
                <p class="title">HAFATRA TSY MAINTSY ARAHINA</p>
                <p class="contenu">
                   Araka ny Didim-panjakana laharana N° 2005 <br/>/380 manambara ny firaketana ny lisitra<br/>
                   hamantarana ireo seha-pandraharahana dia<br/>manatona ny biraon'ny Statistika ianareo<br/>
                   hanava ity karatra ity raha misy: <br/>
                   - fiovan-draharaha<br/>- fiovan'ny tompony, anaran'ny orin'asa ( na<br/>
                   ny fikambanana ) na ny adiresy<br/>- fijanonana amin'ny asa atao na inona na <br/>
                   inona antony.<br/>
                   Ny tsy fanantaterahana izany dia mahavoasazy.<br/>
                </p>
               </div>
               <div class="image">
                    <img class="presidence" src="{{ public_path('assets/presidence.jpg') }}" style="width: 50px; height: 50px">
                    <p class="repoblika"> REPOBLIKAN'I MADAGASIKARA</p>
                    <p class="fitiavana">Fitiavana-Tanindrazana-Fandrosoana</p>
                    <p class="line1">________________________</p>
                    <p class="ministere"> MINISTERE DE L'ECONOMIE<br/> ET DES FINANCES</p>
                    <p class="line2">________________________</p>
                    <img class="instat" src="{{ public_path('assets/instat_sur_carte.jpg') }}" style="width: 100%; height: 30%">
                    <p class="karatra"> KARATRA STATISTIKA</p>
                    <img class="carte" src="{{public_path('assets/img/carte.jpg')}}" style="width: 98%; height: 15%">
                    <p class="laharana">Laharana statistika ( Numéro d'Identification) :</p>
                    <div class="activite"><p class="value">{{$categorie->code_categorie}}</p></div>
                    <div class="region"><p class="value">{{$region}}</p></div>
                    <div class="annee"><p class="value">{{$annee}}</p></div>
                    <div class="lien"><p class="value">{{$lien}}</p></div>
                    <div class="code"><p class="value">{{$code}}</p></div>                 
               </div>
            </div>
        </div>
        <div class="card2">   
            {{-- <div class="row"> --}}
                <div class="col-2">
                    <div class="nomena">
                        <p class="label">Nomena tamin'ny (Délivré le) :</p>
                        <p class="date">{{$date_now}}</p>
                    </div>
                    <div class="tapitra">
                        <p class="label">Tapitra amin'ny (expiré le) :</p>
                        <p class="date">{{ \Carbon\Carbon::now()->addYears(2)->format('d/m/Y') }}</p>
                    </div>
                </div> 
            {{-- </div> --}}
            
            <div class="">
                <p class="input"> Anarana(Nom/Dénomination) :</p>
                    <div class="div_nom"><p class="nom">{{$etablissement->proprietaires->first()->nom}}</p></div>
                    <p class="input"> Anarana nahafehezina (Sigle) :</p>
                    <div class="div_nom"><p class="nom">{{$etablissement->sigle}}</p></div>
                    <p class="input"> Adiresy (Adresse) :</p>
                    @if ($etablissement->adresse_etab == $etablissement->proprietaires->first()->adresse)
                        <div class="div_nom"><p class="nom">{{$etablissement->adresse_etab}} {{$etablissement->fokontany->fokotany}}</p></div>
                    @else
                        <div class="div_nom"><p class="nom">{{$etablissement->adresse_etab}} {{$etablissement->fokontany->fokotany}} / {{$etablissement->proprietaires->first()->adresse}}</p></div>
                    @endif
                    <p class="input"> Asa atao (Activité principale) | Asa fanampiny (Activité secondaire) :</p>
                    <div class="div_activite">
                        <p class="activite_val">
                            @if ($activite_desc1 == "Néant")
                                -{{$activite_desc}}<br>
                            @elseif($activite_desc2 == "Néant")
                                -{{$activite_desc}}<br>-{{$activite_desc1}}
                            @else
                                -{{$activite_desc}}<br>-{{$activite_desc1}}<br>-{{$activite_desc2}}
                            @endif  
                                        
                        </p>
                    </div>
                    <div class="QRimage"> <img class="qrcode" src="{!! $qrcodeBase64 !!}" alt="QRCODE" /></div>
                    <div class="direction">
                        <p class="p1">DIRECTION INTERREGIONALE <br>D'ANTANANARIVO</p>
                        <p class="p2">TSY EKENA NY TAKOSONA <br>(AUCUNE RATURE NI GOMMAGE)</p>
                    </div>
                    <div class="responsable">
                        <p class="p3">Sonian'ny tompon'andraikitra <br>(Signature du Responsable)</p>
                    </div>
                </div>

            </div>
    </body>
</html>