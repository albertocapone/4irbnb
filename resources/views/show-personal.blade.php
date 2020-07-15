
@extends('layouts.layout-sidebar')

@section('sidebar')
  {{-- @include('components.sidebar-show') --}}
@endsection

@section('main-content')
  <div class="features-container flex-container property-features">

    <h1 class="property-title">{{$house->title}}</h1>

      <div class="box messaggi flex-container">
        <div class="overlay flex-container">
          <a href="{{route('msg-index', $house->id)}}">
            <h3>Messaggi</h3>
          </a>
        </div>
      </div>
      <div class="box promuovi flex-container">
        <a href="{{route('ad-payment', $house->id)}}">
          <div class="overlay flex-container">
            <h3>Promuovi</h3>
             {{-- comparsa tendina sotto pulsanti --}}
          </div>
        </a>
      </div>

      <div class="box statistiche flex-container">
        <div class="overlay flex-container">
           <a href="{{route('stats-index', $house->id)}}">
          <h3>Statistiche</h3>
        </a>
        </div>
      </div>

      <div class="box bottoni flex-container">
        <a class="edit flex-container" href="{{route('edit-personal', $house->id)}}"> <h3>Modifica</h3> </a>
        <a class="delete flex-container" href="{{route('delete-personal', $house->id)}}"><h3>Elimina</h3></a>
      </div>

  </div>


@endsection







{{-- @extends('layouts.layout-base')


    <div class="sponsor">

      @foreach ($ads as $ad)
        <p>{{$ad->price/100}}&euro; per la sponsorizzazione {{$ad->name}} della durata di {{$ad->duration}}</p>
      @endforeach
      <button type="submit" name="button">SPONSORIZZAMELO</button>
    </div>
  </div>
@endsection --}}
