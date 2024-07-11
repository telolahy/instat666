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
                text-decoration : underline;               
            }
            .text {
                font-size: 14px;
            }
            .label {
             text-decoration : underline;   
             width: 20%;
             font-size: 13px;
             display: inline;
            }
            .nom {
                font-size: 13px;
                display: inline;
                margin-left: 5em;
            }
            .code {
                font-size: 13px;
                display: inline;
                margin-left: 6.8em;
            }
            .adresse {
                font-size: 13.5px;
                display: inline;
                margin-left: 10em;
            }
            .region {
                font-size: 13px;
                display: inline;
                margin-left: 1.5em;
            }
            .activite {
                font-size: 13px;
                display: inline;
                margin-left: 5.6em;
            }
            .sec1 {
                font-size: 13px;
                display: inline;
                margin-left: 4.5em;
            }
            .sec2 {
                font-size: 13px;
                display: inline;
                margin-left: 4.7em;
            }
            .identification {
                font-size: 13px;
                display: inline;
                margin-left: 3em;
                font-weight: bold;
            }
            .type {
                font-size: 13px;
                display: inline;
                margin-left: 2.2em;
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
        <p class="title">CERTIFICAT D'EXISTENCE</p>
        @if ($province == "Antananarivo" || $province == "Antsiranana")
            <p class="text">
             Je soussigné le Directeur Inter Régional d'{{ ucfirst($province) }}, certifie que <br>
             l'etablissement dont les renseignements figurent ci-après, est immatriculé au répertoire <br>
             d'identification des établissements :
        </p>
        @else
            <p class="text">
             Je soussigné le Directeur Inter Régional de {{ ucfirst($province) }}, certifie que <br>
             l'etablissement dont les renseignements figurent ci-après, est immatriculé au répertoire <br>
             d'identification des établissements :
        </p>
        @endif
        <p class="label"> Nom / Raison sociale:</p>
        <span class="nom">{{$etablissement->proprietaire->nom}}</span> <br>
        <p class="label"> Forme juridique:    </p>
        <span class="code">{{$etablissement->juridique->description_code_juridique}}</span><br>
        <p class="label"> Adresse:</p>
        <span class="adresse">{{$etablissement->adresse_etab}} {{$etablissement->fokontany->fokotany}}</span> <br>
        <p class="label"> Région / District / Commune: </p>
        <span class="region">{{$etablissement->commune->region}} / {{$etablissement->commune->district}} / {{$etablissement->commune->commune}}</span><br>
        <p class="label"> Activité principale: </p>
        <span class="activite">{{$etablissement->activite->description}}</span> <br>
        <p class="label"> Activité secondaire 1: </p>
        @if ($etablissement->activite_sec1 == "Néant")
            <span class="sec1">------Néant------</span><br> 
        @else
            <span class="sec1">{{$etablissement->activite_sec1}}</span><br>
        @endif
        <p class="label"> Activité secondaire 2:</p>
        @if ($etablissement->activite_sec2 == "Néant")
            <span class="sec2">------Néant------</span><br> 
        @else
            <span class="sec1">{{$etablissement->activite_sec2}}</span><br>
        @endif
        <p class="label"> Identification statistique: </p>
        <span class="identification">{{$activite}}-{{$region}}-{{$annee}}-{{$lien}}-{{$code}}</span><br>
        <p class="label"> Date et type de mise à jour:</p>
        <span class="type">{{$date_type}} - {{$type}}</span> <br>
        <p class="label"> Nationalité: </p>
        <span class="nationalite">{{$etablissement->proprietaire->nationalite->nationalite}}</span><br>
        <p> </p>
        <p class="text"> En foi de quoi, le présent certificat lui est delivré pour servir et valoir ce que de droit.</p>
        <p class="text"> Le numéro d'identification statistique doit être mentionné sur toute correspondance avec <br> l'administration publique.</p>
        <p class="text"> La validité du présent certificat est de trente jours (30 jours) pour compter de la date de delivrance.</p>
        <span class="date">Fait à {{ ucfirst($province) }}, le {{$date_now}}</span>
    </body>
</html>