@extends('layouts.app')

@section('content')
  <div class="">

    <form class="form is-small" method="POST" action="{{ route('login') }}">
      <h1 class="title is-4">Login</h1>
      {{ csrf_field() }}
      <div class="field">
        <label for="email">Email</label>
        <p class="control">
          <input id="email" type="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        </p>
        @if ($errors->has('email'))
            <p class="help is-danger">{{ $errors->first('email') }}</p>
        @endif
      </div>

      <div class="field">
        <label for="password">Password</label>
        <p class="control">
          <input id="password" type="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>
        </p>
        @if ($errors->has('password'))
          <p class="help is-danger">{{ $errors->first('password') }}</p>
        @endif
      </div>

      <div class="field">
        <p class="control">
          <label for="remember" class="checkbox">
            <input class="checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
          </label>
        </p>
      </div>

      <div class="field is-grouped">
        <p class="control">
          <button type="submit" class="button is-primary">Login</button>
        </p>
        <p class="control">
          <a class="button is-link" href="{{ route('password.request') }}">
              Forgot Your Password?
          </a>
        </p>
      </div>

    </form>

  </div>
@endsection
