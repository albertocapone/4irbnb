@extends('layouts.layout-base')
@section('content')

  <div class="fullwidthcreate">
    <main>

      <form class="flex" id="houseEdit" enctype="multipart/form-data">
        @csrf

        <div class="h5">
          <h5>Modifica il tuo appartamento</h5>
        </div>

        <div class="padding">

          <div class="label">
            <label for="title">Titolo</label>
          </div>
          <div>
            <input class="title" type="text" name="title" value="{{old('title',$house['title'])}}" data-parsley-trigger="focusout" required>
          </div>
          <div class="label">
            <label for="description">Descrizione</label>
          </div>
          <div >
          <textarea class="description" name="description" data-parsley-trigger="focusout" required>{{ old('description', $house['description']) }}</textarea>
          </div>

          <div class="numbers">
            <div class="">
              <label for="rooms">Stanze</label><br>
              <input type="number" name="rooms" value="{{old('rooms',$house['rooms'])}}" data-parsley-trigger="focusout" required min="1" max="10">
            </div>
            <div class="">
              <label for="beds">Letti</label><br>
              <input type="number" name="beds" value="{{old('beds',$house['beds'])}}" data-parsley-trigger="focusout" required min="1" max="20">
            </div>
            <div class="bagno">
              <label for="bathrooms">Bagni</label><br>
              <input type="number" name="bathrooms" value="{{old('bathrooms',$house['bathrooms'])}}" data-parsley-trigger="focusout" required min="1" max="10">
            </div>
          </div>
          <div class="divsmq">
            <label for="sqm">M<sup>2</sup></label>
          </div>
          <div>
            <input class="sqm" type="number" name="sqm" value="{{old('sqm',$house['sqm'])}}" data-parsley-trigger="focusout" min="5" required>
          </div>

          <div class="label">
            <label for="address">Indirizzo</label>
          </div>
          <div class="address">
            <input type="search" id="address-input" data-lat="{{$house['lat']}}" data-lng="{{$house['lng']}}" value="{{old('address',$house['address'])}}" data-parsley-trigger="focusout" required class="hide-clear"/>
          </div>
          <div class="label">
            <label for="house_img">Immagine (modifica o mantieni)</label>
          </div>
          <div class="img">
            <input type="file" name="house_img" id="house_img" data-parsley-trigger="focusout">
            <div id="old_img">
              <img  src="{{$house['house_img']}}" alt="">
              <h5 style="display: inline-block; vertical-align: bottom; font-size: 9px; color: #6cb2eb;">Immagine attuale</h5>
            </div>
          </div>

          <div class="services">
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

              @if($dbservice->name == 'Wifi')
                  <i class="fas fa-wifi" title="Wifi"></i>
              @endif
              @if($dbservice->name == 'Parking')
                  <i class="fas fa-parking" title="Parcheggio"></i>
              @endif
              @if($dbservice->name == 'Pool')
                  <i class="fas fa-swimming-pool" title="Piscina"></i>
              @endif
              @if($dbservice->name == 'Concierge')
                  <i class="fas fa-concierge-bell" title="Portinaio"></i>
              @endif
              @if($dbservice->name == 'Sauna')
                  <i class="fas fa-hot-tub" title="Sauna"></i>
              @endif
              @if($dbservice->name == 'Seaview')
                  <i class="fas fa-water" title="Vista Mare"></i>
              @endif
            @endforeach
          </div>
        </div>
        <input class="button" id='bottone'type="submit" name="" value="MODIFICA APPARTAMENTO">
      </form>

    </main>
  </div>


{{---------------------------------- SCRIPT ----------------------------------}}


  <script type="text/javascript">

    $("#houseEdit").parsley(); //parsley form binding

    var pathname = window.location.pathname
    var id = pathname.slice(15)
    var placesAutocomplete = places({
      appId: 'plPUBO3OQ2IL',
      apiKey: 'dda3705a9ef3646ee382a746f2868aec',
      container: document.querySelector('#address-input'),
    });

    var query;
    placesAutocomplete.on('change', e => query = e.suggestion);

    var imgFile;
    $('input[type="file"]').change(function (e) {
      imgFile = $('#house_img').prop("files")[0];
    });

    $("#houseEdit").submit(function (event) {
      $(this).find(':submit').attr( 'disabled','disabled' );
      event.preventDefault();

        var services = [];
        $(':checkbox:checked').each(function(i){
        services[i] = $(this).val();
        });

        var data = new FormData();
        data.append("title", $('input[name="title"]').val());
        data.append("description", $('textarea[name="description"]').val());
        data.append("rooms", $('input[name="rooms"]').val());
        data.append("beds", $('input[name="beds"]').val());
        data.append("bathrooms", $('input[name="bathrooms"]').val());
        data.append("sqm", $('input[name="sqm"]').val());
        data.append("address", (query)? query.value : $('#address-input').val());
        data.append("lat", (query)? query.latlng.lat : $('#address-input').data('lat'));
        data.append("long", (query)? query.latlng.lng : $('#address-input').data('lng'));
        data.append("services", services);
        if (imgFile) {
          data.append("house_img", imgFile);
        }

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
          window.location.assign(window.location.origin + "/home");
          },
          error: function(err){
            console.log(err)
          }
        });
    });

  </script>
@endsection
