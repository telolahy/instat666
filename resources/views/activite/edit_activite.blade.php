@extends('layout.layout')

@section('title')
    Modifier Etabissement
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Modification de l'activité :</h4>
                      </div>
                
                          {!! Form::open(['method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$activite->id}}" name="id" id="id">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Catégorie :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value="{{$activite->categorie}}" name="categorie" id="categorie">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Classe :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value="{{$activite->classe}}" name="classe" id="classe">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Description :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value="{{$activite->description}}" name="description" id="description">
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                      {{Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary', 'id' => 'modifier_activite'])}} 
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