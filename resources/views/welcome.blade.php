<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        {{-- <script type="text/javascript" src=" {{asset('js/app.js') }}"> </script> --}}
        <script src="js/main.js" charset="utf-8"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
        <div class=>
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
        {{-- <form class="" action="{{route('index')}}" method="get"> --}}
          <div class="geoqualcosa">
            <label for="address">Address</label>
            <input id="address" type="text" name="address" value="">
            <label for="state">State</label>
            <input id='state' type="text" name="state" value="">
            <button id='button' type="button" name="button">Bottone</button>
          </div>
        {{-- </form> --}}
    </body>
</html>
