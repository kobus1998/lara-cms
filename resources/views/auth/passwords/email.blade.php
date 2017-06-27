@extends('layouts.app')

@section('content')
  @if (session('status'))
    <div class="notification is-success">
      {{ session('status') }}
    </div>
  @endif

  <form class="form is-small" action="{{ route('password.email') }}" method="post">
    <h1 class="title is-4">Reset Email</h1>
    {{ csrf_field() }}
    <div class="field">
      <label for="email">email</label>
      <p class="control">
        <input id="email" type="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required>
      </p>
      @if ($errors->has('email'))
        <span class="help is-danger">
          {{ $errors->first('email') }}
        </span>
      @endif
    </div>

    <div class="field">
      <p class="control">
        <button type="submit" class="button is-primary">Send Password Reset Link</button>
      </p>
    </div>
  </form>
@endsection
