@extends('layout.layout')

@section('title')
Ajouter Lchef
@endsection

@section('contenu')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5>Chart d'établissements crées :</h5>
            <div class="card-header-right">                                                             <i class="icofont icofont-spinner-alt-5"></i>                                                         </div>
        </div>
        <div class="card-block">
           <canvas id="myChart" height="120"></canvas>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  
      var labels =  {{ Js::from($labels) }};
      var users =  {{ Js::from($data) }};
  
      const data = {
        labels: labels,
        datasets: [{
          label: 'Nombre d\'établissements crées par mois',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'red',
          data: users,
        }]
      };
  
      const config = {
        type: 'line',
        data: data,
        options: {}
      };
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
  
</script>
@endsection

