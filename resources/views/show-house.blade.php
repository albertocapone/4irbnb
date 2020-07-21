@extends('layouts.layout-sidebar')

@section('sidebar')
  @include('components.sidebar-filters')
@endsection

@section('main-content')
  <div class="features-container flex-container">

    <div class="img-container">
      <img src="{{$house -> house_img}}" alt="">
    </div>

      <div class="box title">
        <div class="house-name">
          <h2>{{ ucfirst($house->title) }}</h2>
        </div>
        <div class="description">
          <p>{{$house->description}}</p>
        </div>
        <div class="services">
          <h5>Servizi:</h5>
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
      </div> {{-- box title --}}

      <div class="box info flex-container">
        <div class="square rooms flex-container">
          <h3>Stanze:</h3>
          <p>{{$house->rooms}}</p>
        </div>
        <div class="square beds flex-container">
          <h3>Letti:</h3>
          <p>{{$house->beds}}</p>
        </div>
        <div class="square baths flex-container">
          <h3>Bagni:</h3>
          <p>{{$house->bathrooms}}</p>
        </div>
        <div class="square metres flex-container">
          <h3>Metri quadri:</h3>
          <p>{{$house->sqm}}</p>
        </div>
      </div>

      <div class="box map">
        <div id="map" data-lat="{{$house->lat}}" data-lng="{{$house->lng}}"></div>
      </div>

      <div class="box message">
        <h3>Contatta il proprietario</h3>
        <form id="sendMessage" class="flex-container" action="{{route('store-message',$house->id)}}" method="post">
          @csrf
          @method('POST')
          <input type="email" name="email" value="@auth {{Auth::user()->email}} @endauth" placeholder="Indirizzo email"  data-parsley-trigger="keyup" required>
          <input type="textarea" name="text" placeholder="Messaggio" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="255" data-parsley-minlength-message="Minimo caratteri per inviare: 20..." required>
          <input type="submit" name="submit" value="INVIA">
        </form>
      </div>
  </div>

<script type="text/javascript">

  $("#sendMessage").parsley(); //parsley form binding

  $('#sendMessage').submit(function(){
     $(this).find(':submit').attr( 'disabled','disabled' );
  });

  var lat = $('#map').data('lat');
  var lng = $('#map').data('lng');
  console.log(lat,lng);
  var map = L.map('map',{
    scrollWheelZoom: false,
    zoomControl: true
  }).setView([lat, lng], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
  {
    minZoom: 5,
    maxZoom: 16,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  L.marker([lat, lng]).addTo(map);
</script>

@endsection
