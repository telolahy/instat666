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
                        <form action="{{route('reg_etab.update',$etablissement->id)}}" method="POST" >
                           @csrf
                           @method('PUT')
                            <div class="form-group row">
                                <div class="col">
                                    <label class="">Province : <span style="color: red">*</span></label>
                                    <select class="form-control province" name="province" id="province">
                                        <option value="{{$province_prop->id}}" selected>{{$province_prop->nom_province}}</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{$province->id}}">{{$province->nom_province}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class="">Région : <span style="color: red">*</span></label>
                                    <select class="form-control region" name="region" id="region">
                                    <option value="{{$region_prop->id}}" selected>{{$region_prop->region}}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">District :</label>
                                    <select class="form-control" name="district" id="district">
                                    <option value="{{$district_prop->id}}" selected>{{$district_prop->district}}</option>

                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Commune :</label>
                                    <select class="form-control" name="commune" id="commune">
                                    <option value="{{$commune_prop->id}}" selected>{{$commune_prop->commune}}</option>

                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <hr>
                            </div>

                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">CIN : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "12" name="cin"  id="cin" value="{{$etablissement->proprietaires->first()->cin}}"/>

                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nom Complet : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-bold form-control-center" value="{{$etablissement->proprietaires->first()->nom}}" name="nom" id="nom">
                                      {{-- <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom complet " name="nom" value="{{ old('nom') }}" id="nom"> --}}
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nationalité : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="nationalite_id" id="nationalite_proprietaire"  >
                                            <option value="{{$nationalite_prop->id}}" selected>{{$nationalite_prop->nationalite}}</option>
                                            
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
                                    <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse" name="adresse" id="adresse" value="{{$etablissement->proprietaires->first()->adresse}}">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Fokontany : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                    
                                        <select class="form-control" required name="fokontany" id="fokontany"  >
                                        <option value="{{$fokontany_prop->id}}" selected>{{$fokontany_prop->fokotany}}</option>
                                        </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                    <div class="col">
                                        <label class="">Numéro Tel : <span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="num_tel"  id="num_tel" placeholder="Numero téléphone" value="{{$etablissement->proprietaires->first()->num_tel}}"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Lien : <span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-bold form-control-center" placeholder="lien" name="lien" id="lien" value="0" readonly>
                                    </div>
                                    <div class="col">
                                        <label class="">Email (facultatif) :</label>
                                        <input type="email" class="form-control form-control-bold form-control-center" placeholder="Email" name="email" id="email" value="{{$etablissement->proprietaires->first()->email}}">
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
                                <div class="col-sm-4">
                                    <label class="">Région :</label>
                                    <select class="form-control" readonly name="region_etab" id="region_etab">
                                         <option value="{{$region_user->id}}">{{$region_user->region}}</option> 
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">District :</label>
                                    <select class="form-control" name="district_etab" id="district_etab">
                                         @foreach ($district_users as $district_user)
                                        <option value="{{$district_user->id}}">{{$district_user->district}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Commune :</label>
                                    <select class="form-control" name="commune_etab" id="commune_etab">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">fokontany :</label>
                                    <select class="form-control" name="fokontany_etab" id="fokontany_etab">
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
                                    <input type="text" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="tel_etab"  value="{{ old('tel_etab') }}" id="tel_etab" placeholder="Telephone établissement"/>
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
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-bold form-control-center" placeholder="Activité Principal " name="activite_0" id="activite_0">
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="">Section:</label>
                                    <select class="form-control"  name="section_0" id="section_0">
                                        <option value="">Sélectionner une section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{$section->id}}">{{$section->code_section}} - {{$section->type_section}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Division :</label>
                                    <select class="form-control" name="division_0" id="division_0">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Groupe :</label>
                                    <select class="form-control" name="groupe_0" id="groupe_0">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Classe :</label>
                                    <select class="form-control" name="classe_0" id="classe_0">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Categorie :</label>
                                    <select class="form-control" name="categorie_0" id="categorie_0">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <hr>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Activité Secondaire1 :</label>
                                  <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-bold form-control-center" placeholder="Activité secondaire1 " name="activite_1" id="activite_1">
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="">Section:</label>
                                    <select class="form-control"  name="section_1" id="section_1">
                                        <option value="">Sélectionner une section</option>
                                         @foreach ($sections as $section)
                                            <option value="{{$section->id}}">{{$section->code_section}} - {{$section->type_section}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Division :</label>
                                    <select class="form-control" name="division_1" id="division_1">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Groupe :</label>
                                    <select class="form-control" name="groupe_1" id="groupe_1">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Classe :</label>
                                    <select class="form-control" name="classe_1" id="classe_1">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Categorie :</label>
                                    <select class="form-control" name="categorie_1" id="categorie_1">
                                    </select>
                                </div>


                            </div>
                            <div class="form-group row">
                                <hr>
                            </div>
                            <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Activité Secondaire2 :</label>
                                  <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-bold form-control-center" placeholder="Activité secondaire2" name="activite_2"  id="activite_2">
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="">Section:</label>
                                    <select class="form-control"  name="section_2" id="section_2">
                                        <option value="">Sélectionner une section</option>
                                         @foreach ($sections as $section)
                                            <option value="{{$section->id}}">{{$section->code_section}} - {{$section->type_section}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Division :</label>
                                    <select class="form-control" name="division_2" id="division_2">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Groupe :</label>
                                    <select class="form-control" name="groupe_2" id="groupe_2">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Classe :</label>
                                    <select class="form-control" name="classe_2" id="classe_2">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="">Categorie :</label>
                                    <select class="form-control" name="categorie_2" id="categorie_2">
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <hr>
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
                                      <button type="submit" class="btn btn-outline-primary"> Ajouter</button>
                                  </div>
                              </div>
                        </form>

                       </div>
                    </div>
                </div>
            </div>


@endsection

@section('script')

@endsection
