@extends('layouts.layout-sidebar')

@section('sidebar')

@endsection

@section('main-content')
  <div class="features-container flex-container">

      <div class="box title">
        <div class="house-name">
          <h2>{{$house->title}}</h2>
        </div>
        <div class="description">
          <p>{{$house->description}}</p>
        </div>
        <div class="services">
          <h5>Servizi:</h5>
           @foreach ($house -> services as $service)
             <span>{{$service->name}}</span>
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
        <h3>Indirizzo</h3>
        {{$house->address}}
      </div>

      <div class="box message">
        <h3>Contatta il proprietario</h3>
        <form class="flex-container" action="{{route('store-message',$house->id)}}" method="post" data-parsley-validate>
          @csrf
          @method('POST')
          <input type="email" name="email" value="" placeholder="Indirizzo email"  data-parsley-trigger="keyup" required>
          <input type="textarea" name="text" value="" placeholder="Messaggio" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="255" data-parsley-minlength-message="Minimo caratteri per inviare: 20...">
          <input type="submit" name="submit" value="INVIA">
        </form>
      </div>

  </div>


  {{-- carousel --}}
  <div class="container">
            <div class="slider-wrapper">
                <div class="prev">
                    <i class="fas fa-angle-left"></i>
                </div>
                <div class="images">
                    <img class="active first" src="https://images.pexels.com/photos/371633/pexels-photo-371633.jpeg?cs=srgb&dl=clouds-country-daylight-371633.jpg&fm=jpg" alt="">
                    <img src="https://static.photocdn.pt/images/articles/2017/04/28/iStock-646511634.jpg" alt="">
                    <img src="https://cdn.mos.cms.futurecdn.net/FUE7XiFApEqWZQ85wYcAfM.jpg" alt="">
                    <img class="last" src="https://static.photocdn.pt/images/articles/2017/04/28/iStock-546424192.jpg" alt="">
                </div>
                <div class="next">
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
            <div class="nav">
                <i class="active first"><img src="https://images.pexels.com/photos/371633/pexels-photo-371633.jpeg?cs=srgb&dl=clouds-country-daylight-371633.jpg&fm=jpg" alt=""></i>
                <i class=""> <img src="https://static.photocdn.pt/images/articles/2017/04/28/iStock-646511634.jpg" alt=""></i>
                <i class=""> <img src="https://cdn.mos.cms.futurecdn.net/FUE7XiFApEqWZQ85wYcAfM.jpg" alt=""></i>
                <i class=""><img class="last" src="https://static.photocdn.pt/images/articles/2017/04/28/iStock-546424192.jpg" alt=""></i>
            </div>
        </div>
        <div id="map" data-lat="{{$house->lat}}" data-lng="{{$house->lng}}"style="height:300px; width:500px;"></div> 

<script type="text/javascript">

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



        // creare uno slider
$(document).ready(function(){

  //EVENTI AL CLICK

    // freccia next
   $('.next').click(
     nextImg
   );

   // freccia prev
    $('.prev').click(
      prevImg
    );

    //click sul pallino
    $('.nav i').click(
      seeImgBal
    );



  //FUNZIONI

   // funzione NEXT --------------------------------
  function nextImg() {

     // salvo ref a img attiva al momento del click
     var imgActive = $('.images img.active');
     // salvo il pallino attivo
     var ballActive = $('.nav i.active');
     // tolgo la classe active all'img selezionata
     imgActive.removeClass('active');
     // tolgo la classe active al pallino selezionato
     ballActive.removeClass('active');

     // verifico se questa img era l'ultima
     if(imgActive.hasClass('last')){
       $('.images img.first').addClass('active');
       $('.nav i.first').addClass('active');
     } else {
       // applica classe active alla prox img
       imgActive.next().addClass('active');
       ballActive.next().addClass('active');
     }
  }

  // funzione PREV ---------------------------------------
  function prevImg() {

    // salvo ref a img e ball attiva al momento del click
    var imgActive = $('.images img.active');
    var ballActive = $('.nav i.active');
    // tolgo la classe active all'img e ball selezionati
    imgActive.removeClass('active');
    ballActive.removeClass('active');

    // verifico se questa img era la prima
    if(imgActive.hasClass('first')){
      $('.images img.last').addClass('active');
      $('.nav i.last').addClass('active');
    } else {
      // applica classe active alla prox img
      imgActive.prev().addClass('active');
      ballActive.prev().addClass('active');
    }
  }

  // funzione BALL ---------------------------------------
  function seeImgBal() {
    // salvo ref a img e ball attiva al momento del click
    var imgActive = $('.images img.active');
    var ballActive = $('.nav i.active');
    // tolgo la classe active all'img e ball selezionati
    imgActive.removeClass('active');
    ballActive.removeClass('active');

    //assegno l'active all img con lo stesso index del ball selezionato
    var idx = $('.nav i').index(this);
    console.log(idx);
    $('.images img').eq(idx).addClass('active');
    $(this).addClass('active');
  }




//assegnare classi diverse a immagini senza classe (per riconoscimento)
  // var imgOfImages = $('.images img');
  //
  // for (var i = 0; i <= imgOfImages.length; i++) {
  //
  //   var selectorImg = '.images img:nth-child'+'('+ i +')';
  //   var classToAddImg = 'img'+i ;
  //   $(selectorImg).addClass(classToAddImg);
  //
  // }
  //





});


        </script>


@endsection
