@extends('layout.layout')

@section('title')
    Ajouter Fokontany
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Modification d'un Utilisateur</h4>
                      </div>
                
                          {!! Form::open(['action' => 'App\Http\Controllers\UserController@modifier_user', 'method' => 'POST', 'enctype'=> 'multipart/form-data', 'id'  => 'userForm' ]) !!}
                              {{ csrf_field() }}
                              <input type="hidden" class="form-control form-control-bold form-control-center" value="{{$user->id}}" name="id" id="id">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Photo :</label>
                                  <div class="col-sm-10">
                                      <input type="file" class="form-control form-control-bold form-control-center" name="image" id="image" >
                                  </div>
                                </div> 
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Email :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value="{{$user->email}}" name="email" id="email" readonly>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Nom :</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control form-control-bold form-control-center" value="{{$user->name}}" name="name" id="name">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Region :</label>
                                  <div class="col-sm-10">
                                        <select class="form-control" required name="region_user" id="region_user" value="{{$user->region_user}}" >
                                            @foreach ($communes as $commune)
                                            <option value="{{ $commune->region }}">
                                                {{ $commune->region }}
                                            </option>
                                            @endforeach
                                        </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Rôle :</label>
                                  <div class="col-sm-10">
                                      <select class="form-control" required name="role" id="role" value="{{$user->role}}" >
                                            <option value="super_admin">super_admin</option>
                                            <option value="admin_par_region">admin_par_region</option>
                                            <option value="saisisseur">saisisseur</option>
                                        </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Mot de passe :</label>
                                  <div class="col-sm-10">
                                      <input type="password" class="form-control form-control-bold form-control-center" placeholder=" Nouveau mot de passe" name="password" id="password">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"> Confirmation du Mot de passe :</label>
                                  <div class="col-sm-10">
                                      <input type="password" class="form-control form-control-bold form-control-center" placeholder="Confirmer le nouveau mot de passe" name="password2" id="password2">
                                  </div>
                              </div>
                                
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                      {{Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary', 'id' => 'modifier_user'])}} 
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