@extends('layouts.layout-base')
@section('content')
  <form id="houseCreation">
    @csrf
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
      <label for="services[]">Servizi</label><br>
      @foreach ($services as $service)
        <input type="checkbox" name="services[]" value="{{$service->id}}">
        {{$service->name}}
      @endforeach
    </div>
    <input id='bottone'type="submit" name="" value="SUBMITTA">

  <script type="text/javascript">

    var placesAutocomplete = places({
      appId: 'plPUBO3OQ2IL',
      apiKey: 'dda3705a9ef3646ee382a746f2868aec',
      container: document.querySelector('#address-input'),
    });

    var query;

    placesAutocomplete.on('change', e => query = e.suggestion);
  
    $("#houseCreation").submit(function (event) {
        event.preventDefault();
        var services = [];
        $(':checkbox:checked').each(function(i){
        services[i] = $(this).val();
        });

        var data = {
          'title': $('input[name="title"]').val(),
          'description': $('input[name="description"]').val(),
          'rooms': $('input[name="rooms"]').val(),
          'beds': $('input[name="beds"]').val(),
          'bathrooms': $('input[name="bathrooms"]').val(),
          'sqm': $('input[name="sqm"]').val(),
          'address':query.value,
          'lat':query.latlng.lat,
          'long':query.latlng.lng,
          'img_url': $('input[name="img_url"]').val(),
          'services': services,
        };

        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/house-store',
          method: "POST",
          data: data,
          success: function(res) {
          console.log(res);
          window.location.assign("http://localhost:8000");
          },
          error: function(err){
            console.log(err)
          }
        });
      });

  </script>
  </form>
@endsection
