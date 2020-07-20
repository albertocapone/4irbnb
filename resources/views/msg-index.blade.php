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
          <p class="textmeta"> <b>Info:</b> {!! Str::words($message->text, 5, '...')!!}</p>
        </div>
        <div>
          <h6>
            {{$message->parsed_created_at($message->created_at)}}
          </h6>
        </div>

        <div class="textintero">
          <i class="fas fa-times"></i>
          <h5>{{$message->parsed_created_at($message->created_at)}}</h5>
          <h6>DA:  <b>{{$message->email}}</b></h6><br>
          <p> {{$message->text}}</p>
        </div>

      </div>
      @endforeach
    </div>
    <div>
    {{ $messages->links() }}
  </div>
  </main>

</div>


@endsection
