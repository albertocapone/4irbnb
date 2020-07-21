

  @extends('layouts.layout-base')

  @section('content')

    <div class="fullwidth">
      <main>

        <div class="blulogo">
          <h1>AirBnBool</h1>
        </div>

        <form id="houseCreation" >
          @csrf
          <div class="flex-two">
            <input type="search" id="address-input" placeholder="Dove?" class="hide-clear" />
            <input id='bottone' type="submit" name="" value="CERCA">
          </div>

{{---------------------------------- SCRIPT ----------------------------------}}

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
                    var data = {
                      'address':query.value,
                      'lat':query.latlng.lat,
                      'lng':query.latlng.lng,
                    };
                    data = $.param(data);
                    window.location.replace(window.location.origin + "/houses-index/?" + data);
                  });
        </script>
{{----------------------------------- END ------------------------------------}}


        </form>
      </main>
    </div>

  @endsection
