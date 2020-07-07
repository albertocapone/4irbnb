@extends('layouts.layout-base')
@section('content')
  <div class="">
    <div class="stats">
        {{count($views)}}
    </div>
    <div class="messages">
      @foreach ($messages as $message)
        <a href="#">
          <div class="">
            {{$message->email}}<br>
            {{$message->text}}<br>
          </div>
        </a>
      @endforeach
    </div>
  </div>
  <div class="modifica">
    <div class="edit">
      <a href="{{route('edit-personal',$house->id)}}">EDITAMI</a>
    </div>
    <div class="sponsor">
      {{-- questo forse da spostare su pagina a parte --}}
      @foreach ($ads as $ad)
        <p>{{$ad->price/100}}&euro; per la sponsorizzazione {{$ad->name}} della durata di {{$ad->duration}}</p>
      @endforeach
      <button type="submit" name="button">SPONSORIZZAMELO</button>
    </div>
  </div>
@endsection
