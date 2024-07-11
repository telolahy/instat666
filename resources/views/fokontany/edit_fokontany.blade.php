@extends('layout.layout')

@section('title')
    Editer Fokontany
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Modification d'un Fokontany</h4>
                      </div>
                
                          {!! Form::open(['method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$fokotany->id}}" name="id" id="id">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code Commune :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code du commune" value="{{$fokotany->code_commune}}"  name="code_commune" id="code_commune">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Commune :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom de la commune" value="{{$fokotany->commune}}" name="commune" id="commune">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code du district :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code du district" value="{{$fokotany->code_district}}" name="code_district" id="code_district">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">District :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom du district" value="{{$fokotany->district}}" name="district" id="district">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code de la Region :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code de la region" value="{{$fokotany->code_region}}" name="code_region" id="code_region">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Region :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom de la region" value="{{$fokotany->region}}" name="region" id="region">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code du Fokontany :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code du Fokontany" value="{{$fokotany->code_fokotany}}" name="code_fokotany" id="code_fokotany">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Fokontany :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom du Fokontany" value="{{$fokotany->fokotany}}" name="fokotany" id="fokotany">
                                  </div>
                              </div>
                                
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                       {{Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary', 'id' => 'modifier_fokontany'])}} 
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