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

    </body>
</html>
{{-- qua ricerca appartamento + log in o registrazione --}}
