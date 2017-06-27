@extends('layouts.app')

@section('content')

  <form class="form is-small" method="POST" action="{{ route('register') }}">
    <h1 class="title is-4">Register</h1>
    {{ csrf_field() }}

    <div class="field">
      <label for="name">Name</label>
      <p class="control">
        <input type="text" class="input" name="name" value="{{ old('name') }}" required autofocus>
      </p>
      @if ($errors->has('name'))
        <p class="help is-danger">{{ $errors->first('name') }}</p>
      @endif
    </div>

    <div class="field">
      <label for="email">Email</label>
      <p class="control">
        <input id="email" type="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" value="{{ old('email') }}" required>
      </p>
      @if ($errors->has('email'))
          <p class="help is-danger">{{ $errors->first('email') }}</p>
      @endif
    </div>

    <div class="field">
      <label for="role">Role</label>
      <p class="control">
        <span class="select">
          <select class="select" name="role">
            <option></option>
            @foreach ($roles as $role)
              <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
          </select>
        </span>
      </p>
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
        <input id="password-confirm" class="input" type="password" class="form-control" name="password_confirmation" required>
      </p>
    </div>

    <div class="field">
      <p class="control">
        <button type="submit" class="button is-primary">Register</button>
      </p>
    </div>

  </form>
@endsection
