@extends('layouts.layout-base')

@section('content')
<h2>MESSAGGI</h2>
@foreach ($messages as $message)
<div>
    <h4>{{$message->email}}</h4>
    <p>{{$message->text}}</p>
</div>
@endforeach
@endsection