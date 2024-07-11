@extends('layout.layout')

@section('title')
    Modifier Forme Juridique
@endsection
   
@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Modification d'une Forme Juridique :</h4>
                      </div>
                
                          {!! Form::open(['method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              
                              <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$juridique->id}}" name="id" id="id">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value="{{$juridique->code}}" name="code" id="code">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Forme Juridique :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value="{{$juridique->alias_code_juridique}} "name="alias_code_juridique" id="alias_code_juridique">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Description :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value= "{{$juridique->description_code_juridique}}" name="description_code_juridique" id="description_code_juridique" maxlength="255">
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                      {{Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary', 'id' => 'modifier_juridique'])}} 
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