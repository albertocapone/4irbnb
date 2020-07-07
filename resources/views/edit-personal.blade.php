@extends('layouts.layout-base')
@section('content')
  <form id="houseEdit">
    @csrf
    <div class="">
      <label for="title">Titolo</label>
      <input type="text" name="title" value="{{old('title',$house['title'])}}">
    </div>
    <div class="">
      <label for="description">Descizione</label>
      <input type="text" name="description" value="{{old('description',$house['description'])}}">
    </div>
    <div class="">
      <label for="rooms">Stanze</label>
      <input type="text" name="rooms" value="{{old('rooms',$house['rooms'])}}">
    </div>
    <div class="">
      <label for="beds">Letti</label>
      <input type="text" name="beds" value="{{old('beds',$house['beds'])}}">
    </div>
    <div class="">
      <label for="bathrooms">Bagni</label>
      <input type="text" name="bathrooms" value="{{old('bathrooms',$house['bathrooms'])}}">
    </div>
    <div class="">
      <label for="sqm">Metri🟪</label>
      <input type="text" name="sqm" value="{{old('sqm',$house['sqm'])}}">
    </div>
    <div class="">
      <label for="address">Indirizzo</label>
      <input type="search" id="address-input" value="{{old('address',$house['address'])}}"  />
    </div>
    <div class="">
      <label for="img_url">Immagine</label>
      <input type="file" name="img_url" value="{{old('img_url',$house['img_url'])}}">
    </div>
    <div class="">
      <label for="services[]">Servizi</label><br>
      @foreach ($services as $dbservice)
        <input type="checkbox" name="services[]" value="{{$dbservice->id}}"
        @foreach ($house -> services as $service)
            @if($service -> id == $dbservice -> id)
              checked
            @endif
        @endforeach>
        {{$dbservice->name}}
      @endforeach
    </div>
    <input id='bottone'type="submit" name="" value="SUBMITTA">

  <script type="text/javascript">
    var pathname = window.location.pathname
    var id = pathname.slice(15)
    console.log(id);
    var placesAutocomplete = places({
      appId: 'plPUBO3OQ2IL',
      apiKey: 'dda3705a9ef3646ee382a746f2868aec',
      container: document.querySelector('#address-input'),
    });

    var query;

    placesAutocomplete.on('change', e => query = e.suggestion);
    console.log(query);
    $("#houseEdit").submit(function () {
        var services = [];
        $(':checkbox:checked').each(function(i){
        services[i] = $(this).val();
        });
        console.log('ei');
        var data = {
          'title': $('input[name="title"]').val(),
          'description': $('input[name="description"]').val(),
          'rooms': $('input[name="rooms"]').val(),
          'beds': $('input[name="beds"]').val(),
          'bathrooms': $('input[name="bathrooms"]').val(),
          'sqm': $('input[name="sqm"]').val(),
          'address':query.name,
          'lat':query.latlng.lat,
          'long':query.latlng.lng,
          'img_url': $('input[name="img_url"]').val(),
          'services': services,
        };
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:'/update-personal'+ id,
          method: "POST",
          data: data,
          success: function(res) {
            console.log(res);
          window.location.replace("http://localhost:8000");
          },
          error: function(err){
            console.log(err)
          }
        });
      });

  </script>
  </form>
@endsection
