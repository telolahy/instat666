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
                          <h4 class="title" style="text-align: center">Ancien Propriétaire</h4><hr/>
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
                           {{-- {!! Form::open(['action' => 'App\Http\Controllers\MutationController@ajout_mutation',  'method' => 'POST' , 'id' => 'proprietaireForm' ]) !!}  --}}
                           <form action="{{route('mutation_ft_admin_reg',['etab_id'=>$etablissement->id, 'prop_id'=>$etablissement->proprietaires->first()->id])}}" method="POST" id="proprietaireForm">
                            @csrf
                            {{-- @method('PUT') --}}
                                <input type="hidden" class="form-control form-control-bold form-control-center"  name="id_proprietaire" id="id_proprietaire" value="{{$etablissement->proprietaires->first()->id}}" readonly> 
                                <input type="hidden" class="form-control form-control-bold form-control-center"  name="id_etab" id="id_etab" value="{{$etablissement->id}}" readonly> 
                                
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">CIN :</label>
                                  <div class="col-sm-10">
                                      <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "12" name="ancien_cin"  id="ancien_cin" value="{{$etablissement->proprietaires->first()->cin}}" readonly/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nom Complet :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom complet " name="ancien_nom" id="ancien_nom" value="{{$etablissement->proprietaires->first()->nom}}" readonly>
                                      <input type="hidden" class="form-control form-control-bold form-control-center"  name="ancien_commune" id="ancien_commune" value="{{$etablissement->proprietaires->first()->commune->commune}}" readonly>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Adresse :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse" name="ancien_adresse" id="ancien_adresse" value="{{$etablissement->proprietaires->first()->adresse}}" readonly>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Fokotany :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse" name="ancien_fokotany" id="ancien_fokotany" value="{{$etablissement->proprietaires->first()->fokontany->fokotany}}" readonly>
                                  </div>
                              </div>  
                              <div class="form-group row">
                                    <div class="col">
                                        <label class="">Numéro Tel :</label>
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="ancien_num_tel"  id="ancien_num_tel" value="{{$etablissement->proprietaires->first()->num_tel}}" readonly/>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Lien :</label>
                                        <input type="number" class="form-control form-control-bold form-control-center" placeholder="ancien_lien" name="ancien_lien" id="ancien_lien" value="{{$etablissement->proprietaires->first()->lien}}" readonly>
                                    </div>
                                    <div class="col">
                                        <label class="">Email (facultatif) :</label>
                                        <input type="email" class="form-control form-control-bold form-control-center" placeholder="Email" name="ancien_email" id="ancien_email" value="{{$etablissement->proprietaires->first()->email}}" readonly>
                                    </div>
                                </div>
                              <br/><hr/>
                              <div class="header" style="padding-bottom: 3%">
                                    <h4 class="title" style="text-align: center">Nouveau Propriétaire</h4><hr/>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">CIN : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "12" name="cin"  id="cin" placeholder="CIN"/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nom Complet : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom complet " name="nom" id="nom" >
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nationalité : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="nationalite_proprietaire" id="nationalite_proprietaire"  >
                                            @foreach ($nationalites as $nationalite)
                                            <option value="{{ $nationalite->id }}">
                                                {{ $nationalite->nationalite }}
                                            </option>
                                            @endforeach
                                        </select><br/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Adresse : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Adresse" name="adresse" id="adresse" >
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Fokontany : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="fokotany_proprietaire" id="fokotany_proprietaire"  >
                                            @foreach ($fokontanys as $fokotany)
                                            <option value="{{ $fokotany->id }}">
                                                {{ $fokotany->fokotany }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Commune : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="commune_proprio" id="commune_proprio"  >
                                            @foreach ($communes as $commune)
                                            <option value="{{ $commune->id }}">
                                                {{ $commune->commune}}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label class="">Numéro Tel : <span style="color: red">*</span></label>
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="num_tel"  id="num_tel" placeholder="Numero Téléphone" />
                                    </div>
                                    <div class="col">
                                        <label class="">Email (facultatif) :</label>
                                        <input type="email" class="form-control form-control-bold form-control-center" placeholder="Email" name="email" id="email" >
                                        <input type="hidden" class="form-control form-control-bold form-control-center"value="0" name="lien" id="lien" >
                                    </div>
                                </div>
                                  
                                  
                                  
                                  <br/>
                            <hr/>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10" >
                                    {{-- {{Form::submit('Envoyer', ['class' => 'btn btn-outline-primary', 'id' => 'mutation'])}}  --}}
                                    <button type="submit" class="btn btn-outline-primary">Mutation</button>
                                </div>
                            </div>
                              {{-- <div class="header" style="padding-bottom: 3%">
                                    <h4 class="title" style="text-align: center">Droit de Mutation </h4><hr/>
                              </div> --}}
                            {{-- <div class="form-group row" hidden> --}}
                                  {{-- <label class="col-sm-2 col-form-label">Num :</label>
                                  <div class="col-sm-10">
                                      <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$etablissement->id}}" name="etab_id" id="etab_id">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Numéro Quittance :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Numéro du quitance" name="num_quitance" id="num_quitance">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Type :</label>
                                  <div class="col-sm-10">
                                      <select class="form-control" required name="type_quitance" id="type_quitance" > 
                                            <option value="U">Mutation</option> 
                                            <option value="M">Modification</option>     
                                            <option value="C">Creation</option>
                                            <option value="A">Abandon</option>
                                            <option value="R">Réprise</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Droit à payé :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Droit en Ariary" name="prix" id="prix">
                                  </div>
                              </div> --}}

                                <br/>
                              
                            </form>
                          
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection