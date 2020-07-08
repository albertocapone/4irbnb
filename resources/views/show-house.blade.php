@extends('layouts.layout-base')

@section('content')
    <div>
        <div>
            {{$house->title}}
        </div>
        <div>
            {{$house->description}}
        </div>
        <div>
            {{$house->rooms}}
        </div>
        <div>
            {{$house->beds}}
        </div>
        <div>
            {{$house->bathrooms}}
        </div>
        <div>
            {{$house->img_url}}
        </div>
        <div>
            {{$house->address}}
        </div>
        <div>
            {{$house->sqm}}
        </div>
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
        <button type="submit" name="button">AAAAAAAAAA</button>
      </form>
    </div>
@endsection
