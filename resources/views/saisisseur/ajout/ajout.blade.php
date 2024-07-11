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
                               {{-- {!! Form::open(['action' => 'App\Http\Controllers\ProprietaireController@ajout_proprietaire',  'method' => 'POST' , 'id' => 'proprietaireForm' ]) !!}  --}}
                            <form action="{{route('ajout_saisisseur.store')}}" method="POST" id="proprietaireForm">
                                @csrf
                               <div class="form-group row">
                                        <div class="col">
                                            <label class="">Commune :</label>
                                            <input type="text" class="form-control" name="commune_proprietaire" id="commune_proprietaire" value="{{$commune->commune}}" readonly  >
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="">District :</label>
                                            <input type="text" class="form-control" value="{{$commune->district}}" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="">Région :</label>
                                            <input type="text" class="form-control" value="{{$commune->region}}" readonly>
                                        </div>
                                    </div>
                                    
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">CIN : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                          <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "12" name="cin"  id="cin" value="{{ old('cin') }}" placeholder="CIN"/>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Nom Complet : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom complet " name="nom" value="{{ old('nom') }}" id="nom">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Nationalité : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                            <select class="form-control" required name="nationalite_id" value="{{ old('nationalite_id') }}" id="nationalite_proprietaire"  >
                                                <option value="86" {{ old('nationalite_id') == '86' ? 'selected' : '' }}>MG</option>
                                                @foreach ($nationalites as $nationalite)
                                                <option value="{{ $nationalite->id }}" {{ old('nationalite_id') == $nationalite->id ? 'selected' : '' }}>
                                                    {{ $nationalite->nationalite }}
                                                </option>
                                                @endforeach
                                            </select><br/>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Adresse : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse" name="adresse" value="{{ old('adresse') }}" id="adresse">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Fokontany : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                            <select class="form-control" required name="fokontany_id" id="fokotany_proprietaire"  >
                                                @foreach ($fokontanys as $fokotany)
                                                <option value="{{ $fokotany->id }}"  {{ old('fokontany_id') == $fokotany->id ? 'selected' : '' }}>
                                                    {{ $fokotany->fokotany }}
                                                </option>
                                                @endforeach
                                            </select>
                                      </div>
                                  </div>  
                                  <div class="form-group row">
                                        <div class="col">
                                            <label class="">Numéro Tel : <span style="color: red">*</span></label>
                                            <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="num_tel" value="{{ old('num_tel') }}" id="num_tel" placeholder="Numero téléphone"/>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="">Lien : <span style="color: red">*</span></label>
                                            <input type="number" class="form-control form-control-bold form-control-center" placeholder="lien" name="lien" id="lien"  value="0" readonly>
                                        </div>
                                        <div class="col">
                                            <label class="">Email :</label>
                                            <input type="email" class="form-control form-control-bold form-control-center" placeholder="Email" name="email" value="{{ old('email') }}" id="email">
                                        </div>
                                    </div>
                                  <br/><hr/>
                                  <div class="header" style="padding-bottom: 3%">
                                        <h4 class="title" style="text-align: center">A propos de l'Etablissement</h4><hr/>
                                  </div>
                                  <input type="hidden" class="form-control form-control-bold form-control-center" name="num_entreprise"  id="num_entreprise">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Identification :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-bold form-control-center" value="{{$identification_stat}}" name="identification_stat" id="identification_stat" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Sigle : <span style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-bold form-control-center" placeholder="Sigle" name="sigle" value="{{ old('sigle') }}" id="sigle">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Adresse : <span style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse de l'etablissement" name="adresse_etab" value="{{ old('adresse_etab') }}" id="adresse_etab">
                                    </div>
                                </div>
                                <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Fokontany : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                            <select class="form-control" required name="fokotany_id" id="fokotany_etab"  >
                                                @foreach ($fokontanys as $fokotany)
                                                <option value="{{ $fokotany->id }}"  {{ old('fokotany_id') == $fokotany->id ? 'selected' : '' }}>
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
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "25" name="fond" value="{{ old('fond') }}" id="fond" placeholder="Fond"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label class=""></label>
                                        <input type="hidden" />
                                    </div>
                                    <div class="col">
                                        <label class="">Numéro Tel Etablissement : <span style="color: red">*</span></label>
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="tel_etab"  value="{{ old('tel_etab') }}" id="tel_etab" placeholder="Telephone établissement"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Numéro patente : <span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-bold form-control-center" placeholder="Numéro patente" name="num_patente" value="{{ old('num_patente') }}" id="num_patente">
                                    </div>
                                    <div class="col">
                                        <label class="">Boite postale :</label>
                                        <input type="text" class="form-control form-control-bold form-control-center" placeholder="Boite postale" name="bp" value="{{ old('bp') }}" id="bp">
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
                                                <option value="Oui" {{ old('comptabilite') == 'Oui' ? 'selected' : '' }}>Oui</option>
                                                <option value="Non" {{ old('comptabilite') == 'Non' ? 'selected' : '' }}>Non</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Duplicata : <span style="color: red">*</span></label>
                                        <select class="form-control" required name="duplicata" id="duplicata"  >       
                                                <option value="0" {{ old('duplicata') == '0' ? 'selected' : '' }}>0</option>
                                                <option value="1" {{ old('duplicata') == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ old('duplicata') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ old('duplicata') == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ old('duplicata') == '4' ? 'selected' : '' }}>4</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="">Type : <span style="color: red">*</span></label>
                                        <select class="form-control" required name="type" id="type"  >       
                                                <option value="C"  {{ old('type') == 'C' ? 'selected' : '' }}>Création</option>
                                                <option value="M"  {{ old('type') == 'M' ? 'selected' : '' }}>Modification</option>
                                                <option value="A"  {{ old('type') == 'A' ? 'selected' : '' }}>Abandon</option>
                                                <option value="R"  {{ old('type') == 'R' ? 'selected' : '' }}>Réprise</option>
                                                <option value="U"  {{ old('type') == 'U' ? 'selected' : '' }}>Mutation</option>
                                                <option value="Re"  {{ old('type') == 'Re' ? 'selected' : '' }}>Réenregistré</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Activité Principal : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                            <select class="form-control" required name="activite_id" id="activite_etab"  >
                                                @foreach ($activites as $activite)
                                                <option value="{{ $activite->id }}" {{ old('activite_id') == $activite->id ? 'selected' : '' }}>
                                                    {{ $activite->id."-".$activite->description }}
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
                                                <option value="{{ $activite->description }}" {{ old('activite_sec1') == $activite->description ? 'selected' : '' }}>
                                                    {{ $activite->id."-".$activite->description }}
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
                                                <option value="{{ $activite->description }}"{{ old('activite_sec2') == $activite->description ? 'selected' : '' }}>
                                                    {{ $activite->id."-".$activite->description }}
                                                </option>
                                                @endforeach
                                            </select>
                                      </div>
                                </div>
                                <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Libelle Chef : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                            <select class="form-control" required name="lchef_id" id="lchef_etab"  >
                                                @foreach ($lchefs as $lchef)
                                                <option value="{{$lchef->id}}" {{ old('lchef_id') == $lchef->id ? 'selected' : '' }}>
                                                    {{ $lchef->id."-".$lchef->description_lchef }}
                                                </option>
                                                @endforeach
                                            </select>
                                      </div>
                                </div>
                                <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Forme Juridique : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                            <select class="form-control" required name="juridique_id" id="juridique_etab"  >
                                                @foreach ($juridiques as $juridique)
                                                <option value="{{ $juridique->id }}" {{ old('juridique_id') == $juridique->id ? 'selected' : '' }}>
                                                    {{ $juridique->id."-".$juridique->description_code_juridique  }}
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
                                        <label class="">Region :</label>
                                        <input type="text" class="form-control form-control-bold form-control-center"  name="region_etab" id="region_etab" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Commune : <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                            <select class="form-control" required name="commune_id" id="commune_etab"  >
                                                @foreach ($communes as $c)
                                                <option value="{{ $c->id }}" {{ old('commune_id') == $c->id ? 'selected' : '' }}>
                                                    {{ $c->commune  }}
                                                </option>
                                                @endforeach
                                            </select>
                                      </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label class=""></label>
                                        <label class="">Salariés Malagasy : <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col">
                                        <label class=""></label>
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="malagasy_m" value="{{ old('malagasy_m') }}" id="malagasy_m" placeholder="Masculin"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class=""></label>
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="malagasy_f" value="{{ old('malagasy_f') }}" id="malagasy_f" placeholder="Feminin"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label class="">Salariés Etrangers : <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="etranger_m" value="{{ old('etranger_m') }}" id="etranger_m" placeholder="Masculin"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "5" name="etranger_f" value="{{ old('etranger_f') }}" id="etranger_f" placeholder="Feminin"/>
                                    </div>
                                </div>
    
                                    <br/>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label"></label>
                                      <div class="col-sm-10" >
                                          {{-- {{Form::submit('Envoyer', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_proprietaire'])}}  --}}
                                          <button type="submit" class="btn btn-outline-primary"> Ajouter</button>
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