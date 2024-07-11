@extends('layout.layout')

@section('title')
    Ajouter Commune
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Ajout d'une commune</h4>
                      </div>
                
                          {!! Form::open(['method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Code Commune : <span style="color: red">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code du commune" name="code_commune" id="code_commune">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Commune : <span style="color: red">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom de la commune" name="commune" id="commune">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Code du district : <span style="color: red">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code du district" name="code_district" id="code_district">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">District : <span style="color: red">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom du district" name="district" id="district">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Code de la Region : <span style="color: red">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code de la region" name="code_region" id="code_region">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Region : <span style="color: red">*</span></label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nom de la region" name="region" id="region">
                                  </div>
                              </div>
                                
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label"></label>
                                  <div class="col-sm-9">
                                      {{Form::submit('Ajouter', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_commune'])}} 
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