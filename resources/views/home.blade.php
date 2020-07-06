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
    </div>
@endsection
