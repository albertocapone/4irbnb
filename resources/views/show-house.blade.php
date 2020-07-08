@extends('layouts.layout-base')

@section('content')
    <div>
        <div>
            <h3>Titolo</h3>
            {{$house->title}}
        </div>
        <div>
            <h3>Descrizione</h3>
            {{$house->description}}
        </div>
        <div>
            <h3>Stanze</h3>
            {{$house->rooms}}
        </div>
        <div>
            <h3>Letti</h3>
            {{$house->beds}}
        </div>
        <div>
            <h3>Bagni</h3>
            {{$house->bathrooms}}
        </div>
        <div>
            <h3>Pic</h3>
            {{$house->img_url}}
        </div>
        <div>
            <h3>Indirizzo</h3>
            {{$house->address}}
        </div>
        <div>
            <h3>Metri quadri</h3>
            {{$house->sqm}}
        </div>
        <h3>Servizi</h3>
        <ul>
             @foreach ($house -> services as $service)
             <li>
                 {{$service->name}}
             </li>
             @endforeach
        </ul>
    </div>
    <div class="">
      <h2>Messaggio</h2>
      <form class="" action="{{route('store-message',$house->id)}}" method="post">
        @csrf
        @method('POST')
        <input type="email" name="email" value="">
        <input type="textarea" name="text" value="">
        <button type="submit" name="button">Send</button>
      </form>
    </div>

   
@endsection
