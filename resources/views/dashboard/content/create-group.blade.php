@extends('layouts.app')

@section('content')

<form class="container is-fluid" action="{{ action('ContentController@storeGroup') }}" method="post">
  {{ csrf_field() }}
  <h4 class="title is-4">New Group</h4>

  <hr>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="name">Name</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input class="input" type="text" name="name" value="{{ old('name') }}">
        </div>
        @if ($errors->has('name'))
          <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for=""></label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-primary">Create</button>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
