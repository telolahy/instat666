@extends('layout.layout')

@section('title')
    Ajouter Etabissement
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Quittance</h4>
                      </div>
                
                          {!! Form::open(['action' => 'App\Http\Controllers\QuitanceController@ajout_quitance', 'method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              <div class="form-group row" hidden>
                                  <label class="col-sm-2 col-form-label">Num :</label>
                                  <div class="col-sm-10">
                                      <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$etablissement->id}}" name="etab_id" id="etab_id">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Numéro de Quittance : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Numéro du quitance" name="num_quitance" id="num_quitance">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Type : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <select class="form-control" required name="type_quitance" id="type_quitance" >       
                                            <option value="C">Création</option>
                                            <option value="M">Modification</option>
                                            <option value="A">Abandon</option>
                                            <option value="R">Réprise</option>
                                            <option value="U">Mutation</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Droit à payé : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Droit en Ariary" name="prix" id="prix">
                                  </div>
                              </div> <br/>
                              
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                        
                                    @if ($etablissement->status == "En attente")

                                         {{Form::submit('Ajouter', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_quitance',])}} 
                                    @endif
                                      
                                  </div>
                              </div> 
                          {!! Form::close() !!}
                          <button onclick="window.location='{{url('/carte_statistique/'.$etablissement->id)}}'" class="btn btn-success btn-outline-success" style="margin: auto; display: none" id="carte_statistique"><i class="icofont icofont-info-square"></i> Carte statistique </button> 
                          <a href={{URL::to('/list_etablissement')}} class="btn btn-warning btn-outline-warning" style="margin-left: 60%;display: none" id="retour_liste"><i class="icofont icofont-exchange"></i> Revenir à la liste </a>

                          @if ($etablissement->status == "Validé")
                           {{-- <a href="{{ route('carte', $etablissement->id) }}" class="btn btn-danger btn-outline-danger" style="margin: auto; display: inline"><i class="icofont icofont-info-square"></i> Carte statistique </a>  --}}
                            <button onclick="window.location='{{url('/carte_statistique/'.$etablissement->id)}}'" class="btn btn-success btn-outline-success" style="margin: auto; display: inline"><i class="icofont icofont-info-square"></i> Carte statistique </button> 
                            <a href={{URL::to('/list_etablissement')}} class="btn btn-warning btn-outline-warning" style="margin-left: 60%;display: inline"><i class="icofont icofont-exchange" ></i> Revenir à la liste </a>
                          @endif
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection