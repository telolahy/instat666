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
                          <h4 class="title" style="text-align: center">Ajout d'un activité :</h4>
                      </div>
                
                          {!! Form::open(['method' => 'POST']) !!}
                              {{ csrf_field() }} 
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Classe : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Classe de l'activité" name="classe" id="classe">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Catégorie : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Catégorie de l'activité" name="categorie" id="categorie">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Description : <span style="color: red">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" placeholder="Description de l'activité" name="description" id="description">
                                  </div>
                              </div>  
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                      {{Form::submit('Ajouter', ['class' => 'btn btn-outline-primary', 'id' => 'ajout_activite'])}} 
                                  </div>
                              </div> 
                          {!! Form::close() !!}
                         {{-- <br> <span style="color: red;">* :  Champ obligatoire</span>  --}}
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection