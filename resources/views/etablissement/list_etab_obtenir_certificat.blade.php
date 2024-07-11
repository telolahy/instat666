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
                    <h4 class="title" style="text-align: center">Sélectionner l'Etablissement :</h4>
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
                                        <td>{{$etablissement->cin}}</td>
                                        <td>{{$etablissement->nom}}</td>
                                        <td>
                                            <a onclick="window.location='{{url('/form_quittance_certificat_existence/'.$etablissement->id)}}'" data-toggle="tooltip" title="Sélectionner cette etablissement" class="modifier" id=""><h6><i class="ti ti-marker-alt" style="color: #1e7e34"></i></h6></a><br/>
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



@endsection

