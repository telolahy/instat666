@extends('layout.layout')

@section('title')
List Commune
@endsection

{{-- {{ Form::hidden('', $increment=1 ) }} --}}

@section('contenu')

<div class="col-sm-12">
    <div class="card tabs-card">
        <div class="card-block p-0">
            <div class="tab-content card-block">
                <div class="header" style="padding-bottom: 3%">
                    <h4 class="title" style="text-align: center">Sélectionner le Propriétaire :</h4>
                </div>

                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>CIN</th>
                                    <th>Nom Complet</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proprietaires as $proprietaire)
                                    <tr class="table" id={{$proprietaire->id}}>
                                        <td>{{$proprietaire->cin}}</td>
                                        <td>{{$proprietaire->nom}}</td>
                                        <td>
                                            <a onclick="window.location='{{url('/etab_proprietaire_exist/'.$proprietaire->id)}}'" data-toggle="tooltip" title="Sélectionner ce propriétaire" class="modifier" id=""><h6><i class="ti ti-target" style="color: #1e7e34"></i></h6></a><br/>
                                        </td>
                                     </tr>  
                                @endforeach  
                            </tbody>
                        </table>
                    </div>
                </div>
              <div class="modal fade" id="doleanceModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Doléance</h5>
                        <button type="button" id="fermer" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>  
                      <div class="modal-body">
                        <textarea type="text" id="doleance" placeholder="Votre doléance" name="doleance" class="form-control" >
                        </textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" id="envoye_doleance" class="btn btn-primary">Envoyer</button>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- tabs card end -->

<div class="modal fade" id="modal_commune" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="value_commune" type="hidden" class="form-control form" />
        Vous voulez vraiment supprimer cette Commune ??
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-outline-warning btn-sm" id="supprimer_commune">Oui</button>
      </div>
    </div>
  </div>
</div>


@endsection

