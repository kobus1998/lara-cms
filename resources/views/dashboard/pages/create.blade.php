@extends('layouts.app')

@section('content')

<form class="form container is-fluid" action="{{ action('PageController@store') }}" method="post">
  <h1 class="title is-4">New Page</h1>
  <hr>
  {{ csrf_field() }}

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="name">Page name</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input id="name" type="text" name="name" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" value="{{ old('name') }}">
        </div>
        @if ($errors->has('name'))
          <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="desc">Page Description</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <textarea name="desc" class="textarea {{ $errors->has('desc') ? 'is-danger': '' }}" rows="8" cols="80">{{ old('desc') }}</textarea>
        </div>
        @if ($errors->has('desc'))
          <p class="help is-danger">{{ $errors->first('desc') }}</p>
        @endif
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label for="url">Url</label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <input id="url" type="text" class="input {{ $errors->has('url') ? 'is-danger': '' }}" name="url" value="{{ old('url') }}">
        </div>
        @if ($errors->has('url'))
          <p class="help is-danger">{{ $errors->first('url') }}</p>
        @endif
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label">
      <label></label>
    </div>
    <div class="field-body">
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-primary">Create</button>
        </div>
      </div>
    </div>
  </div>

  <div class="field">
    <p class="control">

    </p>
  </div>
</form>

@endsection
