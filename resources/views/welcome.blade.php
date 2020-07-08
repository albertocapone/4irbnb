<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
        {{-- <script type="text/javascript" src=" {{asset('js/app.js') }}"> </script> --}}
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
        <div id='app'>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <form id="houseCreation">
          @csrf
          <div class="">
            <label for="address">Indirizzo</label>
            <input type="search" id="address-input" placeholder="Casa dove dimmi dai su" />
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

              var data = {
                'value':query.value,
                'lat':query.latlng.lat,
                'long':query.latlng.lng,
              };
              data=JSON.stringify(data);
              window.location.assign("http://localhost:8000/houses-index/" + data);

            });

        </script>
        </form>
      </body>
</html>
{{-- qua ricerca appartamento + log in o registrazione --}}
