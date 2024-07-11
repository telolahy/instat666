@extends('layout.layout')

@section('title')
    Ajouter Forme Juridique
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block">
                      <div class="tab-content card-block" style="text-align: center">
                            <div class="content" style="content-align: center"><br />
                                  <img class="avatar text-center border-white" src="assets/images/auth/{{auth()->user()->image}} " width="100px" height="100px" style="align-content: center"/><br />
                                  <span></span><br />
                                  <h4 class="title">{{auth()->user()->name}}<br />
                                  </h4><br />
                                <p class="description text-center">
                                   {{auth()->user()->email}}
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5><small>Région :</small><br /><br />{{auth()->user()->region_user}}</h5>
                                    </div>
                                    <div class="col-md-4">
                                        @if (auth()->user()->role == "admin_par_region")
                                            <h5><small>Rôle :</small><br /><br />Administrateur par région</h5>
                                        @elseif (auth()->user()->role == "super_admin")
                                            <h5><small>Rôle :</small><br /><br />Super Administrateur</h5> 
                                        @else
                                            <h5><small>Rôle :</small><br /><br />Saisisseur des données</h5>
                                        @endif
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <h5><small>Compte crée :</small><br /><br />{{auth()->user()->created_at->diffForHumans()}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>  
                       </div> 
                    </div>
                </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection