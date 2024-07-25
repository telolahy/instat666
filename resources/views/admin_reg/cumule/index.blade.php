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
          <h4 class="title" style="text-align: center">Liste des établissements à imprimer:</h4>
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
                  
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($etablissements as $etablissement)
                <tr class="table" id={{$etablissement->id}}>
                  <td>{{$etablissement->num_entreprise}}</td>
                  <td>{{$etablissement->sigle}}</td>
                  <td>{{$etablissement->proprietaires->first()->nom}}</td>
                  <td>{{$etablissement->proprietaires->first()->cin}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <a href='{{route('impression_index')}}' class="btn btn-success btn-success ml-5" style="margin: auto; display: inline"><i class="icofont icofont-info-square"></i>Imprimer </a> 
       
      </div>
    </div>
  </div>
</div>
<!-- tabs card end -->

@endsection