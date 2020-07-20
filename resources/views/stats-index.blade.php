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
            <h6>Totali: <b>{{$allMessages}}</b></h6>
            <div class="chart">
              <canvas id="messagesPerMonth" ></canvas>
            </div>
        </div>
        <div id="views">
            <h5>VISUALIZZAZIONI</h5>
            <h6>Totali: <b>{{$allViews}}</b></h6>
            <div class="chart">
              <canvas id="viewsPerMonth" ></canvas>
            </div>
        </div>
      </div>
    </div>
  </main>
</div>
<script>
    $('button').click(function(event){
        event.preventDefault();
        var query = {
            date: $('#getStatsByDate').val(),
            house_id: $('#getStatsByDate').data('house')
        };
        $.get('/get-stats/', query, function(data){
            var data = JSON.parse(data);

            var ctx = document.getElementById('viewsPerMonth').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Views per month in ' + query.date,
                        backgroundColor: 'rgb(2, 108, 181)',
                        borderColor: 'rgb(215, 188, 106)',
                        data: data.viewsPerMonth
                    }]
                },

                // Configuration options go here
                options: {
                }
            });
            console.log(chart.data.data)

            var ctx = document.getElementById('messagesPerMonth').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Messages per month in ' + query.date,
                        backgroundColor: 'rgb(168, 32, 78)',
                        borderColor: 'rgb(215, 188, 106)',
                        data: data.messagesPerMonth
                    }]
                },

                // Configuration options go here
                options: {
                }
            });


        });
    });

</script>
@endsection
