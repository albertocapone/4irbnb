
<nav class="flex">
  <div id="logo">
    {{-- <img src="{{(asset('sass/img/logo.png'))}}" alt="logo airbnb"> --}}
    <a href="{{route ('welcome')}}"> <i class="fab fa-airbnb"> </i></a>
  </div>


  <div class="flex rightheader">

    {{-- <div class="">
      <i class="fas fa-globe"></i>
      <i class="fas fa-chevron-down"></i>
    </div> --}}

    @if (Route::has('login'))

      @auth

          <a href="{{ url('/home') }}">Panoramica </a>

          @if ( Auth::user()->name)

            <span><a class="dropdown">{{ Auth::user()->name }} </a>

              <div class="dropcontent">

                <div><a href="{{route('house-create')}}" >Diventa Host</a></div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <div>
                  <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                </div>

              </div>
            </span>

          @else

            <span>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>

              <div>
                <a href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
              </div>
            </span>

        @endif

      @else
          <a href="{{ route('login') }}">Login</a>

          @if (Route::has('register'))
              <a href="{{ route('register') }}">Register</a>
          @endif

      @endauth

    @endif



  </div>


</nav>



{{-- <script>
    $('.dropdown').click(function() {
      $('div.dropcontent').fadeToggle();
    });
</script> --}}
