@extends('layouts.layout-base')

@section('content')

  <div class="fullwidthcreate">

    <main>

      <form class="flex" id="houseCreation" enctype="multipart/form-data">
        @csrf
        <div class="h5">
          <h5>Crea il tuo appartamento</h5>
        </div>
        <div class="padding">

          <div class="label">
              <label for="title">Titolo</label>
          </div>
          <div>
              <input class="title" type="text" name="title" value="" data-parsley-trigger="focusout" required autofocus>
          </div>
          <div class="label">
            <label for="description">Descrizione</label>
          </div>
          <div>
            <textarea class="description" type="text" name="description" value="" data-parsley-trigger="focusout" required></textarea>
          </div>

          <div class="numbers">
            <div>
              <label for="rooms">Stanze</label><br>
              <input type="number" name="rooms" value="" data-parsley-trigger="focusout" required min="1" max="10">
            </div>
            <div>
              <label for="beds">Letti</label><br>
              <input type="number" name="beds" value="" data-parsley-trigger="focusout" required min="1" max="20">
            </div>
            <div class="bagno">
              <label for="bathrooms">Bagni</label><br>

              <input type="number" name="bathrooms" value="" data-parsley-trigger="focusout" required min="1" max="10">
            </div>
          </div>
          <div class="divsmq">
            <label for="sqm">M<sup>2</sup></label>
          </div>
          <div>
            <input class="sqm" type="number" name="sqm" value="" data-parsley-trigger="focusout" min="5" max="500" required>
          </div>
          <div class="label">
            <label for="address">Indirizzo</label>
          </div>
          <div class="address">
            <input type="search" id="address-input" value="" data-parsley-trigger="focusout" data-parsley-address required class="hide-clear"/>
          </div>
          <div class="label">
            <label for="house_img">Immagine</label>
          </div>
          <div class="img">
            <input type="file" name="house_img" id="house_img" value="" accept="image/png, image/jpeg, image/gif, image/jpg" data-parsley-trigger="input" data-parsley-imagecheck="jpeg,png,gif,jpg" required>
          </div>

          <div class="services">
            <label for="services[]">Servizi</label><br>
            @foreach ($services as $service)
              <input type="checkbox" name="services[]" value="{{$service->id}}"
              @if($service->id == 1)
                required
              @endif
              >

              @if($service->name == 'Wifi')
                  <i class="fas fa-wifi" title="Wifi"></i>
              @endif
              @if($service->name == 'Parking')
                  <i class="fas fa-parking" title="Parcheggio"></i>
              @endif
              @if($service->name == 'Pool')
                  <i class="fas fa-swimming-pool" title="Piscina"></i>
              @endif
              @if($service->name == 'Concierge')
                  <i class="fas fa-concierge-bell" title="Portinaio"></i>
              @endif
              @if($service->name == 'Sauna')
                  <i class="fas fa-hot-tub" title="Sauna"></i>
              @endif
              @if($service->name == 'Seaview')
                  <i class="fas fa-water" title="Vista Mare"></i>
              @endif
            @endforeach
          </div>
        </div>


        <input class="button" id='bottone' type="submit" name="" value="CREA APPARTAMENTO">
      </form>
    </main>
  </div>



{{---------------------------------- SCRIPT ----------------------------------}}



  <script type="text/javascript">
  window.ParsleyValidator.addValidator('imagecheck', function (value, requirement) {
        var file = $('#house_img').prop("files")[0];
            requirement = requirement.split(',');
            var fileExtension = (value.split('.').pop()).toLowerCase();
            for (var i = 0; i < requirement.length; i++) {
              if(fileExtension === requirement[i] && file.size <= 2103553) {
              return true;
              }
            }
            return false;
        }, 32)
        .addMessage('en', 'imagecheck', 'File must be an image (max 2048 KB)');

        window.ParsleyValidator.addValidator('address', function (value) {
          if(query && query.value == value){
            return true;
          } else {
            return false;
          }
        }, 32)
        .addMessage('en', 'address', 'Please, enter a valid address');

  $("#houseCreation").parsley(); //parsley form binding

    var placesAutocomplete = places({
      appId: 'plPUBO3OQ2IL',
      apiKey: 'dda3705a9ef3646ee382a746f2868aec',
      container: document.querySelector('#address-input'),
    });

    var query;

    placesAutocomplete.on('change', e => query = e.suggestion);

    $("#houseCreation").submit(function (event) {
      
        $(this).find(':submit').attr( 'disabled','disabled' );
        event.preventDefault();

        var services = [];
        $(':checkbox:checked').each(function(i){
        services[i] = $(this).val();
        console.log(services[i]);
        });

        var data = new FormData();
        data.append("title", $('input[name="title"]').val());
        data.append("description", $('textarea[name="description"]').val());
        data.append("rooms", $('input[name="rooms"]').val());
        data.append("beds", $('input[name="beds"]').val());
        data.append("bathrooms", $('input[name="bathrooms"]').val());
        data.append("sqm", $('input[name="sqm"]').val());
        data.append("address", query.value);
        data.append("lat", query.latlng.lat);
        data.append("long", query.latlng.lng);
        data.append("house_img", $('#house_img').prop("files")[0]);
        data.append("services", services);

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
          window.location.assign(window.location.origin + "/home");
          },
          error: function(a, b, c){
            console.log(a, b, c)
          }
        });
      });
  </script>
@endsection
