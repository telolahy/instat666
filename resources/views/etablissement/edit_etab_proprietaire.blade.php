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
                      </div>
                           {!! Form::open(['action' => 'App\Http\Controllers\ProprietaireController@rectifier_etab',  'method' => 'POST' , 'id' => 'proprietaireForm' ]) !!} 
                            <input type="hidden" class="form-control form-control-bold form-control-center" name="id_etab" id="id_etab" value="{{$etablissement->id}}">
                            <input type="hidden" class="form-control form-control-bold form-control-center" name="id_proprietaire" id="id_proprietaire" value="{{$etablissement->proprietaire_id}}" >
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">CIN : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "12" name="cin"  id="cin" value="{{$etablissement->proprietaire->cin}}" readonly/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nom Complet : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value="{{$etablissement->proprietaire->nom}}" name="nom" id="nom">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nationalité : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="nationalite_proprietaire" id="nationalite_proprietaire" value="{{$etablissement->proprietaire->nationalite->nationalite}}" >
                                            @foreach ($nationalites as $nationalite)
                                            <option value="{{ $nationalite->nationalite }}">
                                                {{ $nationalite->nationalite }}
                                            </option>
                                            @endforeach
                                        </select><br/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Adresse : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse" name="adresse" id="adresse" value="{{$etablissement->proprietaire->adresse}}">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Fokontany : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="fokotany_proprietaire" id="fokotany_proprietaire"  >
                                            @foreach ($fokontanys as $fokotany)
                                            <option value="{{ $fokotany->fokotany }}">
                                                {{ $fokotany->fokotany }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                              </div>  
                              <div class="form-group row">
                                    <div class="col">
                                        <label class="">Numéro Tel : <span style="color: red">*</span></label>
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="num_tel"  id="num_tel" placeholder="Numero téléphone" value="{{$etablissement->proprietaire->num_tel}}"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Lien : <span style="color: red">*</span></label>
                                        <input type="number" class="form-control form-control-bold form-control-center" placeholder="lien" name="lien" id="lien" value="0" readonly>
                                    </div>
                                    <div class="col">
                                        <label class="">Email (facultatif) :</label>
                                        <input type="email" class="form-control form-control-bold form-control-center" placeholder="Email" name="email" id="email" value="{{$etablissement->proprietaire->email}}">
                                    </div>
                                </div>
                              <br/><hr/>
                              <div class="header" style="padding-bottom: 3%">
                                    <h4 class="title" style="text-align: center">A propos de l'Etablissement :</h4><hr/>
                              </div>
                              <input type="hidden" class="form-control form-control-bold form-control-center" name="num_entreprise" id="num_entreprise">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Identification :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-bold form-control-center" value="{{$etablissement->identification_stat}}" name="identification_stat" id="identification_stat" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sigle : <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-bold form-control-center" placeholder="Sigle" name="sigle" id="sigle" value="{{$etablissement->sigle}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Adresse : <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse de l'etablissement" name="adresse_etab" id="adresse_etab" value="{{$etablissement->adresse_etab}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Fokontany : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="fokotany_etab" id="fokotany_etab" value="{{$etablissement->fokontany->adresse_etab}}" >
                                            @foreach ($fokontany_etab as $fokotany)
                                            <option value="{{ $fokotany->fokotany }}">
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
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "25" name="fond"  id="fond" value="{{$etablissement->fond}}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class=""></label>
                                    <input type="hidden" />
                                </div>
                                <div class="col">
                                    <label class="">Numéro Tel Etablissement : <span style="color: red">*</span></label>
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="tel_etab"  id="tel_etab" placeholder="Telephone établissement" value="{{$etablissement->tel_etab}}"/>
                                </div>
                                <div class="col-sm-4">
                                    <label class="">Numéro patente : <span style="color: red">*</span></label>
                                    <input type="number" class="form-control form-control-bold form-control-center" placeholder="Numéro patente" name="num_patente" id="num_patente" value="{{$etablissement->num_patente}}">
                                </div>
                                <div class="col">
                                    <label class="">Boite postale :</label>
                                    <input type="email" class="form-control form-control-bold form-control-center" placeholder="Boite postale" name="bp" id="bp" value="{{$etablissement->bp}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class=""></label>
                                    <input type="hidden" />
                                </div>
                                <div class="col">
                                    <label class="">Comptabilité : <span style="color: red">*</span></label>
                                    <select class="form-control" required name="comptabilite" id="comptabilite" value="{{$etablissement->comptabilite}}" >       
                                            <option value="Oui">Oui</option>
                                            <option value="Non">Non</option>
                                    </select>
                                </div>
                                <div class="col-sm-4" hidden>
                                    <label class="">Duplicata : <span style="color: red">*</span></label>
                                    <select class="form-control" required name="duplicata" id="duplicata" value="{{$etablissement->duplicata}}" >       
                                            <option value="0">0</option>
                                    </select>
                                </div>
                                <div class="col" hidden>
                                    <label class="">Type : <span style="color: red">*</span></label>
                                    <select class="form-control" required name="type" id="type">       
                                            <option value="C">Creation</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Activité Principal : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="activite_etab" id="activite_etab" value="{{$etablissement->activite->description}}" >
                                            @foreach ($activites as $activite)
                                            <option value="{{ $activite->description }}">
                                                {{ $activite->description }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div> 
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Activité Secondaire1 :</label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="activite_sec1" id="activite_sec1" value="{{$etablissement->activite_sec1}}"  >
                                            @foreach ($activites as $activite)
                                            <option value="{{ $activite->description }}">
                                                {{ $activite->description }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Activité Secondaire2:</label>
                                  <div class="col-sm-10">
                                    {{-- {{ Form::select('activite_sec2', $activites->description, $etablissement->activite_sec1 , ['class' => 'form-control','id' => 'activite_sec2']) }} --}}
                                        <select class="form-control" required name="activite_sec2" id="activite_sec2" value="{{$etablissement->activite_sec1}}" >
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
                                        <select class="form-control" required name="lchef_etab" id="lchef_etab" value="{{$etablissement->lchef->description_lchef}}"  >
                                            @foreach ($lchefs as $lchef)
                                            <option value="{{ $lchef->description_lchef }}">
                                                {{ $lchef->description_lchef }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Forme Juridique : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="juridique_etab" id="juridique_etab" value="{{$etablissement->juridique->description_code_juridique}}" >
                                            @foreach ($juridiques as $juridique)
                                            <option value="{{ $juridique->description_code_juridique }}">
                                                {{ $juridique->description_code_juridique  }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Commune : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="commune_etab" id="commune_etab"  value="{{$etablissement->commune->commune}}">
                                            @foreach ($communes as $c)
                                            <option value="{{ $c->commune }}">
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
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="malagasy_m"  id="malagasy_m" placeholder="Masculin" value="{{$etablissement->malagasy_m}}"/>
                                </div>
                                <div class="col-sm-4">
                                    <label class=""></label>
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="malagasy_f"  id="malagasy_f" placeholder="Feminin" value="{{$etablissement->malagasy_f}}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class="">Salariés Etrangers :</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="etranger_m"  id="etranger_m" placeholder="Masculin" value="{{$etablissement->etranger_m}}" />
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="etranger_f"  id="etranger_f" placeholder="Feminin" value="{{$etablissement->etranger_f}}" />
                                </div>
                            </div>

                                <br/>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10" >
                                      {{Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary', 'id' => 'rectifier_proprietaire','style' => 'display: inline'])}} 
                                      <a onclick="window.location='{{url('/etab_proprietaire/'.$etablissement->id)}}'" class="btn btn-inverse btn-outline-inverse" style="display: inline;margin-left: 60%"><i class="icofont icofont-info-square"></i> Retour </a>
                                  </div>
                              </div>
                          {!! Form::close() !!}
                          
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end  -->

   
@endsection

@section('script')
      
@endsection