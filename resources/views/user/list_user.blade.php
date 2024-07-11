@extends('layout.layout')

@section('title')
Ajouter Etabissement
@endsection

{{-- {{ Form::hidden('', $increment=1 ) }} --}}

@section('contenu')

<div class="col-sm-12">
    <div class="card tabs-card">
        <div class="card-block p-0">
            <div class="tab-content card-block">
                <div class="header" style="padding-bottom: 3%">
                    <h4 class="title" style="text-align: center">Liste des Utilisateurs :</h4>
                </div>

                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Region</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="table" id={{$user->id}}> 
                                        <td><img src="assets/images/auth/{{$user->image}}" alt="" width="50px" height="50px" style="border: 50%;"></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->region_user}}</td>
                                        @if ($user->role == "admin_par_region")
                                            <td>Administrateur <br> par région</td>  
                                        @elseif($user->role == "super_admin")
                                            <td>Super <br> Administrateur</td> 
                                        @else
                                            <td>Saisisseur des <br> données</td> 
                                        @endif
                                        <td>
                                            <a onclick="window.location='{{url('/form_edit_user/'.$user->id)}}'" data-toggle="tooltip" title="Modifier" class="modifier" id=""><h6><i class="ti ti-pencil-alt" style="color: #1e7e34"></i></h6></a><br/>
                                            <a data-toggle="tooltip" title="Supprimer" class="affiche_modal_user" id={{$user->id}}><h6><i class="ti ti-trash" style="color: #f50909"></i></h6></a>
                                        </td>
                                     </tr>  
                                     {{-- {{ Form::hidden('', $increment= $increment + 1 ) }} --}}
                                @endforeach  
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- tabs card end -->

<div class="modal fade" id="modal_user" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="value_user" type="hidden" class="form-control form" />
        Vous voulez vraiment supprimer cet utilisateur ??
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-outline-warning btn-sm" id="supprimer_user">Oui</button>
      </div>
    </div>
  </div>
</div>


@endsection

