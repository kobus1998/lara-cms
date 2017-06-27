@extends('layouts.app')

@section('content')

<form class="form" action="{{ action('PageController@store') }}" method="post">
  <h1 class="title is-4">New Page</h1>
  {{ csrf_field() }}

  <div class="field">
    <label for="page-name">Page name</label>
    <p class="control">
      <input id="page-name" type="text" name="page-name" class="input {{ $errors->has('page-name') ? 'is-danger' : '' }}" value="{{ old('page-name') }}">
    </p>
    @if ($errors->has('page-name'))
      <p class="help is-danger">{{ $errors->first('page-name') }}</p>
    @endif
  </div>

  <div class="field">
    <label for="page-desc">Page Description</label>
    <p class="control">
      <textarea name="page-desc" class="textarea {{ $errors->has('page-desc') ? 'is-danger': '' }}" rows="8" cols="80">{{ old('page-desc') }}</textarea>
    </p>
    @if ($errors->has('page-desc'))
      <p class="help is-danger">{{ $errors->first('page-desc') }}</p>
    @endif
  </div>

  <div class="field">
    <label for="page-url">Url</label>
    <p class="control">
      <input id="page-url" type="text" class="input {{ $errors->has('page-url') ? 'is-danger': '' }}" name="page-url" value="{{ old('page-url') }}">
    </p>
  </div>

  <div class="field">
    <label for="type">Type</label>
    <p class="control">
      <span class="select {{ $errors->has('type') ? 'is-danger' : '' }}">
        <select name="type">
          <option></option>
          @foreach ($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
          @endforeach
        </select>
      </span>
    </p>
    @if ($errors->has('type'))
      <p class="help is-danger">{{ $errors->first('type') }}</p>
    @endif
  </div>

  <div class="field">
    <p class="control">
      <button type="submit" class="button is-primary">Create</button>
    </p>
  </div>
</form>

@endsection
