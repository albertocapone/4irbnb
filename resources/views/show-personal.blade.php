@extends('layouts.layout-base')
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
      {{-- questo forse da spostare su pagina a parte --}}
      @foreach ($ads as $ad)
        <p>{{$ad->price/100}}&euro; per la sponsorizzazione {{$ad->name}} della durata di {{$ad->duration}}</p>
      @endforeach
      <button type="submit" name="button">SPONSORIZZAMELO</button>
    </div>
  </div>
@endsection
