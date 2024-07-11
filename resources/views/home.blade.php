@extends('layout.layout')

@section('title')
    Ajouter Etabissement
@endsection

@section('contenu')

  <div class="row">
        <div class="col-sm-12">
            <!-- Tab variant tab card start -->
            <div class="card">
                <div class="card-block tab-icon">
                    <!-- Row start -->
                    <div class="row">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs sm-tabs " role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab_province" data-toggle="tab" href="#province" role="tab"><i class="ti ti-stats-up"></i> Provinces</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#juridique" role="tab"><i class="ti ti-stats-up"></i> Formes Juridiques</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab_secteur" data-toggle="tab" href="#secteur" role="tab"><i class="ti ti-stats-up"></i> Secteurs</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#nation" role="tab"><i class="ti ti-stats-up"></i> Nations</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#salarie" role="tab"><i class="ti ti-stats-up"></i> Salariés</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#jour" role="tab"><i class="ti ti-stats-up"></i> Type de mis à jour</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content card-block">
                                <div class="tab-pane active" id="province" role="tabpanel">
                                    <div id="linechart_province"></div>
                                </div>
                                <br/>
                                <div class="tab-pane active" id="juridique" role="tabpanel">
                                    <div id="linechart_juridique"></div>
                                </div>
                                <br/>
                                <div class="tab-pane active" id="secteur" role="tabpanel">
                                   <div id="linechart_secteur"></div>
                                </div>
                                <div class="tab-pane active" id="nation" role="tabpanel">
                                    <div id="linechart_nation"></div>
                                </div>
                                <div class="tab-pane active" id="salarie" role="tabpanel">
                                    <div id="linechart_salarie"></div>
                                </div>
                                <div class="tab-pane active" id="jour" role="tabpanel">
                                    <div id="linechart_type"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
            <!-- Tab variant tab card start -->
        </div>
    </div>
  <!-- tabs card end -->
   
@endsection

@section('script')

<script type="text/javascript">

     google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(provinceChart);
      google.charts.setOnLoadCallback(juridiqueChart);
      google.charts.setOnLoadCallback(secteurChart); 
      google.charts.setOnLoadCallback(nationChart);
      google.charts.setOnLoadCallback(salarieChart);  
      google.charts.setOnLoadCallback(typeChart); 
    
      // province

    function provinceChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Année');
      data.addColumn('number', 'Fianarantsoa');
      data.addColumn('number', 'Antananarivo');
      data.addColumn('number', 'Toamasina');
      data.addColumn('number', 'Mahajanga');
      data.addColumn('number', 'Toliary');
      data.addColumn('number', 'Antsiranana');

      data.addRows([
        <?php echo $data_province; ?> 
      ]);

      var options = {
        chart: {
          title: 'Nombre d\' établissements crée par province'
        },
        width: 1000,
        height: 450, 
        vAxis: { format: ''}
      };
        var chart = new google.charts.Line(document.getElementById('linechart_province'));
      chart.draw(data, google.charts.Line.convertOptions(options));

    }

    //  juridique

    function juridiqueChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Année');
      data.addColumn('number', 'Entreprise Individuelle');
      data.addColumn('number', 'Entreprise Unipersonnelle à Responsabilité Limitée');
      data.addColumn('number', 'Société Anonyme');
      data.addColumn('number', 'Société Anonyme à Responsabilité Limitée');
      data.addColumn('number', 'Autre formes juridiques');

      data.addRows([
        <?php echo $data_juridique; ?> 
      ]);

      var options = {
        chart: {
          title: 'Nombre d\' établissements crée par formes juridiques ',
        },
        width: 1000,
        height: 450, 
        vAxis: { format: ''}
      };

      var chart = new google.charts.Line(document.getElementById('linechart_juridique'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }

    // secteur
    
    function secteurChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Année');
      data.addColumn('number', 'Secteur Primaire');
      data.addColumn('number', 'Secteur Sécondaire');
      data.addColumn('number', 'Secteur Tertiaire');

      data.addRows([
        <?php echo $data_secteur; ?> 
      ]);

      var options = {
        chart: {
          title: 'Nombre d\' établissements crée par secteur d\'activité ',
        },
        width: 1000,
        height: 450, 
        vAxis: { format: ''}
      };

      var chart = new google.charts.Line(document.getElementById('linechart_secteur'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }

    // nation

    function nationChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Année');
      data.addColumn('number', 'Etranger');
      data.addColumn('number', 'Malagasy');

      data.addRows([
        <?php echo $data_nation; ?> 
      ]);

      var options = {
        chart: {
          title: 'Nombre d\' établissements crée par nation ',
        },
        width: 1000,
        height: 450, 
        vAxis: { format: ''}
      };

      var chart = new google.charts.Line(document.getElementById('linechart_nation'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }

    // salarié

    function salarieChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Année');
      data.addColumn('number', '0 salarié');
      data.addColumn('number', '1 à 5 salariés');
      data.addColumn('number', '5 à 10 salariés');
      data.addColumn('number', '10 à 15 salariés');
      data.addColumn('number', '15 à 20 salariés');
      data.addColumn('number', '20 à 50 salariés');
      data.addColumn('number', '50 à 100 salariés');
      data.addColumn('number', '100 à 200 salariés');
      data.addColumn('number', '+ 200 salariés');

      data.addRows([
        <?php echo $data_salarie; ?> 
      ]);

      var options = {
        chart: {
          title: 'Nombre d\' établissements crée par salarié ',
        },
        width: 1000,
        height: 450, 
        vAxis: { format: ''}
      };

      var chart = new google.charts.Line(document.getElementById('linechart_salarie'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }

    // type mis a jour

    function typeChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Année');
      data.addColumn('number', 'Annulation');
      data.addColumn('number', 'Création');
      data.addColumn('number', 'Modification');
      data.addColumn('number', 'Mutation');
      data.addColumn('number', 'Reprise');

      data.addRows([
        <?php echo $data_type_mis_a_jour; ?> 
      ]);

      var options = {
        chart: {
          title: 'Nombre d\' établissements crée par Type de mis à jour ',
        },
        width: 1000,
        height: 450, 
        vAxis: { format: ''}
      };

      var chart = new google.charts.Line(document.getElementById('linechart_type'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }

</script>
@endsection
