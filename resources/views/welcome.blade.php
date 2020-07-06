<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
        {{-- <script type="text/javascript" src=" {{asset('js/app.js') }}"> </script> --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
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
        <input type="search" id="address-input" placeholder="Where are we going?" />
        
       {{-- <form class="" action="{{route('index')}}" method="get">
          <div class="geoqualcosa">
            <label for="address">Address</label>
            <input id="address" type="text" name="address" value="">
            <label for="state">State</label>
            <input id='state' type="text" name="state" value="">
            <button id='button' type="button" name="button">Bottone</button>
          </div>
        </form> --}}
    </body>
</html>
