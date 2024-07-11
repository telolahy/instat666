@extends('layout.layout')

@section('title')
    Ajouter Commu
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">A propos du Propriétaire :</h4><hr/>
                          @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                      </div>
                           {{-- {!! Form::open(['action' => 'App\Http\Controllers\ProprietaireController@ajout_etab_proprietaire_exist',  'method' => 'POST' , 'id' => 'proprietaireForm' ]) !!}  --}}
                        <form action="{{route('add_reg_existant.update', $proprietaire->id)}}" method="POST" id="proprietaireForm">
                            @csrf
                            @method('PUT')
                                 <input type="hidden" class="form-control form-control-bold form-control-center"  name="id_proprio"  id="id_proprio" value="{{$proprietaire->id}}"/>
                                 <input type="hidden" class="form-control form-control-bold form-control-center"  name="lien"  id="lien" value="{{$proprietaire->lien}}" />
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">CIN :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center"  name="cin"  id="cin" value="{{$proprietaire->cin}}" readonly/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nom Complet :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center"  name="nom" id="nom" value="{{$proprietaire->nom}}" readonly>
                                  </div>
                              </div>
                              <br/><hr/>
                              <div class="header" style="padding-bottom: 3%">
                                    <h4 class="title" style="text-align: center">A propos de l'Etablissement</h4><hr/>
                              </div>
                              <input type="hidden" class="form-control form-control-bold form-control-center" name="num_entreprise" id="num_entreprise">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Identification :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-bold form-control-center" value="{{$identification_stat}}" name="identification_stat" id="identification_stat" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sigle : <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-bold form-control-center" placeholder="Sigle" name="sigle" id="sigle">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Adresse : <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse de l'etablissement" name="adresse_etab" id="adresse_etab">
                                </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Fokontany : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="fokotany_etab" id="fokotany_etab"  >
                                            @foreach ($fokontany_etab as $fokotany)
                                            <option value="{{ $fokotany->id }}">
                                                {{ $fokotany->fokotany }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div> 
                            <div class="form-group row">
                                <label class="">  </label>
                                <label class="col-sm-2 col-form-label">Fond (en 1000 Ar): <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                    <label class=""></label>
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "25" name="fond"  id="fond" placeholder="Fond"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class=""></label>
                                    <input type="hidden" />
                                </div>
                                <div class="col">
                                    <label class="">Numéro Tel Etablissement : <span style="color: red">*</span></label>
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="tel_etab"  id="tel_etab" placeholder="Téléphone établissement"/>
                                </div>
                                <div class="col-sm-4">
                                    <label class="">Numéro patente : <span style="color: red">*</span></label>
                                    <input type="text" class="form-control form-control-bold form-control-center" placeholder="Numéro patente" name="num_patente" id="num_patente">
                                </div>
                                <div class="col">
                                    <label class="">Boite postale :</label>
                                    <input type="text" class="form-control form-control-bold form-control-center" placeholder="Boite postale" name="bp" id="bp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class=""></label>
                                    <input type="hidden" />
                                </div>
                                <div class="col">
                                    <label class="">Comptabilité : <span style="color: red">*</span></label>
                                    <select class="form-control" required name="comptabilite" id="comptabilite"  >       
                                            <option value="Oui">Oui</option>
                                            <option value="Non">Non</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class="">Duplicata : <span style="color: red">*</span></label>
                                    <select class="form-control" required name="duplicata" id="duplicata"  >       
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Type : <span style="color: red">*</span></label>
                                    <select class="form-control" required name="type" id="type"  >       
                                            <option value="C">Création</option>
                                            <option value="M">Modification</option>
                                            <option value="A">Abandon</option>
                                            <option value="R">Réprise</option>
                                            <option value="U">Mutation</option>
                                            <option value="Re">Réenregistré</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Activité Principal : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="activite_etab" id="activite_etab"  >
                                            @foreach ($activites as $activite)
                                            <option value="{{ $activite->id }}">
                                                {{ $activite->description }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div> 
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Activité Secondaire1 :</label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="activite_sec1" id="activite_sec1"  >
                                            @foreach ($activites as $activite)
                                            <option value="{{ $activite->description }}">
                                                {{ $activite->description }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Activité Secondaire2 :</label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="activite_sec2" id="activite_sec2"  >
                                            @foreach ($activites as $activite)
                                            <option value="{{ $activite->description }}">
                                                {{ $activite->description }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Libelle Chef : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="lchef_etab" id="lchef_etab"  >
                                            @foreach ($lchefs as $lchef)
                                            <option value="{{ $lchef->id }}">
                                                {{ $lchef->description_lchef }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Forme Juridique : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="juridique_etab" id="juridique_etab"  >
                                            @foreach ($juridiques as $juridique)
                                            <option value="{{ $juridique->id }}">
                                                {{ $juridique->description_code_juridique  }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class=""></label>
                                    <input type="hidden" />
                                </div>
                                <div class="col-sm-5">
                                    <label class="">Distict :</label>
                                    <input type="text" class="form-control form-control-bold form-control-center"  name="district_etab" id="district_etab" readonly>
                                </div>
                                <div class="col-sm-5">
                                    <label class="">Région :</label>
                                    <input type="text" class="form-control form-control-bold form-control-center"  name="region_etab" id="region_etab" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Commune : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="commune_etab" id="commune_etab"  >
                                            @foreach ($communes as $c)
                                            <option value="{{ $c->id }}">
                                                {{ $c->commune  }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class=""></label>
                                    <label class="">Salariés Malagasy :</label>
                                </div>
                                <div class="col">
                                    <label class=""></label>
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="malagasy_m"  id="malagasy_m" placeholder="Masculin"/>
                                </div>
                                <div class="col-sm-4">
                                    <label class=""></label>
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="malagasy_f"  id="malagasy_f" placeholder="Feminin"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class="">Salariés Etrangers :</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="etranger_m"  id="etranger_m" placeholder="Masculin"/>
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="etranger_f"  id="etranger_f" placeholder="Feminin"/>
                                </div>
                            </div>

                                <br/>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10" >
                                      {{-- {{Form::submit('Envoyer', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_proprietaire_exist'])}}  --}}
                                      <button type="submit" class="btn btn-outline-primary">Ajouter </button>
                                  </div>
                              </div>
                        </form>
                          
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection