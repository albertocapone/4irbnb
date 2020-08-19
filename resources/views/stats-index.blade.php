@extends('layouts.layout-base')

@section('content')

  <div class="fullwidthstats">
    <main>
      <div class="charts">
        <form>
          <input type="number" id="getStatsByDate" data-house="{{$house->id}}" min="1900" max="2099" step="1" value="2020" />
          <button class="button">CERCA</button>
        </form>
        <div class="canvas">
          <div id="messages">
              <h5>MESSAGGI</h5>
              <h6>Totali: <b>{{$allMessages}}</b>
                <span style="margin-left: 25px" id="msgsInYear"></span>
              </h6>
              <div class="chart">
                <canvas id="messagesPerMonth" ></canvas>
              </div>
          </div>
          <div id="views">
              <h5>VISUALIZZAZIONI</h5>
              <h6>Totali: <b>{{$allViews}}</b>
                <span style="margin-left: 25px" id="vwsInYear"></span>
              </h6>
              <div class="chart">
                <canvas id="viewsPerMonth" ></canvas>
              </div>
          </div>
        </div>
      </div>
    </main>
  </div>


{{---------------------------------- SCRIPT ----------------------------------}}
<script>
      var viewsCtx = document.getElementById('viewsPerMonth').getContext('2d');
      var viewsChart = new Chart(viewsCtx, {
          // The type of chart we want to create
          type: 'line',
          // The data for our dataset
          data: {
              labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
              datasets: [{
                  label: "Visualizzazioni",
                  backgroundColor: 'rgb(2, 108, 181)',
                  borderColor: 'rgb(215, 188, 106)',
                  data: null
              }]
          },

          // Configuration options go here
          options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }]
            }
        }
      });

      var msgsCtx = document.getElementById('messagesPerMonth').getContext('2d');
            var msgsChart = new Chart(msgsCtx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                    datasets: [{
                        label: "Messaggi",
                        backgroundColor: 'rgb(168, 32, 78)',
                        borderColor: 'rgb(215, 188, 106)',
                        data: null
                    }]
                },

                // Configuration options go here
               options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: true,
                              stepSize: 1
                          }
                      }]
                  }
              }
            });


    $('button').click(function(event){
        event.preventDefault();
        var query = {
            date: $('#getStatsByDate').val(),
            house_id: $('#getStatsByDate').data('house')
        };
        $.get('/get-stats/', query, function(stats){
            var stats = JSON.parse(stats);
            viewsChart.data.datasets.forEach((dataset) => {
            dataset.label = 'Visualizzazioni (' + query.date + ')';
            dataset.data = stats.viewsPerMonth;
            });
            viewsChart.update();
            $('#vwsInYear').html("Nel " + query.date + ": <b>" + stats.viewsPerMonth.reduce((a, b) => a + b, 0) + "</b>");

            
            msgsChart.data.datasets.forEach((dataset) => {
            dataset.label = 'Messaggi (' + query.date + ')';
            dataset.data = stats.messagesPerMonth;
            });
            msgsChart.update();
            $('#msgsInYear').html("Nel " + query.date + ": <b>" + stats.messagesPerMonth.reduce((a, b) => a + b, 0) + "</b>");
          });
        });

</script>
@endsection
