<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{asset('js/parsley.min.js')}}" ></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>AirBnBool</title>
    <script src="https://kit.fontawesome.com/f544440f57.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/parsley.css')}}">
    <link rel="icon" href="{{asset('assets/images/logo.png')}}">
  </head>

  <body >

    <div class="sidebarLayout">

    <header>
      @include('components.header')
    </header>

     {{-- **** SIDEBAR **** --}}
      <main class="flex-container">

        {{-- side full --}}
        <aside>
          <div class="side-container">
            <nav>
              <div class="close-hamburger">
                <i class="fa fa-times fa-2x"></i>
              </div>
              <ul>
                @yield('sidebar')
              </ul>
            </nav>
          </div>
        </aside>

        {{-- side menu --}}
        <div class="hamburger">
          <i class="fa fa-bars fa-2x"></i>
        </div>


        {{-- **** MAIN **** --}}
        <section>
          <div class="main-container">
            @yield('main-content')
          </div>
        </section>
      </main>

    <footer>
      @include('components.footer')
    </footer>

    <script type="text/javascript">
      $('.hamburger').click(function(){
        $('aside').slideToggle();
      });

      $('.close-hamburger').click(function(){
        $('aside').slideToggle();
      });
    </script>

  </div>

</body>

</html>
