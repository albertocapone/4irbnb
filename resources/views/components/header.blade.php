
<nav class="flex">
  <div id="logo">
    {{-- <img src="{{(asset('sass/img/logo.png'))}}" alt="logo airbnb"> --}}
    <i class="fab fa-airbnb"></i>
  </div>


  <div class="flex rightheader">

    <div class="">
      <i class="fas fa-globe"></i>
      <i class="fas fa-chevron-down"></i>
    </div>

    @if (Route::has('login'))

            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth

    @endif



  </div>


</nav>
