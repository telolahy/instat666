@extends('layout.layout')

@section('title')
List Commune
@endsection

{{-- {{ Form::hidden('', $increment=1 ) }} --}}

@section('contenu')

<div class="col-sm-12">
    <div class="card tabs-card">
        <div class="card-block p-0">
            <div class="tab-content card-block">
                <div class="header" style="padding-bottom: 3%">
                    <h4 class="title" style="text-align: center">Detail à propos du {{$etablissement->sigle}}</h4><hr/> 
                    @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
                </div>
                    <label strong class="col-sm-3 col-form-label"><strong>Numéro CIN : </strong></label> {{$etablissement->proprietaires->first()->cin}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Nom du propriétaire : </strong></label> {{$etablissement->proprietaires->first()->nom}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Adresse : </strong></label> {{$etablissement->proprietaires->first()->adresse}} <label class="col-sm-1 col-form-label"><strong> à   :</strong></label> {{$fokontany_prop->fokotany}} <br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Commune : </strong></label> {{$etablissement->proprietaires->first()->commune->commune}} <label class="col-sm-2 col-form-label"> <strong> District :</strong></label> {{$district_prop->district}} <br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Région : </strong></label> {{$region_prop->region}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Nationalité : </strong></label> {{$etablissement->proprietaires->first()->nationalite->nationalite}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Numéro téléphone : </strong></label> {{$etablissement->proprietaires->first()->num_tel}}<br/><br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Lien : </strong></label> {{$etablissement->proprietaires->first()->lien}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Identification Statistique : </strong></label> {{$etablissement->identification_stat}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Sigle : </strong></label> {{$etablissement->sigle}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Fond : </strong></label> {{$etablissement->fond * 1000}} Ariary<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Adresse Etablissement : </strong></label> {{$etablissement->adresse_etab}} <label class="col-sm-1 col-form-label"><strong> à   :</strong></label> {{$fokontany_etab->fokotany}} <br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Commune : </strong></label> {{$etablissement->commune->commune}} <label class="col-sm-2 col-form-label"> <strong> District :</strong></label> {{$district_etab->district}} <br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Région : </strong></label> {{$region_etab->region}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Forme Juridique : </strong></label> {{$etablissement->juridique->description_code_juridique}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Téléphone Etablissement : </strong></label> {{$etablissement->tel_etab}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Type : </strong></label> {{$etablissement->type}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Activité Principal: </strong></label > {{$etablissement->activite_princ}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Activité Secondaire1 : </strong></label> {{$etablissement->activite_sec1}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Activité Secondaire2 : </strong></label > {{$etablissement->activite_sec2}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Libelle Chef : </strong></label > {{$etablissement->lchef->description_lchef}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Total Salariés Malagasy : </strong></label > {{$etablissement->malagasy_m + $etablissement->malagasy_f}} <label class="col-sm-2 col-form-label"> <strong> Homme :</strong></label> {{$etablissement->malagasy_m}} <label class="col-sm-2 col-form-label"> <strong> Femme :</strong></label> {{$etablissement->malagasy_f}} <br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Total Salariés Etrangers : </strong></label > {{$etablissement->etranger_m + $etablissement->etranger_f}} <label class="col-sm-2 col-form-label"> <strong> Homme :</strong></label> {{$etablissement->etranger_m}} <label class="col-sm-2 col-form-label"> <strong> Femme :</strong></label> {{$etablissement->etranger_f}} <br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Numéro patente : </strong></label > {{$etablissement->num_patente}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Duplicata : </strong></label > {{$etablissement->duplicata}}<br/>
                    <label strong class="col-sm-3 col-form-label"><strong>Boîte postal: </strong></label > {{$etablissement->bp}}<br/><br/>
                <div >
                @if ($etablissement->status == "En attente")
                    <div id="en-attente-elements">
                        <button onclick="window.location='{{ url('/form_quitance/'.$etablissement->id) }}'" class="btn btn-info btn-outline-info" style="display: inline">
                            <i class="icofont icofont-info-square"></i> Valider l'établissement
                        </button>
                        <a href="{{ route('reg_etab.edit', $etablissement->id) }}" class="btn btn-danger btn-outline-danger" style="display: inline; margin-left: 23%;">
                            <i class="icofont icofont-info-square"></i> Rectifier
                        </a>
                        <a href="{{ route('reg_etab.index') }}" class="btn btn-warning btn-outline-warning" style="display: inline; margin-left: 23%;">
                            <i class="icofont icofont-exchange"></i> Retour
                        </a>
                    </div>
                @else
                    <div id="non-attente-elements" class="d-flex justify-content-arround">
                        {{-- {{route('quitance_reg_form_ft')}} --}}
                        <form action="{{route('carte_state',$etablissement->id)}}" method="post">
                            {{ csrf_field() }} 
                            @method('GET')
                        <button type="submit" class="btn btn-info btn-outline-info" id="disable-link" style="display: inline">
                            <i class="icofont icofont-exchange"></i> Carte Statistique
                        </button>
                    </form>
                        <a href="{{ route('reg_etab.rectification', $etablissement->id) }}" class="btn btn-danger btn-outline-danger" id="disable-rectification" style="display: inline">
                            <i class="icofont icofont-exchange"></i> Rectifier
                        </a>
                        <a href="{{ route('reg_etab.index') }}" class="btn btn-warning btn-outline-warning" style="display: inline; margin-left: 85%;">
                            <i class="icofont icofont-exchange"></i> Retour
                        </a>
                    </div>
                @endif
                
                <script>
                    // Fonction pour désactiver les deux liens
                    function disableLinks() {
                        var link1 = document.getElementById('disable-link');
                        var link2 = document.getElementById('disable-rectification');
                        
                        if (link1) {
                            link1.style.pointerEvents = 'none';  // Désactive le lien
                            link1.style.opacity = '0.5';  // Facultatif : rend le lien visuellement désactivé
                            link1.innerHTML = '<i class="icofont icofont-info-square"></i> Désactivé';  // Change le texte du lien
                        }
                        
                        if (link2) {
                            link2.style.pointerEvents = 'none';  // Désactive le lien
                            link2.style.opacity = '0.5';  // Facultatif : rend le lien visuellement désactivé
                            link2.innerHTML = '<i class="icofont icofont-info-square"></i> Désactivé';  // Change le texte du lien
                        }
                
                        localStorage.setItem('linksDisabled', 'true');  // Enregistre l'état dans le stockage local
                    }
                
                    // Vérifie l'état des liens au chargement de la page
                    window.onload = function() {
                        if (localStorage.getItem('linksDisabled') === 'true') {
                            disableLinks();
                        } else {
                            // Désactive les liens après 1 minute (60000 millisecondes) // 86 400 000 = 1 jours
                            setTimeout(disableLinks, 1 * 86400000);
                        }
                    };
                
                    // Réinitialise l'état des liens si le statut est "En attente"
                    @if ($etablissement->status == "En attente")
                        localStorage.removeItem('linksDisabled');
                    @endif
                </script>
                



@endsection

