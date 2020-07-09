@extends('layouts.layout-base')
@section('content')
  {{-- qui vengono mostrati i filtri --}}
  <div>
    <h4>Filtri</h4>
    <div>
      <label for="rooms">Numero stanze</label>
      <select name="rooms">
        @for ($roomsNumber = 1; $roomsNumber <= $maxRooms; $roomsNumber++)
            <option value="{{$roomsNumber}}">{{$roomsNumber}}</option>
        @endfor
      </select>
    </div>
     <div>
       <label for="beds">Numero posti letto</label>
       <select name="beds">
         @for ($bedsNumber = 1; $bedsNumber <= $maxBeds; $bedsNumber++)
            <option value="{{$bedsNumber}}">{{$bedsNumber}}</option>
        @endfor
       </select>
    </div>
     <div>
       <label for="radius">Distanza</label>
       <input type="range" data-lat="{{$lat}}" data-lng="{{$lng}}" name="radius" min="1" max="50" value="20" step="1">
    </div>
     <div>
      <label for="services">Servizi minimi</label><br>
      @foreach ($servicesList as $service)
          <input type="checkbox" name="{{$service->id}}">{{$service->name}}
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

    function housesFilter() {
      var filter = {
        rooms: $('select[name="rooms"]').val(),
        beds: $('select[name="beds"]').val(),
        services: [] 
      }
      $(':checkbox:checked').each(function() {filter.services.push($(this).attr("name")) } ) 

     $('.house').each(function() {
        var house = {
          rooms: $(this).data('rooms'),
          beds: $(this).data('beds'),
          services: $(this).data('services').split(';'),
          lat: $(this).data('lat'),
          lng: $(this).data('lng')
        };

        var houseHasService = function() {
          for(var service of filter.services){
            if(!house.services.includes(service)) {
              return false;
            }
          }
          return true;
        };

        var houseIsInRange = function() {
          var origin = {
            lat: $('input[name="radius"]').data('lat'),
            lng: $('input[name="radius"]').data('lng')
          };
          var radiusKm = $('input[name="radius"]').val();
          var ky = 40000 / 360;
          var kx = Math.cos(Math.PI * origin.lat / 180.0) * ky;
          var dx = Math.abs(origin.lng - house.lng) * kx;
          var dy = Math.abs(origin.lat - house.lat) * ky;
          return Math.sqrt(dx * dx + dy * dy) <= radiusKm;
        }

        if(house.beds >= filter.beds && house.rooms >= filter.rooms && houseHasService() && houseIsInRange()){
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }

    $('#filter').click(housesFilter);

    $('#reset').click(function(event) {   
      $('.house').each(function() {
        $(this).show();
      });
    });

    housesFilter(); //nasconde i risultati oltre i 20km sul caricamento pagina
  </script>

@endsection
