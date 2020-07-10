
<nav class="flex">
  <div id="logo">
    {{-- <img src="{{(asset('sass/img/logo.png'))}}" alt="logo airbnb"> --}}
    <a href="{{route ('welcome')}}"><i class="fab fa-airbnb"></i></a>
  </div>


  <div class="flex rightheader">

    {{-- <div class="">
      <i class="fas fa-globe"></i>
      <i class="fas fa-chevron-down"></i>
    </div> --}}

    @if (Route::has('login'))

      @auth
          <a href="{{ url('/home') }}">Home</a>

          <span><a class="dropdown">{{ Auth::user()->name }} </a>

            <div class="dropcontent">

              <div><a href="{{route('house-create')}}" >Diventa host</a></div>
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
          <a href="{{ route('login') }}">Login</a>

          @if (Route::has('register'))
              <a href="{{ route('register') }}">Register</a>
          @endif
      @endauth

    @endif

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif --}}
    @else
        {{-- <li class="nav-item dropdown"> --}}
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <a href="{{route('house-create')}}">Metti cosa posto dormire</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        {{-- </li> --}}
    @endguest


  </div>


</nav>



{{-- <script>
    $('.dropdown').click(function() {
      $('div.dropcontent').fadeToggle();
    });
</script> --}}
