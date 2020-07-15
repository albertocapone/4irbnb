@extends('layouts.layout-base')

@section('content')

<div class="fullwidthcreate">
  <main style="display: flex">
    <div id="messages" style="width: 500px">
        <h2>MESSAGGI TOTALI</h2>
        <h3>{{$allMessages}}</h3>
        <canvas id="messagesPerMonth"></canvas>
    </div>
    <div id="views" style="width: 500px">
        <h2>VIEWS TOTALI</h2>
        <h3>{{$allViews}}</h3>
        <canvas id="viewsPerMonth"></canvas>
    </div>
    <form>
    <input type="number" id="getStatsByDate" data-house="{{$house->id}}" min="1900" max="2099" step="1" value="2020" />
        <button>Search</button>
    </form>
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
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Views per month in ' + query.date,
                        backgroundColor: 'rgb(255, 0, 0)',
                        borderColor: 'rgb(0, 255, 0)',
                        data: data.viewsPerMonth
                    }]
                },

                // Configuration options go here
                options: {}
            });
            console.log(chart.data.data)

            var ctx = document.getElementById('messagesPerMonth').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Messages per month in ' + query.date,
                        backgroundColor: 'rgb(0, 0, 255)',
                        borderColor: 'rgb(0, 255, 0)',
                        data: data.messagesPerMonth
                    }]
                },

                // Configuration options go here
                options: {}
            });


        });
    });
</script>
@endsection
