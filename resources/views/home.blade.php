@extends('layouts.app')

@section('content')
    <div>
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div>
        <a href="{{route('house-create')}}">Metti cosa posto dormire</a>
        {{-- inizio cose nuove good luck frontend --}}
        <div class="casette">
          @foreach ($houses as $house)
            <a href="{{route('show-personal',$house->id)}}">
              {{$house->title}}

            </a>
          @endforeach
        </div>
        {{-- qua abbiamo finito --}}
    </div>
@endsection
{{-- profilo edit ecc --}}
