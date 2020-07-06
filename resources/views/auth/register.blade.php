@extends('layouts.app')

@section('content')
      <div>{{ __('Register') }}</div>

<div>
    <form method="POST" action="{{ route('register') }}">
        @method('POST')
        @csrf
        <div>
            <label for="name" >{{ __('Name') }}</label>

            <div class="">
                <input id="name" type="text" @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" autofocus>

                @error('name')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

         <div>
            <label for="lastname" >{{ __('Name') }}</label>

            <div class="">
                <input id="lastname" type="text" @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" autofocus>

                @error('name')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="email">{{ __('E-Mail Address') }}</label>

            <div class="">
                <input id="email" type="email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="password" >{{ __('Password') }}</label>

            <div class="">
                <input id="password" type="password" @error('password') is-invalid @enderror name="password" required autocomplete="new-password">

                @error('password')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div >
            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

            <div class="">
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div >
            <div >
                <button type="submit" >
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
