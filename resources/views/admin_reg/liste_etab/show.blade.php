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
                <label strong class="col-sm-3 col-form-label"><strong>Adresse : </strong></label> {{$etablissement->proprietaires->first()->adresse}} <label class="col-sm-1 col-form-label"><strong> à   :</strong></label> {{$etablissement->proprietaires->first()->fokontany->fokotany}} <br/>
                <label strong class="col-sm-3 col-form-label"><strong>Commune : </strong></label> {{$etablissement->proprietaires->first()->commune->commune}} <label class="col-sm-2 col-form-label"> <strong> District :</strong></label> {{$etablissement->proprietaires->first()->commune->district}} <br/>
                <label strong class="col-sm-3 col-form-label"><strong>Région : </strong></label> {{$etablissement->proprietaires->first()->commune->region}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Nationalité : </strong></label> {{$etablissement->proprietaires->first()->nationalite->nationalite}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Numéro téléphone : </strong></label> {{$etablissement->proprietaires->first()->num_tel}}<br/><br/>
                <label strong class="col-sm-3 col-form-label"><strong>Lien : </strong></label> {{$etablissement->proprietaires->first()->lien}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Identification Statistique : </strong></label> {{$etablissement->identification_stat}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Sigle : </strong></label> {{$etablissement->sigle}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Fond : </strong></label> {{$etablissement->fond * 1000}} Ariary<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Adresse Etablissement : </strong></label> {{$etablissement->adresse_etab}} <label class="col-sm-1 col-form-label"><strong> à   :</strong></label> {{$etablissement->fokontany->fokotany}} <br/>
                <label strong class="col-sm-3 col-form-label"><strong>Commune : </strong></label> {{$etablissement->commune->commune}} <label class="col-sm-2 col-form-label"> <strong> District :</strong></label> {{$etablissement->commune->district}} <br/>
                <label strong class="col-sm-3 col-form-label"><strong>Région : </strong></label> {{$etablissement->commune->region}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Forme Juridique : </strong></label> {{$etablissement->juridique->description_code_juridique}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Téléphone Etablissement : </strong></label> {{$etablissement->tel_etab}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Type : </strong></label> {{$etablissement->type}}<br/>
                <label strong class="col-sm-3 col-form-label"><strong>Activité Principal: </strong></label > {{$etablissement->activite->description}}<br/>
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
                        <button onclick="window.location='{{url('/form_quitance/'.$etablissement->id)}}'" class="btn btn-info btn-outline-info" style="display: inline"><i class="icofont icofont-info-square"></i> Valider l'etablissement </button>
                        <a href= "{{route('reg_etab.edit',$etablissement->id)}}" class="btn btn-danger btn-outline-danger" style="display: inline;margin-left: 23%"><i class="icofont icofont-info-square"></i> Rectifier </a>
                        <a href="{{route('reg_etab.index')}}" class="btn btn-warning btn-outline-warning" style="display: inline;margin-left: 23%"><i class="icofont icofont-exchange"></i> Retour </a>                        
                    @else
                        <a href="{{route('reg_etab.index')}}" class="btn btn-warning btn-outline-warning" style="display: inline;margin-left: 85%"><i class="icofont icofont-exchange"></i> Retour </a>
                    @endif
                  </div>
                  <br/>
              {{-- <button onclick="window.location='{{url('/carte_statistique/'.$etablissement->id)}}'" class="btn btn-danger btn-outline-danger" style="display: inline;margin-left: 23%"><i class="icofont icofont-info-square"></i> Carte statistique </button> --}}
            </div>
        </div>
    </div>
</div>
<!-- tabs card end -->

@endsection

