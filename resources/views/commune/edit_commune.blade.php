@extends('layout.layout')

@section('title')
    Editer Commune
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Modification d'une commune</h4>
                      </div>
                
                          {!! Form::open(['method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$commune->id}}" name="id" id="id">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code Commune :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code du commune" value="{{$commune->code_commune}}"  name="code_commune" id="code_commune">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Commune :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom de la commune" value="{{$commune->commune}}" name="commune" id="commune">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code du district :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code du district" value="{{$commune->code_district}}" name="code_district" id="code_district">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">District :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom du district" value="{{$commune->district}}" name="district" id="district">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code de la Region :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code de la region" value="{{$commune->code_region}}" name="code_region" id="code_region">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Region :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom de la region" value="{{$commune->region}}" name="region" id="region">
                                  </div>
                              </div>
                                
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                       {{Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary', 'id' => 'modifier_commune'])}} 
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