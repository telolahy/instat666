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
                    <h4 class="title" style="text-align: center">Liste des Formes Juridiques :</h4>
                </div>

                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Forme Juridique</th>
                                    <th>Description de la Forme Juridique</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($juridiques as $juridique)
                                    <tr class="table" id={{$juridique->id}}>
                                        <td>{{$juridique->code}}</td>
                                        <td>{{$juridique->alias_code_juridique}}</td>
                                        <td>{{$juridique->description_code_juridique}}</td>
                                        <td>
                                            <a onclick="window.location='{{url('/form_edit_juridique/'.$juridique->id)}}'" data-toggle="tooltip" title="Modifier" class="modifier" id=""><h6><i class="ti ti-pencil-alt" style="color: #1e7e34"></i></h6></a><br/>
                                            <a data-toggle="tooltip" title="Supprimer" class="affiche_modal_juridique" id={{$juridique->id}}><h6><i class="ti ti-trash" style="color: #f50909"></i></h6></a>
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

<div class="modal fade" id="modal_juridique" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="value_juridique" type="hidden" class="form-control form" />
        Vous voulez vraiment supprimer cette forme juridique ??
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-outline-warning btn-sm" id="supprimer_juridique">Oui</button>
      </div>
    </div>
  </div>
</div>


@endsection

