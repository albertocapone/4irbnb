@extends('layouts.layout-sidebar')

@section('sidebar')
  {{-- @include('components.sidebar-home') --}}
@endsection

@section('main-content')

    @if (count($houses) == 0)
      <div class="prova">
        <p>non ci sono case</p> {{-- <?php // TODO:  ?> --}}
      </div>
    @else
      <div class="houses-preview-container flex-container">
        @foreach ($houses as $house)
          <div class="house-preview">
            <div class="immagine">{{$house -> img_url}}</div>
            <div class="title">
              <a href="{{route('show-personal', $house->id)}}">
                <h6>{{$house -> title}}</h6>
              </a>
              @foreach ($house -> services as $service)
                <span>{{$service -> name}}</span>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    @endif


@endsection