@extends('layouts.layout-sidebar')

@section('sidebar')

@endsection

@section('main-content')
  <div class="features-container flex-container">

    <div class="img-container">
      <img src="https://images.pexels.com/photos/371633/pexels-photo-371633.jpeg?cs=srgb&dl=clouds-country-daylight-371633.jpg&fm=jpg" alt="">
    </div>

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




@endsection
