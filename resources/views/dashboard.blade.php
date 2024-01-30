<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tableau de bord') }}
            </h2>
           
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {!! __("Bonjour $name<br> Vous êtes connecté !")  !!}
    </div>
    <div class="spacer">
        <p></p>
    </div>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="row">
            <div class="col-md-5 table-responsive">

                 <h6 class="text-center py-10"> <strong>Candidature par pays</strong> </h6>
                <table class="table table-hover table-striped " style="width:100%">
                <tbody class="bg-white divide-y divide-gray-200">
                
                @forelse(json_decode($bycountry) as $country)
                      @if(strpos($country->name, '(RDC)') !== false)
                        @php($class='d-none')
                      @else
                        @php($class='')
                      @endif
                  <tr class="{{$class}}">
                    <td>{{ $country->name }}</td>
                    <td>
                    @php($cand = \App\Models\Candidature::where('pays_id',$country->id)->pluck('pays_id')->count())
                    {{$cand}}
                      
                    </td>
                  </tr>
                @empty
                  <tr> <td>Aucun enregistrement</td> </tr>
                @endforelse
                </tbody>
                </table>
              
           
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">
              <!--  <h6 class="text-center py-10"> <strong>Graph par pays</strong> </h6>
               <canvas id="canvas" height="360" width="600"></canvas> -->
            </div>
        </div>
       
    </div>
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var pays = <?php   echo $pays; ?>;
    var user = <?php echo $user; ?>;
    var barChartData = {
        labels: pays,
        datasets: [{
            label: 'Nombre de candidatures',
            backgroundColor: "#91df84",
            data: user
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: ''
                }
            }
        });
    };
</script> -->
</x-app-layout>
