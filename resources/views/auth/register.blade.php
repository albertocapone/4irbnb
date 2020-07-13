@extends('layouts.layout-base')

@section('content')
  <div class="fullwidth">
    <main>
      <div class="register">
        <h5>{{ __('Register') }}</h5>

        <div>
            <form method="POST" action="{{ route('register') }}">
                @method('POST')
                @csrf
                <div>
                    <label for="name" >{{ __('Name') }}</label>

                    <div class="">
                        <input id="name" type="text" @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" autofocus>

                        @error('name')
                            <div role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                 <div>
                    <label for="last_name" >{{ __('Lastname') }}</label>

                    <div class="">
                        <input id="last_name" type="text" @error('last_name') is-invalid @enderror name="last_name" value="{{ old('last_name') }}" >

                        @error('last_name')
                            <div role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
                <div >
                  <label for="date_of_birth">{{ __('Date Of Birth')}}</label>

                  <div class="">
                      <input id='date_of_birth' type="date" @error('date_of_birth') is-invalid @enderror name="date_of_birth" value="{{ old('date_of_birth') }}">

                      @error('date_of_birth')
                        <div role='alert'>
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                </div>
                <div>
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    <div class="">
                        <input id="email" type="email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <div role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" >{{ __('Password') }}</label>

                    <div class="">
                        <input id="password" type="password" @error('password') is-invalid @enderror name="password" required autocomplete="new-password">

                        @error('password')
                            <div role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
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
      </div>

    </main>

  </div>
@endsection
