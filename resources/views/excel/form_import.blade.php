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
                          <h4 class="title" style="text-align: center">Importation des données en Excel :</h4>
                      </div>
                            @if (Session::has('status'))
                                <div class="alert alert-success" style="text-align: center">
                                    {{Session::get('status')}}
                                </div>
                            @endif
                        <form action="/import_excel" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="excel">
                            <input type="submit" name="import" value="Importer" class= "btn btn-outline-primary">
                        </form>
                          
                       </div> 
                    </div>
                </div>
            </div>
              <!-- tabs card end -->

   
@endsection

@section('script')
      
@endsection