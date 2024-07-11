<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HTML 2 PDF</title>

        <style>
          .presidence {
                margin-left: 45%;
            }
            .repoblika {
                text-align: center;
                font-weight: bold;
                font-size: 12px;
            }
            .fitiavana {
                text-align: center;
                font-size: 10px;
                font-style: italic;
                line-height: 0%;
            }
            .ministere, .secretariat {
                text-align: center;
                font-size: 12px;
            }
            .direction {
                font-size: 12px;
            }
            .title {
                text-align: center;   
                font-weight: bold;            
            }
            .nom { 
                font-weight: bold;
                margin-left: 4em;

            }
            .text {
                font-size: 14px;
            }
            .value {
             font-weight: bold;
            }
           
            .identification {
                font-size: 13px;
                display: inline;
                margin-left: 3em;
                font-weight: bold;
            }
            
            .nationalite {
                font-size: 13px;
                display: inline;
                margin-left: 8.2em;
            }
            .date {
                font-size: 14px;
                margin-left: 25em;

            }
        </style>
    </head>
    <body>
        <img class="presidence" src="{{ public_path('assets/presidence.jpg') }}" style="width: 100px; height: 80px">
        <p class="repoblika"> REPOBLIKAN'I MADAGASIKARA</p>
        <p class="fitiavana">Fitiavana-Tanindrazana-Fandrosoana</p>
        <p class="ministere"> MINISTERE DE L'ECONOMIE ET DES FINANCES</p>
        <p class="secretariat"> SECRETARIAT GENERAL</p>
        <img class="instat" src="{{ public_path('assets/instat_sur_carte.jpg') }}" style="width: 30%; height: 8%">
        <p class="direction"> DIRECTION GENERALE </p>
        <p class="direction">DIRECTION DES STATISTIQUES ECONOMIQUES / SERVICE DU REPERTOIRE NATIONAL DES ETABLISSEMENTS </p>
        @if ($province == "Antananarivo" || $province == "Antsiranana")
            <p class="direction"> DIRECTION INTERREGIONALE D'{{Str::upper($province)}} </p>
        @else
            <p class="direction"> DIRECTION INTERREGIONALE DE {{Str::upper($province)}} </p>
        @endif
        <p class="title">CERTIFICAT D'ANNULATION <br> -oOOOOOOo-</p>
        @if ($province == "Antananarivo" || $province == "Antsiranana")
            <p class="text">
             Je soussigné le Directeur Inter Régional d'{{ ucfirst($province) }}, certifie que
        </p>
        @else
            <p class="text">
             Je soussigné le Directeur Inter Régional de {{ ucfirst($province) }}, certifie que
        </p>
        @endif
        <p class="nom">{{$etablissement->proprietaire->nom}}</p>
        <p class="text"> dont le siège sociales <span class="value"> {{$etablissement->adresse_etab}} {{$etablissement->fokontany->fokotany}}</span></p>
        <p class="text"> a deposé une demande d'annulation de son inscription à {{ ucfirst($province) }}, le {{$date_now}}.</p>
        <p class="text"> Cette demande a été accompagnée de sa Carte d'Identification Statistique: <span class="value"> {{$activite}}-{{$region}}-{{$annee}}-{{$lien}}-{{$code}}</span></p>
        <p class="text"> délivrée le <span class="value">{{$date_creation}}</span> à {{ ucfirst($province) }}.</p> <br>

        <p class="text"> En foi de quoi, le présent certificat lui est delivré pour servir et valoir ce que de droit.</p>
        <span class="date">Fait à {{ ucfirst($province) }}, le <span style="font-weight: bold">{{$date_now}}</span></span>
    </body>
</html>