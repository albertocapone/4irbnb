
@extends('layouts.layout-sidebar')

@section('sidebar')
  <div class="sidebar-index-filters">
    <h5>Filtra la tua ricerca</h5>
    <div>
      <label for="radius">Numero di stanze</label>
       <input type="number" name="rooms" min="1" max="10" value="{{$roomsInputValue}}">
    </div>
     <div>
       <label for="radius">Posti letto</label>
       <input type="number" name="beds" min="1" max="20" value="{{$bedsInputValue}}">
    </div>
     <div>
       <label for="radius">Distanza</label>
       <input type="range" data-address="{{$address}}" data-lat="{{$lat}}" data-lng="{{$lng}}" name="radius" min="1" max="30" value="{{$radius}}" step="1">
       <input type="number" id="showRange" value="{{$radius}}" readonly="readonly">
       <span>Km</span>
    </div>
     <div>
      <label for="services">Servizi</label>
      @foreach ($servicesList as $service)
          <input type="checkbox" name="{{$service->id}}"
           @foreach ($servicesFilter as $serviceFilter)
            @if($service->id == $serviceFilter)
              checked
            @endif
        @endforeach
          >{{$service -> name}}
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


          <br>
      @endforeach
    </div>
    <div class="bottoni flex-container">
      <button id="filter">Filtra</button>
      <button id="reset">Reset</button>
    </div>
  </div>
@endsection

@section('main-content')

  <h4 class="page-index-title">
    Ecco le proprietà presso {{$address}}
  </h4>

  @if(count($promoHouses))                         {{-- inizio case sponsorizzate  --}}
  <h5>Le nostre sponsorizzazioni</h5>
  <div class="houses-preview-container flex-container sponsorizzate">
    @foreach ($promoHouses as $promoHouse)
      <div class="house-preview" data-rooms="{{$promoHouse->rooms}}" data-beds="{{$promoHouse->beds}}" data-lat="{{$promoHouse->lat}}" data-lng="{{$promoHouse->lng}}"
        data-services="@foreach($promoHouse->services as $service){{$service->id}};@endforeach">
        <div class="immagine">
          <img src="{{$promoHouse -> house_img}}" alt="">
        </div>
        <div class="title flex-container">
          <a href="{{route('show-house', $promoHouse->id)}}">
            <div class="name-and-owner flex-container">
              <h6>{{ ucfirst($promoHouse -> title) }}</h6>
            </div>
          </a>
          <div class="services-container flex-container">
            @foreach ($promoHouse -> services as $service)
              <span class="index-houses-preview-services">

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
  @endif {{-- fine case sponsorizzate  --}}

  <div class="houses-preview-container flex-container">
    @foreach ($houses as $house)
      <div class="house-preview" data-rooms="{{$house->rooms}}" data-beds="{{$house->beds}}" data-lat="{{$house->lat}}" data-lng="{{$house->lng}}"
        data-services="@foreach($house->services as $service){{$service->id}};@endforeach">
        <div class="immagine">
          <img src="{{$house -> house_img}}" alt="">
        </div>
        <div class="title">
          <a href="{{route('show-house', $house->id)}}">
            <div class="name-and-owner flex-container">
              <h6>{{ ucfirst($house -> title) }}</h6>
            </div>
          </a>
          <div class="services-container flex-container">
            @foreach ($house -> services as $service)
              <span class="index-houses-preview-services">

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

  {{-- impaginazione --}}
  <div>
    {{ $houses->links() }}
  </div>

  <script>
    $('input[name="radius"]').on('input', function() {
      var range = $(this).val();
      $('#showRange').val(range);
    });

    $('#filter').click(function(){
      var filters =  {
        rooms: $('input[name="rooms"]').val(),
        beds: $('input[name="beds"]').val(),
        radius: $('input[name="radius"]').val(),
        lat: $('input[name="radius"]').data('lat'),
        lng: $('input[name="radius"]').data('lng'),
        address: $('input[name="radius"]').data('address'),
        services: []
      };
      $(':checkbox:checked').each(function() {filters.services.push($(this).attr("name")) } )
      filters = $.param(filters);
      window.location.href = window.location.origin + "/houses-index/?" + filters;
    });

    $('#reset').click(function(event) {
      var defaultData = {
        lat: $('input[name="radius"]').data('lat'),
        lng: $('input[name="radius"]').data('lng'),
        radius: $('input[name="radius"]').val(),
        address: $('input[name="radius"]').data('address'),
      };
      defaultData = $.param(defaultData);
      window.location.href = window.location.origin + "/houses-index/?" + defaultData;
    });
  </script>

@endsection
