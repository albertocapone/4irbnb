@extends('layouts.layout-base')

@section('content')
  <div class="fullwidth">
    <main>
      <div class="register">
        <h5>{{ __('REGISTRAZIONE') }}</h5>

        <div>
            <form method="POST" action="{{ route('register') }}" data-parsley-validate>
                @method('POST')
                @csrf
                <div class="flex class">

                      <div class="flex name">
                          <label for="name" >{{ __('Nome') }}</label>
                          <input id="name" type="text" {{-- @error('name') is-invalid @enderror --}} name="name" value="{{ old('name') }}" autofocus>

                          {{-- @error('name')
                              <span role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror --}}
                      </div>





                      <div class="flex lastname">
                          <label for="last_name" >{{ __('Cognome') }}</label>
                          <input id="last_name" type="text" {{-- @error('last_name') is-invalid @enderror --}} name="last_name" value="{{ old('last_name') }}" >

                          {{-- @error('last_name')
                              <span role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror --}}
                      </div>

                </div>

                <div >
                  <label for="date_of_birth">{{ __('Data di nascita')}}</label>

                  <div class="">
                      <input id='date_of_birth' type="date" {{--@error('date_of_birth') is-invalid @enderror--}} name="date_of_birth" value="{{ old('date_of_birth') }}">

                      {{-- @error('date_of_birth')
                        <span role='alert'>
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror --}}
                  </div>
                </div>
                <div>
                    <label for="email">{{ __('E-Mail') }}</label>

                    <div class="">
                        <input id="email" type="email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required data-parsley-trigger="focusout">

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
                        <input id="password" type="password" {{--@error('password') is-invalid @enderror--}} name="password" data-parsley-trigger="focusout" required minlength="8">
{{--
                        @error('password')
                            <div role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}
                    </div>
                </div>

                <div >
                    <label for="password-confirm" >{{ __('Conferma Password') }}</label>

                    <div class="">
                        <input id="password-confirm" type="password" name="password_confirmation" data-parsley-trigger="focusout" data-parsley-equalto="#password" required minlength="8">
                    </div>
                </div>

                <div >
                    <div >
                        <button type="submit" >
                            {{ __('REGISTRATI') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
      </div>

    </main>

  </div>
@endsection
