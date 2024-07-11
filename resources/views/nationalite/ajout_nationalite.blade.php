@extends('layout.layout')

@section('title')
    Ajouter Nationalite
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Ajout d'une Nationalité :</h4>
                      </div>
                
                          {!! Form::open(['method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code de la Nationalité : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code de la Nationalité" name="code_nationalite" id="code_nationalite">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nationalité : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder=" Nationalité" name="nationalite" id="nationalite">
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                      {{Form::submit('Ajouter', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_nationalite'])}} 
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