@extends('layouts.layout-base')

@section('content')
<div>
    <h2>MESSAGGI</h2>
    <h3>{{count($lastMonthMessages)}}</h3>
</div>
<div>
    <h2>VIEWS</h2>
    <h3>{{count($lastMonthViews)}}</h3>
</div>
<form>
<input type="month" name="" data-house="{{$house->id}}" id="getStatsByDate">
    <button>Search</button>
</form>

<script>
    $('button').click(function(event){
        event.preventDefault();
        var query = {
            date: $('#getStatsByDate').val(),
            house_id: $('#getStatsByDate').data('house')
        };
        console.log(query)
        query = $.param(query);
        $.get('/get-stats/', query, function(data){
            console.log(data);
        });
    });
</script>
@endsection