@extends('layout.layout')

@section('title')
    Ajouter Etabissement
@endsection

@section('contenu')

            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                        <div class="tab-content card-block">
                            <div class="header d-flex justify-content-between align-items-center " style="padding-bottom: 3%">
                                
                                <h4 class="title d-flex justify-content-start align-items-center" >Fichier Des Etablissements</h4>
                            
                                <h4 class="title d-flex justify-content-end align-items-center">Bienvenue {{auth()->user()->name}} !</h4>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

    
            @if(isset($type[0]))
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">{{ ucfirst($type[0]) }}</h6>
                        <h4 class="text-right"><i class="ti-money f-left"></i><span>{{ ucfirst($value[0]) }} Ar</span></h4><br>
                        <p class="m-b-0">Nombre cette année :<span class="f-right">{{ $data[0] }}</span></p>
                    </div>
                </div>
            </div>   
            @endif

            @if(isset($type[1]))
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">{{ ucfirst($type[1]) }}</h6>
                            <h4 class="text-right"><i class="ti-money f-left"></i><span>{{ ucfirst($value[1]) }} Ar</span></h4><br>
                            <p class="m-b-0">Nombre cette année :<span class="f-right">{{ $data[1] }}</span></p>
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($type[2]))
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">{{ ucfirst($type[2]) }}</h6>
                            <h4 class="text-right"><i class="ti-money f-left"></i><span>{{ ucfirst($value[2]) }} Ar</span></h4><br>
                            <p class="m-b-0">Nombre cette année :<span class="f-right">{{ $data[2] }}</span></p>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($type[3]))
                <div class="col-md-6 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">{{ ucfirst($type[3]) }}</h6>
                        <h4 class="text-right"><i class="ti-money f-left"></i><span>{{ ucfirst($value[3]) }} Ar</span></h4><br>
                        <p class="m-b-0">Nombre cette année :<span class="f-right">{{ $data[3] }}</span></p>
                    </div>
                </div>
            </div> 
            @endif

            @if(isset($type[4]))
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">{{ ucfirst($type[4]) }}</h6>
                            <h4 class="text-right"><i class="ti-money f-left"></i><span>{{ ucfirst($value[4]) }} Ar</span></h4><br>
                            <p class="m-b-0">Nombre cette année :<span class="f-right">{{ $data[4] }}</span></p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($grand_total[0])
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">TOTAL :</h6>
                            <h4 class="text-right"><i class="ti-money f-left"></i><span>{{ ucfirst($grand_total[0]) }} Ar</span></h4><br>
                            <p class="m-b-0">C'est le total cette année<span class="f-right"></span></p>
                        </div>
                    </div>
                </div>    
            @endif  

    
{{-- 
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-right">                                                             <i class="icofont icofont-spinner-alt-5"></i>                                                         </div>
                    </div>
                    <div class="card-block" >
                    <canvas id="myChart" height="120"></canvas>
                    </div>
                </div>
            </div> --}}
        
@endsection

@section('script')
<script type="text/javascript">
  
      var labels =  {{ Js::from($labels) }};
      var users =  {{ Js::from($data) }};
  
      const data = {
        labels: labels,
        datasets: [{
          label: 'quittance',
          backgroundColor: 'white',
          borderColor: 'rgb(255, 99, 132)',
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


