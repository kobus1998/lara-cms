@extends('layouts.app')

@section('content')

  @if (session('status'))
    <div class="notification is-success">
      {{ session('status') }}
    </div>
  @endif

  <form class="form is-small" action="{{ route('password.request') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="field">
      <label for="email">Email</label>
      <p class="control">
        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>
      </p>
      @if ($errors->has('email'))
        <span class="help is-danger">
          {{ $errors->first('email') }}
        </span>
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
      <label for="password_confirmation">Confirm Password</label>
      <p class="control">
        <input id="password-confirm" class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" type="password" class="form-control" name="password_confirmation" required>
      </p>
      @if ($errors->has('password_confirmation'))
        <span class="help is-danger">
          {{ $errors->first('password_confirmation') }}
        </span>
      @endif
    </div>

    <div class="field">
      <p class="control">
        <button type="submit" class="button is-primary">Reset Password</button>
      </p>
    </div>

  </form>

@endsection
