
@extends('layouts.layout-sidebar')

@section('sidebar')
  {{-- @include('components.sidebar-show') --}}
@endsection

@section('main-content')
  <div class="features-container flex-container property-features">

    <h1 class="property-title">{{$house->title}}</h1>

      <div class="box visualizzazioni flex-container">
        <a href="{{route('msg-index', $house->id)}}">
          <h3>Messaggi</h3>
        </a>
      </div>

      <div class="box promuovi flex-container">
        <div class="overlay flex-container">
          <h3>Promuovi</h3>
           {{-- comparsa tendina sotto pulsanti --}}
        </div>
      </div>

      <div class="box statistiche flex-container">
        <div class="overlay flex-container">
           <a href="{{route('stats-index', $house->id)}}">
          <h3>Statistiche</h3>
        </a>
        </div>
      </div>

      <div class="box bottoni flex-container">
        <a class="edit flex-container" href="{{route('edit-personal', $house->id)}}"> <p>Modifica</p> </a>
        <a class="delete flex-container" href="{{route('delete-personal', $house->id)}}"><p>Elimina</p></a>
      </div>

  </div>


@endsection







{{-- @extends('layouts.layout-base')
@section('content')
  <div class="">
    <div class="stats">
      <a href="{{route('stats-index', $house->id)}}">
        <h2>VISUALIZZAZIONI (cliccami)</h2>
      </a>
    </div><br><br>
    <div class="messages">
      <a href="{{route('msg-index', $house->id)}}">
        <h2>MESSAGGI (cliccami)</h2>
      </a>
    </div>
  </div>
  <div class="modifica">
    <div class="edit">

      <br><br><br><br><br>

      <a href="{{route('edit-personal',$house->id)}}">EDITAMI</a>
      <a href="{{route('delete-personal',$house->id)}}">ELIMINAMI</a>
    </div>

    <br><br><br><br><br><br><br><br>

    <div class="sponsor">

      @foreach ($ads as $ad)
        <p>{{$ad->price/100}}&euro; per la sponsorizzazione {{$ad->name}} della durata di {{$ad->duration}}</p>
      @endforeach
      <button type="submit" name="button">SPONSORIZZAMELO</button>
    </div>
  </div>
@endsection --}}
