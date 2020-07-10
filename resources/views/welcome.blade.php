<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
        {{-- <script type="text/javascript" src=" {{asset('js/app.js') }}"> </script> --}}
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Airbnb</title>
    </head>
    <body>
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
                  <input type="search" id="address-input" placeholder="Dove?" />
                  <input id='bottone' type="submit" name="" value="CERCA">
                </div>
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
                      'value':query.value,
                      'lat':query.latlng.lat,
                      'long':query.latlng.lng,
                    };
                    data=JSON.stringify(data);
                    window.location.replace("http://localhost:8000/houses-index/" + data);

                  });

              </script>
              </form>
            </main>
          </div>

          @endsection

      </body>
</html>
{{-- qua ricerca appartamento + log in o registrazione --}}
