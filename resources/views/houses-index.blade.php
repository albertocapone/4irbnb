@extends('layouts.layout-base')
@section('content')
  {{-- qui vengono mostrati i filtri --}}
  <div>
    <h4>Filtri</h4>
    <div>
      <label for="rooms">Numero stanze</label>
       <input type="number" name="rooms" min="1" max="10" value="{{$roomsInputValue}}">
    </div>
     <div>
       <label for="beds">Numero posti letto</label>
       <input type="number" name="beds" min="1" max="20" value="{{$bedsInputValue}}">
    </div>
     <div>
       <label for="radius">Distanza</label>
       <input type="range" data-address="{{$address}}" data-lat="{{$lat}}" data-lng="{{$lng}}" name="radius" min="1" max="50" value="{{$radius}}" step="1">
    </div>
     <div>
      <label for="services">Servizi minimi</label><br>
      @foreach ($servicesList as $service)
          <input type="checkbox" name="{{$service->id}}"
           @foreach ($servicesFilter as $serviceFilter)
            @if($service->id == $serviceFilter)
              checked
            @endif
        @endforeach
          >{{$service->name}}
      @endforeach
    </div>
    <button id="filter">Filtra</button>
    <button id="reset">Reset</button>
  </div>
  <br><br><br>

  {{-- qui sotto vengono mostrate tutte le case --}}
  <div>
    <h4>Case</h4>
    @foreach ($houses as $house)
        <div class="house" data-rooms="{{$house->rooms}}" data-beds="{{$house->beds}}" data-lat="{{$house->lat}}" data-lng="{{$house->lng}}" 
          data-services="@foreach($house->services as $service){{$service->id}};@endforeach">
          <a href="{{route('show-house', $house->id)}}">
            {{$house->title}}
          </a>
        </div>
    @endforeach
  </div><br><br>
  <div>
    {{ $houses->links() }}
  </div>

  <script>
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
