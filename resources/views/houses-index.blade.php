@extends('layouts.layout-base')
@section('content')

@foreach ($houses as $house)
    <div>
      <a href="{{route('show-house', $house->id)}}">
        {{$house->title}}
      </a>
    </div>
@endforeach
@endsection
