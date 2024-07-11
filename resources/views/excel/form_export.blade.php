@extends('layout.layout')

@section('title')
    Ajouter Etabissement
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                      <div class="tab-content card-block">
                      <div class="header" style="padding-bottom: 3%">
                          <h4 class="title" style="text-align: center">Exporter des données :</h4>
                      </div> 

                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Données</th>
                                    <th style="text-align: center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td style="text-align: center">1</td>
                                        <td style="text-align: center">Activité</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/activite')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: center">2</td>
                                        <td style="text-align: center">Etablissement</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/etablissement')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: center">3</td>
                                        <td style="text-align: center">Commune</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/commune')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: center">4</td>
                                        <td style="text-align: center">Fokontany</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/fokontany')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">5</td>
                                        <td style="text-align: center">Juridique</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/juridique')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: center">6</td>
                                        <td style="text-align: center">Libelle Chef</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/lchef')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: center">7</td>
                                        <td style="text-align: center">Nationalité</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/nationalite')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: center">8</td>
                                        <td style="text-align: center">Propriétaire</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/proprietaire')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">9</td>
                                        <td style="text-align: center">Quittance</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/quittance')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: center">10</td>
                                        <td style="text-align: center">Utilisateur</td>
                                        <td style="text-align: center">
                                            <a onclick="window.location='{{url('/export_data/user')}}'" data-toggle="tooltip" title="Exporter en Excel" ><h6><i class="ti ti-share" style="color: #046d2c"></i></h6></a><br/>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                          
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection