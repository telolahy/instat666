@extends('layout.layout')

@section('title')
    Ajouter Lchef
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Modification d'une Nationalité :</h4>
                      </div>
                
                          {!! Form::open(['method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$nationalite->id}}" name="id" id="id">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Code de la Nationalité:</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Code de la nationalité" value="{{$nationalite->code_nationalite}}" name="code_nationalite" id="code_nationalite">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nationalité:</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Nationalite" value="{{$nationalite->nationalite}}" name="nationalite" id="nationalite">
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                      {{Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary', 'id' => 'modifier_nationalite'])}} 
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