<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title></title>
  </head>
  <body >
    <div id='app'>
      <h1>Ciao</h1>
    </div>
    <div class="">
      @yield('content')
    </div>
    <div class="">
      <h3>Ariciao</h3>
    </div>
  </body>
</html>
