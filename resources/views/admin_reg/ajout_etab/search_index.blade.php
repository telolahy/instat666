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
                <div class="d-flex justify-content-between align-items-center" style="padding-bottom: 3%">
                    <h4 class="title" >Veuillez sélectionner la commune de résidence du propriétaire :</h4>
                    <form class="form-inline" method="GET"   action="{{route('search_commune_reg')}}">
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
                                            <a href="{{route('ajout_saisisseur_ft',$commune->id)}}" class="btn btn-outline-primary" id="">Ajouter</a><br/>
                                        </td>
                                     </tr>  
                                @endforeach  
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start">
                          
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

