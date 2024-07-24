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
                    <h4 class="title" style="text-align: center">Liste des établissements avec son propriétaire :</h4>
                </div>

                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Identification</th>
                                    <th>Sigle</th>
                                    <th>CIN</th>
                                    <th>Propriétaire</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($etablissements as $etablissement)
                                    <tr class="table" id={{$etablissement->id}}>
                                        <td>{{$etablissement->identification_stat}}</td>
                                        <td>{{$etablissement->sigle}}</td>
                                        <td>{{$etablissement->proprietaires->first()->cin}}</td>
                                        <td>{{$etablissement->proprietaires->first()->nom}}</td>
                                        <td>
                                            <a onclick="window.location='{{route('saisie_enregistrement.edit',$etablissement->id)}}'" data-toggle="tooltip" title="Modifier cet établissement" class="modifier btn btn-outline-primary rounded-circle" id="">Reenregistrement</a><br/>
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



@endsection