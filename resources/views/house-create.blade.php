@extends('layouts.layout-base')
@section('content')
  <form id="houseCreation" enctype="multipart/form-data">
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
      <label for="house_img">Immagine</label>
      <input type="file" id="houseImg" name="house_img" value="">
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
        
        var data = new FormData();
        data.append("title", $('input[name="title"]').val());
        data.append("description", $('input[name="description"]').val());
        data.append("rooms", $('input[name="rooms"]').val());
        data.append("beds", $('input[name="beds"]').val());
        data.append("bathrooms", $('input[name="bathrooms"]').val());
        data.append("sqm", $('input[name="sqm"]').val());
        data.append("address", query.value);
        data.append("lat", query.latlng.lat);
        data.append("long", query.latlng.lng);
        data.append("house_img", document.getElementById('houseImg').files[0]);
        data.append("services", services);
        
        // var data = {
        //   'title': $('input[name="title"]').val(),
        //   'description': $('input[name="description"]').val(),
        //   'rooms': $('input[name="rooms"]').val(),
        //   'beds': $('input[name="beds"]').val(),
        //   'bathrooms': $('input[name="bathrooms"]').val(),
        //   'sqm': $('input[name="sqm"]').val(),
        //   'address':query.value,
        //   'lat':query.latlng.lat,
        //   'long':query.latlng.lng,
        //   'house_img': $('input[name="house_img"]').val(),
        //   'services': services,
        // };
        // console.log(data)

        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/house-store',
          method: "POST",
          data: data,
          processData: false,
          contentType: false,
          success: function(res) {
          console.log(res);
          window.location.assign("http://localhost:8000");
          },
          error: function(a, b, c){
            console.log(a, b, c)
          }
        });
      });

  </script>
  </form>
@endsection
