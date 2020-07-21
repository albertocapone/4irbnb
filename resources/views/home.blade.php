@extends('layouts.layout-sidebar')

@section('sidebar')
  @include('components.sidebar-home')
@endsection

@section('main-content')

    @if (count($houses) == 0)
      <div class="empy flex-container">
        <p>Non hai ancora aggiunto nessuna proprietà.</p>
        <p>Crea il tuo appartamento e diventa subito host</p>
        <a href="{{route('house-create')}}">Diventa Host</a>
      </div>
    @else
      <div class="houses-preview-container flex-container">
        <h4 class="page-home-title">
          Le tue proprietà
        </h4>
        @foreach ($houses as $house)
          <div class="house-preview {{($house->visibility == 0) ? 'hidden' : 'visible'}} ">
            <div class="overlay"></div>{{-- / overlay --}}
            {{-- visibility tag --}}
            <div class="visibility-tag">
              <h5>Nascosto</h5>
            </div>
            {{-- / visibility tag --}}
            <div class="immagine">
              <img src="{{$house -> house_img}}" alt="">
            </div>
            <div class="title flex-container">
              <a href="{{route('show-personal', $house->id)}}">
                <h6>{{ ucfirst($house -> title) }}</h6>
              </a>
              <div class="services-container flex-container">
                @foreach ($house -> services as $service)
                  <span class="index-houses-preview-services">
                    {{-- {{$service->name}} --}}
                    @if($service->name == 'Wifi')
                      <i class="fas fa-wifi" title="Wifi"></i>
                    @endif
                    @if($service->name == 'Parking')
                      <i class="fas fa-parking" title="Parcheggio"></i>
                    @endif
                    @if($service->name == 'Pool')
                      <i class="fas fa-swimming-pool" title="Piscina"></i>
                    @endif
                    @if($service->name == 'Concierge')
                      <i class="fas fa-concierge-bell" title="Portinaio"></i>
                    @endif
                    @if($service->name == 'Sauna')
                      <i class="fas fa-hot-tub" title="Sauna"></i>
                    @endif
                    @if($service->name == 'Seaview')
                      <i class="fas fa-water" title="Vista Mare"></i>
                    @endif
                  </span>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    <script>
      if(!!window.performance && window.performance.navigation.type === 2)
        {
          window.location.reload(); //forza refresh se arrivi da back button
        }
    </script>

@endsection
