@extends('layouts.layout-sidebar')

@section('sidebar')
  @include('components.sidebar-home')
@endsection

@section('main-content')

    @if (count($houses) == 0)
      <div class="prova">
        <p>non ci sono case</p> {{-- <?php // TODO:  ?> --}}
      </div>
    @else
      <div class="houses-preview-container flex-container">
        @foreach ($houses as $house)
          <div class="{{($house->visibility == 0) ? "hidden" : "visible"}} house-preview">
            <div class="immagine">
              <img src="{{$house -> house_img}}" alt="">
            </div>
            <div class="title">
              <a href="{{route('show-personal', $house->id)}}">
                <h6>{{$house -> title}}</h6>
              </a>
              @foreach ($house -> services as $service)
                <span class="index-houses-preview-services">
                  {{$service->name}}
                  @if($service->name == 'Wifi')
                      <i class="fas fa-wifi"></i>
                  @endif
                  @if($service->name == 'Parking')
                      <i class="fas fa-parking"></i>
                  @endif
                  @if($service->name == 'Pool')
                      <i class="fas fa-swimming-pool"></i>
                  @endif
                  @if($service->name == 'Concierge')
                      <i class="fas fa-concierge-bell"></i>
                  @endif
                  @if($service->name == 'Sauna')
                      <i class="fas fa-hot-tub"></i>
                  @endif
                  @if($service->name == 'Seaview')
                      <i class="fas fa-water"></i>
                  @endif
                </span>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    @endif


@endsection
