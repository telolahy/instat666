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
                      </div>
                           {{-- {!! Form::open(['action' => 'App\Http\Controllers\MutationController@ajout_mutation_proprio_existant',  'method' => 'POST' , 'id' => 'proprietaireForm' ]) !!}  --}}
                           <form action="{{ route('mutation_existant.update',$etablissement->id) }}" method="POST" id="proprietaireForm">
                            @csrf
                            @method('PUT')    
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
                            </form>
                              <br/><hr/>
                              <div class=" d-flex justify-content-between align-items-center" style="padding-bottom: 3%">
                                    {{-- <h4 class="title" style="text-align: center">Rechercher Nouveau Propriétaire</h4><hr/> --}}
                                    <h4 class="title" style="text-align: center">Rechercher Nouveau Propriétaire</h4><hr/>
                                    <form class="form-inline" method="POST"   action="{{route('search_existant',$etablissement->id)}}"> 
                                        @csrf
                                        @method('GET')
                                      <input class="form-control mr-sm-2" name="search_existant" type="text" placeholder="cin ou nom">
                                      <button class="btn btn-primary"  type="submit">Rechercher</button>
                                    </form>
                              </div>

                              <div class="card-block table-border-style">
                                <div class="table-responsive">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>cin</th>
                                        <th>nom</th>
                                        <th>adresse</th>
                                        <th>num</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                        {{-- <th>status</th> --}}
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($new_proprietaires as $proprietaire)
                                        {{-- @php
                                            $etablissement = $proprietaire->etablissements->first();
                                        @endphp
                                        @if ($etablissement && $etablissement->status != "En attente") --}}
                                            <tr class="table">
                                                <td>{{ $proprietaire->cin }}</td>
                                                <td>{{ $proprietaire->nom }}</td>
                                                <td>{{ $proprietaire->adresse }}</td>
                                                <td>{{ $proprietaire->num_tel }}</td>
                                                {{-- <td>{{ $proprietaire->etablissements->status }}</td> --}}
                                                <td>
                                                    <a class="btn btn-outline-primary" href="{{ route('mutation_prop_existant_admin', ['etab_id' => $etablissement->id, 'new_prop_id' => $proprietaire->id]) }}" data-toggle="tooltip" title="Afficher plus" class="modifier" id="">
                                                        Mutation
                                                    </a><br />
                                                </td>
                                            </tr>
                                        {{-- @endif --}}
                                    @endforeach

                                      
                                    </tbody>
                                  </table>
                                </div>
                      
                                <div class="d-flex justify-content-end">
                                  {{-- {{ $etablissements->links() }} --}}
                                </div>
                              </div>



                              {{-- <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">CIN : <span style="color: red">*</span></label>
                                  <input type="hidden" class="form-control form-control-bold form-control-center"  name="id_nouveau" id="id_nouveau" readonly> 
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="cin_proprietaire" id="cin_proprietaire"  >
                                            @foreach ($proprietaires as $proprietaire)
                                            <option value="{{ $proprietaire->cin }}">
                                                {{ $proprietaire->cin }}
                                            </option>
                                            @endforeach
                                        </select><br/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nom Complet : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" name="nom" id="nom" readonly>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Adresse : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" name="adresse" id="adresse" readonly>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Fokotany : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" name="fokotany" id="fokotany" readonly>
                                  </div>
                              </div>  
                              <div class="form-group row">
                                    <div class="col">
                                        <label class="">Numéro Tel : <span style="color: red">*</span></label>
                                        <input type="number" class="form-control form-control-bold form-control-center" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="num_tel"  id="num_tel" readonly/>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Lien : <span style="color: red">*</span></label>
                                        <input type="number" class="form-control form-control-bold form-control-center"  name="lien" id="lien" readonly>
                                    </div>
                                    <div class="col">
                                        <label class="">Email (facultatif) :</label>
                                        <input type="email" class="form-control form-control-bold form-control-center" name="email" id="email" readonly>
                                    </div>
                                </div>                               
                                  <br/>
                                <hr/> --}}
                            
                            

                                
                                {{-- <div class="header" style="padding-bottom: 3%">
                                    <h4 class="title" style="text-align: center">Droit de Mutation </h4><hr/>
                             
                                </div>
                                <div class="form-group row" hidden>
                                  <label class="col-sm-2 col-form-label">Num :</label>
                                  <div class="col-sm-10">
                                      <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$etablissement->id}}" name="etab_id" id="etab_id">
                                  </div>
                              </div> --}}
                              {{-- <div class="form-group row">
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
                                            <option value="C">Création</option>
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
                              {{-- <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10" >
                                       {{Form::submit('Envoyer', ['class' => 'btn btn-outline-primary', 'id' => 'mutation_proprietaire_existant'])}} 
                                      <button type="submit" class="btn btn-outline-primary" id="mutation_proprietaire_existant">
                                        Envoyer
                                    </button>
                                    
                                  </div>
                              </div> --}}
                            </form>
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection