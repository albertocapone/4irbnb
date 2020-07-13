@extends('layouts.layout-base')
@section('content')
  <div class="">
    <div class="stats">
        <h2>VISUALIZZAZIONI</h2>
        {{count($views)}}
    </div>
    <div class="messages">
      <h2>MESSAGGI</h2>
      @foreach ($messages as $message)
        <a href={{route('msg-index', $house->id)}}>
          <div class="">
            {{$message->email}}<br>
            {{$message->text}}<br><br>
          </div>
        </a>
      @endforeach
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
