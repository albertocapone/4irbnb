@extends('layouts.layout-base')

@section('content')
<div class="fullwidth">
  <main>

    <div class="login">

      <div class="title">{{ __('Login') }}</div>

      <div class="">
          <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="email">
                  <label for="email" class="">{{ __('E-Mail Address') }}</label>

                  <div class="error">
                      <input class="error" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                      @error('email')
                          <div class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </div>
                      @enderror
                  </div>
              </div>

              <div class="">
                  <label for="password" class="">{{ __('Password') }}</label>

                  <div class="error">
                      <input class="error" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                      @error('password')
                          <div class="invalid-feedback" role="alert">
                              <strong >{{ $message }}</strong>
                          </div>
                      @enderror
                  </div>
              </div>


              <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                  </label>
              </div>


              <div class="form-group">
                  <div class="">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Login') }}
                      </button>

                      @if (Route::has('password.request'))
                          <a class="btn btn-link" href="{{ route('password.request') }}">
                              {{ __('Forgot Your Password?') }}
                          </a>
                      @endif
                  </div>
              </div>
          </form>
      </div>
    </div>
  </main>
</div>

@endsection
