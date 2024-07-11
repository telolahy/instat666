@extends('layout.layout')


@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">A propos de l'établissement :</h4><hr/>
                      </div>
                           {!! Form::open(['action' => 'App\Http\Controllers\EtablissementController@ajout_quittance_reprise_etablissement',  'method' => 'POST' , 'id' => 'proprietaireForm' ]) !!} 
                                <input type="hidden" class="form-control form-control-bold form-control-center"  name="id_etab" id="id_etab" value="{{$etablissement->id}}" readonly> 
                                
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">N° d'Identification :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center"  name="identification_stat"  id="identification_stat" value="{{$etablissement->identification_stat}}" readonly/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Sigle :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center"  name="sigle"  id="sigle" value="{{$etablissement->sigle}}" readonly/>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">CIN :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center"  name="cin" id="cin" value="{{$etablissement->proprietaire->cin}}" readonly>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nom du proprietaire :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center"  name="nom" id="nom" value="{{$etablissement->proprietaire->nom}}" readonly>
                                  </div>
                              </div>  
                            <hr/>
                              <div class="header" style="padding-bottom: 3%">
                                    <h4 class="title" style="text-align: center">Droit de Reprise </h4><hr/>
                              </div>
                            <div class="form-group row" hidden>
                                  <label class="col-sm-2 col-form-label">Num :</label>
                                  <div class="col-sm-10">
                                      <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$etablissement->id}}" name="etab_id" id="etab_id">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Numéro Quittance : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Numéro du quitance" name="num_quitance" id="num_quitance">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Type : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <select class="form-control" required name="type_quitance" id="type_quitance" > 
                                            <option value="Reprise">Reprise</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Droit à payé : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Droit en Ariary" name="prix" id="prix" >
                                  </div>
                              </div>

                                <br/>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10" >
                                      {{Form::submit('Envoyer', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_quittance_reprise_etablissement'])}}  
                                  </div>
                             </div>      
                          {!! Form::close() !!}
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection