@extends('layout.layout')


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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($etablissements as $etablissement)
                                    <tr class="table" id={{$etablissement->id}}>
                                        <td>{{$etablissement->identification_stat}}</td>
                                        <td>{{$etablissement->sigle}}</td>
                                        <td>{{$etablissement->proprietaires->first()->cin}}</td>
                                        <td style="width: 2px">{{$etablissement->proprietaires->first()->nom}}</td>
                                        <td>
                                          @if ($etablissement->type == "Annulation")
                                            <h6><span class="label label-danger" id="span_danger">Annulé</span></h6>
                                          @else
                                            <h6><span class="label label-success" id="span_success">En cours de  fonctionnement</span></h6>
                                          @endif
                                        </td>
                                        <td>
                                          @if ($etablissement->type == "Annulation")
                                            <a onclick="window.location='{{url('/certificat_annulation_etablissement/'.$etablissement->id)}}'" data-toggle="tooltip" title="Certificat d'annulation" class="certificat_annulation"><h6><i class="ti ti-import" style="color: #04eb04b7"></i></h6></a><br/>
                                          @else
                                            <a  data-toggle="tooltip" title="Annuler cet établissement" class="annulation" id="a_{{$etablissement->id}}" name="{{$etablissement->id}}"><h6><i class="ti ti-close" style="color: #fa0909;"></i></h6></a>
                                            <a onclick="window.location='{{url('/certificat_annulation_etablissement/'.$etablissement->id)}}'" data-toggle="tooltip" title="Certificat d'annulation" class="certificat_annulation" id="c_{{$etablissement->id}}" style="display: none"><h6><i class="ti ti-import" style="color: #04eb04b7"></i></h6></a><br/>
                                          @endif
                                        </td>
                                     </tr>  
                                @endforeach  
                            </tbody>
                        </table>
                    </div>
                </div>
              <div class="modal fade" id="modal_annulation" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Annulation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <input id="value_etablissement" type="hidden" class="form-control form" />
                        <input id="id_etablissement" type="hidden" class="form-control form" />
                        Vous voulez vraiment annuler cette etablissement ??
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Non</button>
                        <button type="button" class="btn btn-outline-warning btn-sm" id="annuler_etablissement">Oui</button>
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

