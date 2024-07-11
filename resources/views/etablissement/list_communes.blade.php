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
                    <h4 class="title" style="text-align: center">Sélectionner la commune que le propriétaire réside :</h4>
                    @if(session('message'))
                      <div class="alert alert-success">
                          {{ session('message') }}
                      </div>
                    @endif

                    @if(session('error'))
                      <div class="alert alert-danger">
                        {{ session('error') }}
                      </div>
                    @endif
                </div>

                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Code Commune</th>
                                    <th>Commune</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($communes as $commune)
                                    <tr class="table" id={{$commune->id}}>
                                        <td>{{$commune->code_commune}}</td>
                                        <td>{{$commune->commune}}</td>
                                        <td>
                                            <a onclick="window.location='{{url('/form_proprietaire/'.$commune->id)}}'" data-toggle="tooltip" title="Sélectionner cette commune" class="modifier" id=""><h6><i class="ti ti-target" style="color: #1e7e34"></i></h6></a><br/>
                                        </td>
                                     </tr>  
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

