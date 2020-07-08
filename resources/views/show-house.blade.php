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
@endsection