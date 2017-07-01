@extends('layouts.app')

@section('content')

<form class="container is-fluid" action="{{ action('ContentController@store') }}" method="post">
  {{ csrf_field() }}

  <form class="" action="index.html" method="post">
    <h4 class="title is-4">New Content</h4>

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
        <label for="type">Type</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <span class="select">
              <select name="type">
                <option value=""></option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}" {{ $type->id == old('type') ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
              </select>
            </span>
          </div>
          @if ($errors->has('type'))
            <p class="help is-danger">{{ $errors->first('type') }}</p>
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
</form>

@endsection
