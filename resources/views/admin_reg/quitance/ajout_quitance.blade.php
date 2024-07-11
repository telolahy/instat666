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
                        @if ($etablissement->status == "En attente")
                          <h4 class="title" style="text-align: center">Quittance</h4>
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
                     
                          {{-- {!! Form::open(['action' => 'App\Http\Controllers\QuitanceController@ajout_quitance', 'method' => 'POST']) !!} --}}
                          <form action="{{route('quitance_reg_form_ft')}}" method="post">
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
                        
                                    
                                         {{-- {{Form::submit('Ajouter', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_quitance',])}}  --}}
                                         <button type="submit" class="btn btn-outline-primary">Ajouter</button>
                                    
                                      
                                  </div>
                              </div> 
                          {{-- {!! Form::close() !!} --}}

                            </form>
                        
                    
                          <a href='{{route('carte_state',$etablissement->id)}}' class="btn btn-success btn-outline-success" style="margin: auto; display: none" id="carte_statistique"><i class="icofont icofont-info-square"></i> Carte statistique </a> 
                          {{-- <a href={{URL::to('/list_etablissement')}} class="btn btn-warning btn-outline-warning" style="margin-left: 60%;display: none" id="retour_liste"><i class="icofont icofont-exchange"></i> Revenir à la liste </a> --}}
                          {{-- <a href="{{route('reg_etab.index')}}" class="btn btn-warning btn-outline-warning" style="display: inline;margin-left: 85%"><i class="icofont icofont-exchange"></i> Retour </a> --}}
                          @endif
                          @if ($etablissement->status == "Validé")
            
                           {{-- <a href="{{ route('carte', $etablissement->id) }}" class="btn btn-danger btn-outline-danger" style="margin: auto; display: inline"><i class="icofont icofont-info-square"></i> Carte statistique </a>  --}}
                            <a href='{{route('carte_state',$etablissement->id)}}' class="btn btn-success btn-outline-success" style="margin: auto; display: inline"><i class="icofont icofont-info-square"></i> Carte statistique </a> 
                            {{-- <a href="{{route('reg_etab.index')}}" class="btn btn-warning btn-outline-warning" style="display: inline;margin-left: 85%"><i class="icofont icofont-exchange"></i> Retour </a> --}}
                            {{-- <a href={{URL::to('/list_etablissement')}} class="btn btn-warning btn-outline-warning" style="margin-left: 60%;display: inline"><i class="icofont icofont-exchange" ></i> Revenir à la liste </a> --}}
                          @endif
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection