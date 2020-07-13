@extends('layouts.layout-base')

@section('content')
<div>
    <h2>MESSAGGI</h2>
    <h3>{{count($messages)}}</h3>
</div>
<div>
    <h2>VIEWS</h2>
    <h3>{{count($views)}}</h3>
</div>
@endsection