@extends('layouts.layout-base')

@section('content')

<div class="fullwidthcreate">


  <main>

    <div class="posta">

      <h5>POSTA</h5>
      @foreach ($messages as $message)
      <div class='messaggi'>
        <div class="email">
          <h6> <i class="far fa-envelope"></i> {{$message->email}}</h6>
        </div>
        <div class="text">
          <p class="textmeta"> <b>Info:</b> {!! Str::words($message->text, 5, '...')!!}
          <p class="textintero"> {{$message->text}}</p></p>

        </div>
      </div>
      @endforeach
    </div>


  </main>

</div>


@endsection
