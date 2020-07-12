@extends('layouts.layout-base')
@section('content')
  <form id="houseEdit" enctype="multipart/form-data" data-parsley-validate>
    @csrf
    <div class="">
      <label for="title">Titolo</label>
      <input type="text" name="title" value="{{old('title',$house['title'])}}" data-parsley-trigger="focusout" required>
    </div>
    <div class="">
      <label for="description">Descizione</label>
      <input type="text" name="description" value="{{old('description',$house['description'])}}" data-parsley-trigger="focusout" required>
    </div>
    <div class="">
      <label for="rooms">Stanze</label>
      <input type="number" name="rooms" value="{{old('rooms',$house['rooms'])}}" data-parsley-trigger="focusout" required min="1" max="10">
    </div>
    <div class="">
      <label for="beds">Letti</label>
      <input type="number" name="beds" value="{{old('beds',$house['beds'])}}" data-parsley-trigger="focusout" required min="1" max="20">
    </div>
    <div class="">
      <label for="bathrooms">Bagni</label>
      <input type="number" name="bathrooms" value="{{old('bathrooms',$house['bathrooms'])}}" data-parsley-trigger="focusout" required min="1" max="10">
    </div>
    <div class="">
      <label for="sqm">Metri🟪</label>
      <input type="number" name="sqm" value="{{old('sqm',$house['sqm'])}}" data-parsley-trigger="focusout" min="5">
    </div>
    <div class="">
      <label for="address">Indirizzo</label>
      <input type="search" id="address-input" value="{{old('address',$house['address'])}}" data-parsley-trigger="focusout" required/>
    </div>
    <div class="">
      <label for="house_img">Immagine</label>
      <input type="file" name="house_img" id="house_img" value="{{old('house_img',$house['house_img'])}}" data-lat="{{$house['lat']}}" data-lng="{{$house['lng']}}" data-parsley-trigger="focusout" required>
    </div>
    <div class="">
      <label for="services[]">Servizi</label><br>
      @foreach ($services as $dbservice)
        <input type="checkbox" name="services[]" value="{{$dbservice->id}}"
        @if($dbservice->id == 1)
          required
        @endif
        @foreach ($house->services as $service)
            @if($service->id == $dbservice->id)
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
    var placesAutocomplete = places({
      appId: 'plPUBO3OQ2IL',
      apiKey: 'dda3705a9ef3646ee382a746f2868aec',
      container: document.querySelector('#address-input'),
    });

    var query;
    placesAutocomplete.on('change', e => query = e.suggestion);

    $("#houseEdit").submit(function (event) {
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
        data.append("address", (query)? query.value : $('#address-input').val());
        data.append("lat", (query)? query.latlng.lat : $('#address-input').data('lat'));
        data.append("long", (query)? query.latlng.lng : $('#address-input').data('lng'));
        data.append("house_img", $('#house_img').prop("files")[0]);
        data.append("services", services);
 
        $.ajax({ 
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:'/update-personal/'+ id,
          method: "POST",
          data: data,
          processData: false,
          contentType: false,
          success: function(res) {
          console.log(res)
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

