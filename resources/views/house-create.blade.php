@extends('layouts.layout-base')
@section('content')
  <form class="" action="{{route('house-store')}}" method="POST">
    @csrf
    @method('POST')
    <div class="">
      <label for="title">Titolo</label>
      <input type="text" name="title" value="">
    </div>
    <div class="">
      <label for="description">Descizione</label>
      <input type="text" name="description" value="">
    </div>
    <div class="">
      <label for="rooms">Stanze</label>
      <input type="text" name="rooms" value="">
    </div>
    <div class="">
      <label for="beds">Letti</label>
      <input type="text" name="beds" value="">
    </div>
    <div class="">
      <label for="bathrooms">Bagni</label>
      <input type="text" name="bathrooms" value="">
    </div>
    <div class="">
      <label for="sqm">Metri🟪</label>
      <input type="text" name="sqm" value="">
    </div>
    <div class="">
      <label for="address">Indirizzo</label>
      <input type="search" id="address-input" placeholder="Casa dove dimmi dai su" />
    </div>
    <div class="">
      <label for="img_url">Immagine</label>
      <input type="text" name="img_url" value="">
    </div>
    <div class="">
      <label for="services[]">Servizi</label>
      @foreach ($services as $service)
        <input type="checkbox" name="services[]" value="{{$service->id}}">
        {{$service->name}}
      @endforeach
    </div>
    <input id='bottone'type="submit" name="" value="SUBMITTA">
  </form>
  <script type="text/javascript">
  // var places = require('places.js');
  var placesAutocomplete = places({
    appId: 'plPUBO3OQ2IL',
    apiKey: 'dda3705a9ef3646ee382a746f2868aec',
    container: document.querySelector('#address-input'),
  });
  var query;
  placesAutocomplete.on('change', e => query = e.suggestion);

  // console.log(query);
  $("#bottone").click(function () {
      var data = {
        'lat':query.latlng.lat,
        'lng':query.latlng.lng,
        'address':query.name
      };
      console.log(data);
      $.ajax({
        headers: {'X-CSRF-Token': '{{ csrf_token() }}'},
        url:'/house-store',
        method:'POST',
        data:data,
        success:function (data) {
            console.log(data);
        },
        error:function (error) {
          console.error(error);
        }
      })
  })
  </script>
@endsection
