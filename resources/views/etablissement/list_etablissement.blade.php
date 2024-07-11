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
        <div class="header d-flex justify-content-between align-items-center" style="padding-bottom: 3%">
          <h4 class="title" style="text-align: center">Liste des établissements :</h4>
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
          <form class="form-inline" method="GET"   action="{{route('search')}}">
              @csrf
            <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search">
            <button class="btn btn-success"  type="submit">Search</button>
          </form>
        </div>

        <div class="card-block table-border-style">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Identification</th>
                  <th>Sigle</th>
                  <th>Propriétaire</th>
                  <th>CIN</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($etablissements as $etablissement)
                <tr class="table" id={{$etablissement->id}}>
                  <td>{{$etablissement->identification_stat}}</td>
                  <td>{{$etablissement->sigle}}</td>
                  <td>{{$etablissement->nom}}</td>
                  <td>{{$etablissement->cin}}</td>
                  <td>
                    @if ($etablissement->status == "En attente")
                    <button class="btn btn-warning btn-outline-warning"><i class="icofont icofont-warning-alt"></i>En attente</button>
                    @else
                    <button class="btn btn-success btn-outline-success"><i class="icofont icofont-check-circled"></i>Validé</button>
                    @endif
                  </td>
                  <td>
                    <a onclick="window.location='{{url('/etab_proprietaire/'.$etablissement->id)}}'" data-toggle="tooltip" title="Afficher plus" class="modifier" id="">
                      <h6><i class="ti ti-plus" style="color: #1e7e34"></i></h6>
                    </a><br />
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="d-flex justify-content-end">
            {{ $etablissements->links() }}
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
                <textarea type="text" id="doleance" placeholder="Votre doléance" name="doleance" class="form-control">
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